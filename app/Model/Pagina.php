<?php

class Pagina extends AppModel {

    var $name = 'Pagina';
    var $useTable = 'paginas';
    public $actsAs = array('Tree');
    public $belongsTo = 'Site';
    public $hasMany = array(
        'Banner' => array(
            'className' => 'Banner',
            'order' => 'Banner.created DESC',
            'dependent' => true
        )
    );
    public $validate = array(
        'titulo' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        'site_id' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        'url_key' => array(
            'rule' => array('between', 3, 30),
            'message' => 'A url deve conter de 3 a 30 caracteres.')
    );

}

?>