<?php

class Post extends AppModel {

    var $name = 'Post';

    public $belongsTo = 'Categoria';
    
    public $validate = array(
        'title' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        
        'categoria_id' => array(
            'rule' => array('notEmpty'),
            'message' => 'Selecione uma categoria.'),
        
        'body' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.')
    );

}
