<!DOCTYPE html>
<html lang="pt-br">
    <head>


        <?php echo $this->Html->charset(); ?>
        <title>Administrativo </title>
        <?php
        echo $this->Html->meta('icon');


        echo $this->Html->script(array('jquery-1.8.2.min.js', 'bootstrap.min.js'));
        echo $this->Html->css(array('bootstrap', 'bootstrap-responsive.min'));
        ?>
    </head>
    <body style="padding-top: 70px">
        <!-- Be sure to leave the brand out there if you want it shown -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li <?php if ($this->params['controller'] == 'popups') echo 'class="active"' ?>><a href="<?= $this->base ?>/admin/popups">Popups</a></li>
                            <li <?php if ($this->params['controller'] == 'blocos') echo 'class="active"' ?>><a href="<?= $this->base ?>/admin/blocos">Blocos</a></li>
                            <li <?php if ($this->params['controller'] == 'banners') echo 'class="active"' ?>><a href="<?= $this->base ?>/admin/banners">Banners</a></li>
                            <li <?php if ($this->params['controller'] == 'sites') echo 'class="active"' ?>><a href="<?= $this->base ?>/admin/sites">Sites</a></li>                           
                            <li <?php if ($this->params['controller'] == 'paginas') echo 'class="active"' ?>><a href="<?= $this->base ?>/admin/paginas" >Páginas</a></li>
                            
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->base ?>/admin/categorias">Categorias</a></li>
                                    <li><a href='<?= $this->base ?>/admin/posts'>Posts</a></li>
                                    <li><a href='<?= $this->base ?>/admin/blog_configs/edit/1'>Configurações</a></li>
                                </ul>
                            </li>
                            <li class="divider-vertical"></li>
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opções <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href='<?= $this->base ?>/admin/users/edit/1'>Alterar Senha</a></li>
                                    <li><a href='<?= $this->base ?>/admin/configs/edit/1'>Configurações</a></li>
                                    <li class="divider"></li>
                                    <li><a href='<?= $this->base ?>/users/logout'>Sair</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>

            <footer><p><small>Desenvolvido por <a target="_blank" href="http://about.me/lucaspenz">Lucas Arthur Penz</a></small></p></footer>
        </div>
        <?php echo $this->element('ckfinder'); ?>
    </body>
</html>
