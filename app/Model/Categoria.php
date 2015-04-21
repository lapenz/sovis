<?php

class Categoria extends AppModel {

    var $name = 'Categoria';
    var $useTable = 'categorias';
    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'order' => 'Post.created DESC',
            'dependent' => true
        )
    );
    public $validate = array(
        'description' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.')
    );

}

?>