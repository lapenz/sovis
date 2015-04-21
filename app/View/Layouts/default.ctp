<?php
/**
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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            Sovis - 
            <?php echo $data['titulo']; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array('style', 'menu', 'bootstrap.min'));

        echo $this->Html->script(array('jquery-1.6.min', 'bootstrap.min.js'));

        $this->Html->meta("keywords", $data['keywords'], array("inline" => false));
        $this->Html->meta("description", $data['description'], array("inline" => false));
        $this->Html->meta("author", 'Lucas Arthur Penz', array("inline" => false));
        $this->Html->meta("robots", 'index,follow', array("inline" => false));
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        ?>
        
        <meta property="og:title" content="Sovis Sistemas - <?php echo $data['titulo']; ?>" />
        <meta property="og:type" content="company" />
        <meta property="og:url" content="<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];?>" />
        <meta property="og:image" content="http://a2.twimg.com/profile_images/153896826/logotipo_sovis_reasonably_small.jpg" />
        <meta property="og:site_name" content="Sovis Sistemas" />
        <meta property="fb:admins" content="100001830665881" />
    </head>
    <body class="clearfix">
        <?php echo $this->element('analytics'); ?>
        <?php echo $this->element('facebook'); ?>
        
        <?php $header = $this->requestAction(array('controller'=>'blocos', 'action'=>'exibe', $data['site_id'], 1));
        $url_atendimento = $this->requestAction(array('controller'=>'sites', 'action'=>'getUrlAtendimento', $data['site_id'])); ?>

        <a href="<?php echo $url_atendimento['Site']['url_atendimento']; ?>" target="_blank"><div class="atendimento-right"></div></a>

        <div class="top-large clearfix">
            <div class="top clearfix">
                <div id="logo">
                    <a href="<?php echo $this->base; ?>"><?php echo $this->Html->image('topo/logo.png', array('alt' => '')); ?></a>
                </div>
                <div id="header">
                  <?php echo $header['Bloco']['conteudo']; ?>
                </div>
            </div>
        </div>
        <div class="top-bottom clearfix">
            <div class="top clearfix">
                <div id='cssmenu'>
                <?php echo $this->requestAction('paginas/imprimeMenuInfinito/0/0/'.$data['site_id'].'/'.$this->params['pass'][0], array('return'));     ?>
                </div>               
            </div>
        </div>

        <div id="container" class="clearfix">

            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->element('banner'); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>

        <div id="footer" class="clearfix"> 

            <div id="footer-content">
                <?php $footer = $this->requestAction(array('controller'=>'blocos', 'action'=>'exibe', $data['site_id'], 2)); 
                echo $footer['Bloco']['conteudo'];
                ?>
            </div>
        </div>
        <?php echo $this->element('popup'); ?>
    </body>
</html>
