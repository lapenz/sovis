<?php

class BannersController extends AppController {

    public $name = 'Banners';
    public $uses = array('Banner', 'Pagina');
    var $components = array('Paginator');
    public $paginate = array(
        'limit' => 15,
        'recursive' => 2,
        'contain' => array('Pagina'),
        'order' => array(
            'id' => 'asc', 'pagina_id' => 'asc'
        )
    );

    public function exibe($page_id = NULL) {
        $banners = $this->Banner->find('all', array(
            'conditions' => array('Banner.status' => 1, 'Banner.pagina_id' => $page_id),
            'order' => 'Banner.posicao ASC, Banner.id DESC',
            'recursive' => 0
                ));
        
        return $banners;
    }
    
    public function admin_index() {
        $this->layout = 'admin';
//        $rgs = $this->Banner->find('all', array(
//            'conditions' => array('Banner.nome' => 'home_banner'),
//            'order' => 'Banner.posicao ASC, Banner.id DESC',
//        ));
//        $this->set(compact('data'));

        try {
            $this->Paginator->settings = $this->paginate;
            $data = $this->Paginator->paginate('Banner');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            $this->redirect($this->referer());
        }
    }

    public function admin_add() {
        $this->layout = 'admin';
        $paginas = $this->Pagina->generateTreeList(null, '{n}.Pagina.id', '{n}.Pagina.nome', '--', true);
        $this->set('paginas', $paginas);
        if ($this->request->is('post')) {
            #pr($this->data);
            if ($this->Banner->save($this->request->data)) {
                $this->Session->setFlash('Cadastro Efetuado com Sucesso', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Erro no Cadastro', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    public function admin_editBannerSituacao($id = NULL, $situacao = NULL) {
        if ($this->request->is('get')) {
            $this->Banner->id = $id;
            if ($this->Banner->saveField('status', $situacao)) {
                $this->Session->setFlash('Status alterado', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Erro ao tentar alterar o status', 'default', array('class' => 'alert alert-error'));
            }
            $this->redirect($this->referer());
        }
    }

    public function admin_edit($id = NULL) {
        $this->layout = 'admin';

        $this->Banner->id = $id;
        
        $paginas = $this->Pagina->generateTreeList(null, '{n}.Pagina.id', '{n}.Pagina.nome', '--', true);
            $this->set('paginas', $paginas);
        if ($this->request->is('get')) {
            $this->request->data = $this->Banner->read();
        } else {
            if ($this->Banner->save($this->request->data)) {
                $this->Session->setFlash('Banner atualizado', 'default', array('class' => 'alert alert-success'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Não foi possível atualizar', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    public function admin_delete($id = NULL) {
        $banner = $this->Banner->findById($id);
        if (empty($banner)) {
            $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
        } else {
            if ($this->Banner->delete($id)) {
                $this->Session->setFlash('Registro deletado', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Falha ao tentar deletar o registro', 'default', array('class' => 'alert alert-error'));
            }
        }
        $this->redirect($this->referer());
    }

}
