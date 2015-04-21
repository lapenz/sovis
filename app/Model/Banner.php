<?php

class Banner extends AppModel {

    var $name = 'Banner';
    public $actsAs = array(
        'MeioUpload' => array(
            'img' => array(
                'allowEmpty' => false,
                'allowed_ext' => array('.jpg', '.jpeg', '.png'),
//                'thumbsizes' => array(
//                    'normal' => array('width' => 706, 'height' => 271)
//                )
            )
        )
    );
    public $belongsTo = 'Pagina';
    
    public $validate = array(
        'nome' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.'),
        
        'pagina_id' => array(
            'rule' => array('notEmpty'),
            'message' => 'Este campo não pode ficar vazio.')
    );

}
