<?php

class BlogConfigsController extends AppController {

    public $uses = array();

    public function admin_edit($id = NULL) {
        $this->layout = 'admin';
        $this->BlogConfig->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->BlogConfig->read();
        } else {
            if ($this->BlogConfig->save($this->request->data)) {
                $this->Session->setFlash('Configuração atualizada.', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Não foi possível atualizar.', 'default', array('class' => 'alert alert-error'));
            }
        }
    }



}
