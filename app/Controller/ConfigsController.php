<?php

class ConfigsController extends AppController {

    public $name = 'Configs';
    public $uses = array();

    public function admin_edit($id = NULL) {
        $this->layout = 'admin';
        $this->Config->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Config->read();
        } else {
            if ($this->Config->save($this->request->data)) {
                $this->Session->setFlash('Configuração atualizada.', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Não foi possível atualizar.', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    public function getEmail() {
        $this->autoRender = false;
        $email = $this->Config->find('first', array(
            'conditions' => array('Config.id' => 1)
                ));
        return $email['Config']['email'];
    }

}
