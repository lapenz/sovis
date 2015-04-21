<?php

class PostsController extends AppController {

    public $name = 'Posts';
    public $uses = array('Post', 'Categoria', 'BlogConfig');
    var $components = array('Paginator');
    public $paginate = array(
        'limit' => 15,
        'recursive' => 2,
        'contain' => array('Categoria'),
        'order' => array(
            'id' => 'asc', 'categoria_id' => 'asc'
        )
    );

    function beforeFilter() {
        $this->Auth->allow('index', 'view');
    }

    public function index() {
        $this->layout = 'ajax';

        $blogConfig = $this->BlogConfig->find('first', array('conditions' => array('BlogConfig.id' => 1)));
        $this->set('blogConfig', $blogConfig);

        $categorias = $this->Categoria->find('all');
        $this->set('categorias', $categorias);

        try {
            $this->Paginator->settings = array(
                'limit' => $blogConfig['BlogConfig']['qtd_posts'],
                'recursive' => 2,
                'contain' => array('Categoria'),
                'order' => array('created' => 'desc'));
            $data = $this->Paginator->paginate('Post');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            $this->redirect($this->referer());
        }
    }

    public function indexByCategoria($id = NULL) {
        $this->layout = 'ajax';

        $blogConfig = $this->BlogConfig->find('first', array('conditions' => array('BlogConfig.id' => 1)));
        $this->set('blogConfig', $blogConfig);

        $categorias = $this->Categoria->find('all');
        $this->set('categorias', $categorias);
        
        $this->Categoria->id = $id;
        $categoria = $this->Categoria->read();
        $this->set('categoria', $categoria);

        try {
            $this->Paginator->settings = array(
                'conditions' => array('categoria_id' => $id),
                'limit' => $blogConfig['BlogConfig']['qtd_posts'],
                'recursive' => 2,
                'contain' => array('Categoria'),
                'order' => array('created' => 'desc'));
            $data = $this->Paginator->paginate('Post');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            $this->redirect($this->referer());
        }
    }
    
    public function indexByCategorias($ids = NULL) {
        $this->layout = 'ajax';

        $blogConfig = $this->BlogConfig->find('first', array('conditions' => array('BlogConfig.id' => 1)));
        $this->set('blogConfig', $blogConfig);

        $categorias = $this->Categoria->find('all');
        $this->set('categorias', $categorias);
        $ids = explode('-', $ids);

        try {
            $this->Paginator->settings = array(
                'conditions' => array('categoria_id' => $ids),
                'limit' => $blogConfig['BlogConfig']['qtd_posts'],
                'recursive' => 2,
                'contain' => array('Categoria'),
                'order' => array('created' => 'desc'));
            $data = $this->Paginator->paginate('Post');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            $this->redirect($this->referer());
        }
    }

    public function view($id = null) {
        $this->layout = 'ajax';
        
        $this->Post->id = $id;
        $post = $this->Post->read();
        $this->set('post', $post);
        
        $this->Categoria->id = $post['Post']['categoria_id'];
        $categoria = $this->Categoria->read();
        $this->set('categoria', $categoria);
        
        $ultimos_posts = $this->Post->find('all', array('order' => 'created DESC', 'limit' => 6));
        $this->set('ultimos_posts', $ultimos_posts);
        
        $posts_relacionados = $this->Post->find('all', array('conditions' => array('categoria_id' => $post['Post']['categoria_id']), 'order' => 'created DESC', 'limit' => 6));
        $this->set('posts_relacionados', $posts_relacionados);

        $categorias = $this->Categoria->find('all', array('order' => 'description ASC'));
        $this->set('categorias', $categorias);
    }

    public function admin_index() {
        $this->layout = 'admin';

        try {
            $this->Paginator->settings = $this->paginate;
            $data = $this->Paginator->paginate('Post');

            $this->set(compact('data'));
        } catch (NotFoundException $e) {
            $this->redirect($this->referer());
        }
    }

    public function admin_add() {
        $this->layout = 'admin';
        $categorias = $this->Categoria->find('list', array('fields' => array('id', 'description')));
        $this->set('categorias', $categorias);
        if ($this->request->is('post')) {
            #pr($this->data);
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Cadastro Efetuado com Sucesso', 'default', array('class' => 'alert alert-success'));
                $this->redirect('index');
            } else {
                $this->Session->setFlash('Erro no Cadastro', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->layout = 'admin';

        $this->Post->id = $id;

        $categorias = $this->Categoria->find('list', array('fields' => array('id', 'description')));
        $this->set('categorias', $categorias);
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->read();
        } else {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Post atualizado', 'default', array('class' => 'alert alert-success'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Não foi possível atualizar', 'default', array('class' => 'alert alert-error'));
            }
        }
    }

    public function admin_delete($id = NULL) {
        $banner = $this->Post->findById($id);
        if (empty($banner)) {
            $this->Session->setFlash('ID Inválido', 'default', array('class' => 'alert alert-error'));
        } else {
            if ($this->Post->delete($id)) {
                $this->Session->setFlash('Registro deletado', 'default', array('class' => 'alert alert-success'));
            } else {
                $this->Session->setFlash('Falha ao tentar deletar o registro', 'default', array('class' => 'alert alert-error'));
            }
        }
        $this->redirect($this->referer());
    }

}
