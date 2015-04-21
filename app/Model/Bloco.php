<?php
class Bloco extends AppModel {
    var $name = 'Bloco';
    var $useTable = 'blocos';
    public $belongsTo = 'Site';

    public $validate = array(
        'titulo' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        'site_id' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        'conteudo' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
    );
}
?>