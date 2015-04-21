<!DOCTYPE html>
<html lang="pt-br">
    <head>


        <?php echo $this->Html->charset(); ?>
        <title>Administrativo </title>
        <?php
        echo $this->Html->meta('icon');


        echo $this->Html->script(array('jquery-1.8.2.min.js', 'bootstrap.min.js'));
        echo $this->Html->css(array('bootstrap-responsive', 'bootstrap'));
        ?>
    </head>
    <body class="clearfix">

        <div class="container">
            <div class="navbar navbar-inverse">
                <div class="navbar-inner">
                    <div class="container">

                        <!-- Be sure to leave the brand out there if you want it shown -->
                        <a class="brand" href="<?= $this->base ?>">< Voltar ao site</a>
                        
                        <!-- Everything you want hidden at 940px or less, place within here -->
                        <div class="nav-collapse collapse">
                            <!-- .nav, .navbar-search, .navbar-form, etc -->
                        </div>

                    </div>
                </div>
            </div>
            <div class="alert">
                
                <?php echo $this->Session->flash(); ?>
            </div>


            <?php echo $this->fetch('content'); ?>

        </div>
    </body>
</html>
