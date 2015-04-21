<?php
class Site extends AppModel {
    var $name = 'Site';
    var $useTable = 'sites';
    
    public $hasMany = array(
        'Pagina' => array(
            'className' => 'Pagina',
            'order' => 'Pagina.created DESC'
        )
    );
    
    public $validate = array(
        'nome' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        'url_key' => array(
            'rule' => array('between', 3, 30),
            'message' => "A url deve conter de 3 a 30 caracteres.")
    );
}
?>