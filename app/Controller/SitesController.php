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
class SitesController extends AppController {

    var $helpers = array('Session');
    var $components = array('Route', 'Paginator');
    public $paginate = array(
        'limit' => 15,
        'order' => array(
            'Site.nome' => 'asc', 'Site.id' => 'asc'
        )
    );

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Sites';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Site', 'Pagina');

    public function getUrlAtendimento($site_id = NULL) {
        $url = $this->Site->find('first', array(
            'conditions' => array('Site.id' => $site_id),
            'recursive' => 0
                ));
        
        return $url;
    }
    
    function admin_index() {
        $this->layout = 'admin';

        try {
            $this->Paginator->settings = $this->paginate;
            $data = $this->Paginator->paginate('Site');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            //Do something here like redirecting to first or last page.
            //$this->request->params['paging'] will give you required info.
        }
    }

    public function admin_add() {
        $this->layout = 'admin';

        if ($this->request->is('post')) {
            if ($this->Site->save($this->request->data)) {
                $this->Session->setFlash('Cadastro Efetuado com Sucesso', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Erro no Cadastro', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    function admin_edit($id = null) {
        $this->layout = 'admin';

        if (!empty($this->data)) {
            $site = $this->Site->findById($id);
            $this->request->data('Site.old_default_url', $site['Site']['pagina_id']);
            #pr($this->data); die;
            if ($this->Site->save($this->data)) {
                if ($this->data['Site']['old_default_url'] != $this->data['Site']['pagina_id']) {
                    $route = "Router::connect('/" . $this->data['Site']['url_key'] . "', array('controller' => 'paginas', 'action' => 'view', '" . $this->data['Site']['old_default_url'] . "'));";
                    $this->Route->remove($route);
                    $route = "Router::connect('/" . $this->data['Site']['url_key'] . "', array('controller' => 'paginas', 'action' => 'view', '" . $this->data['Site']['pagina_id'] . "'));";
                    $this->Route->add($route);
                }
                $this->Session->setFlash('Site Atualizado', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            }
        } else {
            $site = $this->Site->findById($id);
            if (empty($site)) {
                $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
                $this->redirect('index');
            } else {
                $this->data = $site;
                $paginas = $this->Pagina->generateTreeList(array('Pagina.site_id' => $site['Site']['id']), '{n}.Pagina.id', '{n}.Pagina.nome', '--', true);
                $this->set('paginas', $paginas);
            }
        }
    }

    function admin_delete($id) {
        $site = $this->Site->findById($id);
        if (empty($site)) {
            $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
        } else {
            if ($this->Site->delete($id, true)) {
                $route = "Router::connect('/" . $site['Site']['url_key'] . "/', array('controller' => 'paginas', 'action' => 'view', '" . $site['Site']['pagina_id'] . "'));";
                $this->Route->remove($route);
                $this->Session->setFlash('Página deletada', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Falha ao tentar deletar', 'default', array('class' => 'alert alert-error'));
            }
        }
        $this->redirect('index');
    }

}

