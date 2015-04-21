<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CategoriasController extends AppController {

    var $helpers = array('Session');
    var $components = array('Paginator');
    public $paginate = array(
        'limit' => 15,
        'order' => array(
            'Categoria.description' => 'asc'
        )
    );

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Categorias';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Categoria');

    function admin_index() {
        $this->layout = 'admin';

        try {
            $this->Paginator->settings = $this->paginate;
            $data = $this->Paginator->paginate('Categoria');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            //Do something here like redirecting to first or last page.
            //$this->request->params['paging'] will give you required info.
        }
    }

    public function admin_add() {
        $this->layout = 'admin';

        if ($this->request->is('post')) {
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash('Cadastro Efetuado com Sucesso', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Erro no Cadastro', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    function admin_edit($id = null) {
        $this->layout = 'admin';

        $this->Categoria->id = $id;

        if ($this->request->is('get')) {
            $this->request->data = $this->Categoria->read();
        } else {
            if ($this->Categoria->save($this->request->data)) {
                $this->Session->setFlash('Registro atualizado', 'default', array('class' => 'alert alert-success'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Não foi possível atualizar', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    function admin_delete($id) {
        if (empty($id)) {
            $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
        } else {
            if ($this->Categoria->delete($id, true)) {
                $this->Session->setFlash('Registro deletado', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Falha ao tentar deletar', 'default', array('class' => 'alert alert-error'));
            }
        }
        $this->redirect('index');
    }

}

