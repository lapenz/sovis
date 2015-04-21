<?php

class Popup extends AppModel {

    var $name = 'Popup';
    var $useTable = 'popups';
    public $validate = array(
        'titulo' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        'conteudo' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
    );

}

?>