<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    var $helpers = array('Html', 'Form');
    public $components = array('Auth', 'Session');

    function beforeFilter() {
        $this->Auth->loginAction = array('admin' => false, 'plugin' => null, 'controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('admin' => false, 'plugin' => null, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('admin' => true, 'plugin' => null, 'controller' => 'paginas', 'action' => 'index');
        $this->Auth->allow('exibe', 'view', 'imprimeMenuInfinito', 'getUrlAtendimento');
    }

    function beforeRender() {

    }

}