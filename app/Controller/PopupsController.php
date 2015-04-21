<?php

class PopupsController extends AppController {

    public $name = 'Popups';
    public $uses = array('Popup', 'Pagina');
    var $components = array('Paginator');
    public $paginate = array(
        'limit' => 15,
        'order' => array(
            'id' => 'DESC'
        )
    );

    public function exibe($pagina_id = NULL) {
        $popup_id = $this->Pagina->find('first', array(
            'conditions' => array('Pagina.id' => $pagina_id),
            'fields' => array('popup_id'),
            'recursive' => 0
        ));
        
        $popups = $this->Popup->find('first', array(
            'conditions' => array('Popup.status' => 1, 'Popup.id' => $popup_id['Pagina']['popup_id']),
            'order' => 'Popup.id DESC',
            'recursive' => 0
        ));
        return $popups;
    }

    public function admin_index() {
        $this->layout = 'admin';
        try {
            $this->Paginator->settings = $this->paginate;
            $data = $this->Paginator->paginate('Popup');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            $this->redirect($this->referer());
        }
    }

    public function admin_add() {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            if ($this->Popup->save($this->request->data)) {
                $this->Session->setFlash('Cadastro Efetuado com Sucesso', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Erro no Cadastro', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->layout = 'admin';

        $this->Popup->id = $id;
        if (!empty($this->data)) {
            if ($this->Popup->save($this->request->data)) {
                $this->Session->setFlash('Atualizado', 'default', array('class' => 'alert alert-success'));
                $this->redirect(index);
            } else {
                $this->Session->setFlash('Não foi possível atualizar', 'default', array('class' => 'alert alert-error'));
            }
        } else {
            $data = $this->Popup->findById($id);
            if (empty($data)) {
                $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
                $this->redirect(index);
            } else {
                $this->data = $data;
            }
        }
    }

    public function admin_delete($id = NULL) {
        $data = $this->Popup->findById($id);
        if (empty($data)) {
            $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
        } else if ($this->Popup->delete($id)) {
            $this->Session->setFlash('Registro com id: ' . $id . ' foi deletado.', 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash('Falha ao tentar deletar o registro', 'default', array('class' => 'alert alert-error'));
        }

        $this->redirect($this->referer());
    }

}
