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
class PaginasController extends AppController {

    var $helpers = array('Session');
    var $components = array('Route', 'Paginator');
    public $paginate = array(
        'limit' => 20,
        'contain' => array('Site'),
        'order' => array(
            'Pagina.lft' => 'asc', 'Pagina.parent_id' => 'asc'
        )
    );

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Paginas';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Pagina', 'Site', 'Popup', 'Banner');

    public function getMenu($site_id = NULL) {
        $this->Pagina->recursive = 0;
        $conditions = array('Pagina.inc_menu' => 1, 'Pagina.status' => 1);
        if (!empty($site_id))
            $conditions = array_merge(array('Pagina.site_id' => $site_id), $conditions);
        #pr($conditions);
        $itens = $this->Pagina->find('all', array(
            'conditions' => array($conditions),
            'order' => 'lft Asc'
        ));

        $menuItens = array();
        foreach ($itens as $rg) {
            $aux = $rg['Pagina']['parent_id'] == null ? 0 : $rg['Pagina']['parent_id'];

            if ($rg['Pagina']['tipo'] == 1) {
                $menuItens[$aux][$rg['Pagina']['id']] = array('url_key' => $rg['Pagina']['url_key'], 'titulo' => $rg['Pagina']['titulo'], 'target' => $rg['Pagina']['target']);
            } else {
                $menuItens[$aux][$rg['Pagina']['id']] = array('url_key' => $this->base . $this->_getPath($rg['Pagina']['id']), 'titulo' => $rg['Pagina']['titulo'], 'target' => $rg['Pagina']['target']);
            }
            if ($rg['Pagina']['ancora'] == 1)
                $menuItens[$aux][$rg['Pagina']['id']]['url_key'] = '';
        }

        return $menuItens;
    }

    /**
     * Função imprimeMenuInfinito - Função recursiva utilizada para imprimir
     * menu com submenus em níveis infinitos.
     * 
     * @author MatiasRezende - contato@matiasrezende.com.br
     * @license http://creativecommons.org/licenses/by-sa/2.5/br/
     * @param array $menuTotal - Array do menu a ser impresso
     * @param $idPai - Id da categoria pai
     */
    function imprimeMenuInfinito($idPai = 0, $nivel = 0, $site_id = NULL, $page_active = NULL) {
        $this->autoRender = false;

        $menuTotal = $this->getMenu($site_id);
        $pagina_atual = $this->base . $this->_getPath($page_active);
        #pr($pagina_atual);
        // abrimos a ul do menu principal
        echo str_repeat("\t", $nivel), '<ul>', PHP_EOL;
        // itera o array de acordo com o idPai passado como parâmetro na função
        foreach ($menuTotal[$idPai] as $idMenu => $menuItem) {
            // imprime o item do menu
            if ($pagina_atual == $menuItem['url_key']) {
                echo str_repeat("\t", $nivel + 1), "<li class=\"active\"><a target=\"", $menuItem['target'], "\" href=\"", $menuItem['url_key'], '">', $menuItem['titulo'], '</a>', PHP_EOL;
            } else {
                echo str_repeat("\t", $nivel + 1), "<li><a target=\"", $menuItem['target'], "\" href=\"", $menuItem['url_key'], '">', $menuItem['titulo'], '</a>', PHP_EOL;
            }

            // se o menu desta iteração tiver submenus, chama novamente a função
            if (isset($menuTotal[$idMenu]))
                $this->imprimeMenuInfinito($idMenu, $nivel + 2, $site_id, $page_active);
            // fecha o li do item do menu
            echo str_repeat("\t", $nivel + 1), '</li>', PHP_EOL;
        }
        // fecha o ul do menu principal
        echo str_repeat("\t", $nivel), '</ul>', PHP_EOL;
    }

    function _getPath($id = NULL) {

        $pages = $this->Pagina->getPath($id);
        $path = '';

        $site_id = $this->Pagina->find('first', array(
            'conditions' => array('Pagina.id' => $id),
            'fields' => array('Pagina.site_id')));

        $site_url = $this->Site->find('first', array(
            'conditions' => array('Site.id' => $site_id['Pagina']['site_id']),
            'fields' => array('Site.url_key'),
            'recursive' => 0));
        $path = "/" . $site_url['Site']['url_key'];

        foreach ($pages as $i) {
            $path .= '/' . $i['Pagina']['url_key'];
        }
        return $path;
    }

    function _getListDepth($data) {
        $result = array();
        foreach ($data as $i) {
            $newData = $i;

            $newData['Pagina']['depth'] = count($this->Pagina->getPath($i['Pagina']['id'])) - 1;
            unset($newData['Pagina']['body']);
            unset($newData['children']);
            $result[] = $newData;
            if (is_array($i['children'])) {
                $children = $this->_getListDepth($i['children']);
                foreach ($children as $k) {
                    $result[] = $k;
                }
            }
        }

        return $result;
    }

    function retornaPaginasIrmas($id = NULL) {
        $parent = $this->Pagina->getParentNode($id);
        $content = $this->Pagina->find('all', array(
            'conditions' => array(
                'Pagina.parent_id' => $parent['Pagina']['id'], 
                'Pagina.status' => true, 
                'Pagina.inc_menu' => true),
            'order' => 'lft Asc'));
        
        $result = array();
        foreach ($content as $rg) {
            if ($rg['Pagina']['tipo'] == 1) {
                $rg['Pagina']['url_key'] = $rg['Pagina']['url_key'];
            } else {
                $rg['Pagina']['url_key'] = $this->_getPath($rg['Pagina']['id']);
            }
            $result[] = $rg;
        }
        return $result;
    }

    function view($id = NULL) {
        $this->layout = 'default';
        $content = $this->Pagina->find('first', array(
            'conditions' => array('Pagina.id' => $id, 'Pagina.status' => 1)));

        $this->retornaPaginasIrmas($id);
        $this->set('menu_data', $this->Pagina->find('threaded'));
        if (empty($content)) {
            throw new NotFoundException('Página não encontrada');
        } else {
            $this->set('data', $content['Pagina']);
            $this->set('page_id', $id);
            $this->set('paginas_irmas', $this->retornaPaginasIrmas($id));
        }
    }

    function admin_index() {
        $this->layout = 'admin';

        $this->Paginator->settings = $this->paginate;
        $paginas = $this->Paginator->paginate('Pagina');
        $data = array();
        foreach ($paginas as $row) {
            if ($row['Pagina']['parent_id'] == 0) {
                $row['Pagina']['parent_id'] = 'Nenhuma';
            } else {
                $this->Pagina->id = $row['Pagina']['parent_id'];
                $row['Pagina']['parent_id'] = $this->Pagina->field('nome');
            }
            $data[] = $row;
        }
        $this->set(compact('data'));
    }

    public function admin_add() {
        $this->layout = 'admin';

        $sites = $this->Site->find('list', array(
            'fields' => array('Site.id', 'Site.nome'),
            'conditions' => array('Site.status' => 1),
            'order' => 'nome'));
        $this->set('sites', $sites);
        $paginas = $this->Pagina->generateTreeList(null, '{n}.Pagina.id', '{n}.Pagina.nome', '--', 2);
        $this->set('paginas', $paginas);
        $popups = $this->Popup->find('list', array(
            'fields' => array('Popup.id', 'Popup.titulo'),
            'conditions' => array('Popup.status' => 1),
            'order' => 'Popup.titulo'));
        $this->set('popups', $popups);

        if ($this->request->is('post')) {
            if ($this->Pagina->save($this->request->data)) {
                $page_id = $this->Pagina->getLastInsertId();
                $page = $this->Pagina->findById($page_id);
                if ($page['Pagina']['tipo'] == 0) {
                    $route = "Router::connect('" . $this->_getPath($page_id) . "', array('controller' => 'paginas', 'action' => 'view', '" . $page_id . "'));";
                    $this->Route->add($route);
                }
                $this->Session->setFlash('Cadastro Efetuado com Sucesso', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Erro no Cadastro', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    function admin_edit($id = null) {
        $this->layout = 'admin';
        $sites = $this->Site->find('list', array(
            'fields' => array('Site.id', 'Site.nome'),
            'conditions' => array('Site.status' => 1),
            'order' => 'nome'));
        $this->set('sites', $sites);
        $paginas = $this->Pagina->generateTreeList(null, '{n}.Pagina.id', '{n}.Pagina.nome', '--', true);
        $this->set('paginas', $paginas);
        $popups = $this->Popup->find('list', array(
            'fields' => array('Popup.id', 'Popup.titulo'),
            'conditions' => array('Popup.status' => 1),
            'order' => 'Popup.titulo'));
        $this->set('popups', $popups);

        if (!empty($this->data)) {
            if ($this->Pagina->save($this->data)) {
                $this->Session->setFlash('Página Atualizada', 'default', array('class' => 'alert alert-success'));
                $this->redirect($this->referer());
            }
//            if ($this->data['Pagina']['parent_id'] == $this->data['Pagina']['id']) {
//                $this->Session->setFlash('Esta página não pode ser pai dela mesma', 'default', array('class' => 'alert alert-error'));
//            } else {
//                $page = $this->Pagina->findById($id);
//                $this->request->data('Pagina.old_parent_id', $page['Pagina']['parent_id'])->data('Pagina.old_path', $this->_getPath($page['Pagina']['id']));
//                if ($this->Pagina->save($this->data)) {
//                    if ($this->data['Pagina']['old_parent_id'] != $this->data['Pagina']['parent_id']) {
//                        $route = "Router::connect('" . $this->data['Pagina']['old_path'] . "', array('controller' => 'paginas', 'action' => 'view', '" . $this->data['Pagina']['id'] . "'));";
//                        $this->Route->remove($route);
//                        $route = "Router::connect('" . $this->_getPath($this->data['Pagina']['id']) . "', array('controller' => 'paginas', 'action' => 'view', '" . $this->data['Pagina']['id'] . "'));";
//                        $this->Route->add($route);
//                    }
//                    $this->Session->setFlash('Página Atualizada', 'default', array('class' => 'good'));
//                    $this->redirect('index');
//                }
//            }
        } else {
            $page = $this->Pagina->findById($id);
            if (empty($page)) {
                $this->Session->setFlash('ID de Página Inválido', 'default', array('class' => 'alert alert-error'));
                $this->redirect($this->referer());
            } else {
                $this->data = $page;
            }
        }
    }

    function admin_delete($id) {
        $page = $this->Pagina->findById($id);
        if (empty($page)) {
            $this->Session->setFlash('ID de Página Inválido', 'default', array('class' => 'alert alert-error'));
        } else {
            $path = $this->_getPath($id);
            if ($this->Pagina->delete($id)) {
                $route = "Router::connect('" . $path . "', array('controller' => 'paginas', 'action' => 'view', '" . $page['Pagina']['id'] . "'));";
                $this->Route->remove($route);
                $this->Session->setFlash('Página deletada', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Falha ao tentar deletar a página', 'default', array('class' => 'alert alert-error'));
            }
        }
        $this->redirect($this->referer());
    }

    public function admin_movedown($id = null, $delta = null) {
        $this->Pagina->id = $id;
        if (!$this->Pagina->exists()) {
            throw new NotFoundException(__('Página inválida'));
        }

        if ($delta > 0) {
            $this->Pagina->moveDown($this->Pagina->id, abs($delta));
        } else {
            $this->Session->setFlash('Por favor informe o número de posições que o registro deve ser movido para baixo', 'default', array('class' => 'alert alert-error'));
        }

        return $this->redirect($this->referer());
    }

    public function admin_moveup($id = null, $delta = null) {
        $this->Pagina->id = $id;
        if (!$this->Pagina->exists()) {
            throw new NotFoundException(__('Página inválida'));
        }

        if ($delta > 0) {
            $this->Pagina->moveUp($this->Pagina->id, abs($delta));
        } else {
            $this->Session->setFlash('Por favor informe o número de posições que o registro deve ser movido para cima', 'default', array('class' => 'alert alert-error'));
        }

        return $this->redirect($this->referer());
    }

}

