<?php

class BlocosController extends AppController {

    public $name = 'Blocos';
    public $uses = array('Bloco', 'Site');
    var $components = array('Paginator');
    public $paginate = array(
        'limit' => 15,
        'contain' => array('Site'),
        'order' => array(
            'id' => 'asc', 'site_id' => 'asc'
        )
    );

    public function exibe($site_id = NULL, $tipo = NULL) {
        $blocos = $this->Bloco->find('first', array(
            'conditions' => array('Bloco.status' => 1, 'Bloco.site_id' => $site_id, 'Bloco.tipo' => $tipo),
            'order' => 'Bloco.id DESC',
            'recursive' => 0
        ));
        return $blocos;
    }

    public function admin_index() {
        $this->layout = 'admin';
        try {
            $this->Paginator->settings = $this->paginate;
            $data = $this->Paginator->paginate('Bloco');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            $this->redirect($this->referer());
        }
    }

    public function admin_add() {
        $this->layout = 'admin';
        $sites = $this->Site->find('list', array(
            'fields' => array('Site.id', 'Site.nome'),
            'conditions' => array('Site.status' => 1),
            'order' => 'nome'));
        $this->set('sites', $sites);

        if ($this->request->is('post')) {
            #pr($this->data);
            if ($this->Bloco->save($this->request->data)) {
                $this->Session->setFlash('Cadastro Efetuado com Sucesso', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Erro no Cadastro', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->layout = 'admin';

        $this->Bloco->id = $id;
        $sites = $this->Site->find('list', array(
            'fields' => array('Site.id', 'Site.nome'),
            'order' => 'nome'));
        $this->set('sites', $sites);
        if (!empty($this->data)) {

            if ($this->Bloco->save($this->request->data)) {
                $this->Session->setFlash('Banner atualizado', 'default', array('class' => 'alert alert-success'));
                $this->redirect(index);
            } else {
                $this->Session->setFlash('Não foi possível atualizar', 'default', array('class' => 'alert alert-error'));
            }
        } else {
            $data = $this->Bloco->findById($id);
            if (empty($data)) {
                $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
                $this->redirect(index);
            } else {
                $this->data = $data;
            }
        }
    }

    public function admin_delete($id = NULL) {
        $data = $this->Bloco->findById($id);
        if (empty($data)) {
            $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
        } else if ($this->Bloco->delete($id)) {
            $this->Session->setFlash('Registro com id: ' . $id . ' foi deletado.', 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash('Falha ao tentar deletar o registro', 'default', array('class' => 'alert alert-error'));
        }

        $this->redirect($this->referer());
    }

}
