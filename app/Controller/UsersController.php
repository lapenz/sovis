<?php

/**
 * Users Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class UsersController extends AppController {

    public $name = 'Users';
    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function login() {
        $this->layout = 'login';

        if ($this->request->is('post')) {
//pr($this->Auth->password($this->data['User']['password']));
            if ($this->Auth->login()) {
                $_SESSION['KCFINDER']['disabled'] = false;
                $_SESSION['KCFINDER']['uploadUrl'] = $this->webroot.'uploads/';
                $this->redirect('/admin/paginas');
            } else {
                $this->Session->setFlash(__('Usuário ou senha inválidos, tente novamente'));
            }
        }
    }

    public function logout() {
        $_SESSION['KCFINDER']['disabled'] = true;
        session_destroy();
        $this->redirect($this->Auth->logout());
    }

    function admin_edit($id = NULL) {
        $this->layout = 'admin';
        $this->User->id = $id;

        if (!empty($this->request->data)) {

            $password = $this->User->find('first', array('conditions' => array('User.id' => $this->User->id), 'fields' => 'User.password'));
            if (($password['User']['password'] === AuthComponent::password($this->request->data['User']['old'])) && ($this->request->data['User']['new'] === $this->request->data['User']['repeat'])) {
                $this->request->data['User']['password'] = $this->request->data['User']['new'];
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash('Senha alterada com sucesso!', 'default', array('class' => 'alert alert-success'));
                } else {
                    $this->Session->setFlash('Erro! Verifique os dados e tente novamente.', 'default', array('class' => 'alert alert-error'));
                }
            } else {
                $this->Session->setFlash('Erro! Digite os dados corretamente.', 'default', array('class' => 'alert alert-error'));
            }
        } else {
            $this->request->data = $this->User->read();
        }
    }

}
