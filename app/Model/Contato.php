<?php

class Contato extends AppModel {

    public $useTable = false;

    public $validate = array(
        'nome' => array(
            'rule' => 'notempty',
            'message' => "O nome deve ser preenchido",
        ),
        'email' => array(
            'rule' => array('email'),
            'message' => "O e-mail deve ser preenchido",
        ),
        'telefone' => array(
            'rule' => 'notempty',
            'message' => "O telefone deve ser preenchido",
        ),
        'area' => array(
            'rule' => 'notempty',
            'message' => "A área deve ser preenchida",
        ),
        'estado' => array(
            'rule' => array('notempty'),
            'message' => "O estado deve ser preenchido",
        ),
        'cidade' => array(
            'rule' => array('notempty'),
            'message' => "A cidade deve ser preenchida",
        ),
        'como_encontrou' => array(
            'rule' => 'notempty',
            'message' => "Selecione uma opção",
        ),
        'mensagem' => array(
            'rule' => 'notempty',
            'message' => "A mensagem deve ser preenchida",
        ),
        'arquivo' => array(
            'rule' => array('extension', array('doc', 'docx', 'pdf')),
            'message' => "Selecione um arquivo no formato doc, docx ou pdf",
        ),
        'assunto' => array(
            'rule' => 'notempty',
            'message' => "Selecione um assunto",
        )
    );

}
