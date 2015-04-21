<?php
echo $this->Html->css(array('bootstrap'));
?>
<div class="row">
    <div class="span8">
        <h3><?php echo $post['Categoria']['description'] ?></h3>
        <hr/>
        <h2><?php echo $post['Post']['title'] ?></h2>

        <p><small>Criado em: <?php echo $this->Time->format('d/m/y, h:i', $post['Post']['created']); ?></small></p>

        <p><?php echo $post['Post']['body'] ?></p>
        <hr/>
        <h4>Posts relacionados</h4>
        <?php foreach ($posts_relacionados as $rg) { ?>
            <h6><a href="<?= $this->base ?>/posts/view/<?= $rg['Post']['id'] ?>"><?php echo $rg['Post']['title'] ?></a><br/></h6>

        <?php } ?>
        <hr/>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=519452708118961";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-comments" data-href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER ['REQUEST_URI']; ?>" data-numposts="5" data-colorscheme="light"></div>


    </div>
    <div class="span3">
        <h3>Últimos Artigos</h3>
        <table class="table">

<?php foreach ($ultimos_posts as $rg) {
    ?>
                <tr>
                    <td><h4><a href="<?= $this->base ?>/posts/view/<?= $rg['Post']['id'] ?>"><?php echo $rg['Post']['title'] ?></a><br/></h4><?php echo $this->Time->format('d/m/y, h:i', $rg['Post']['created']); ?></td>

                </tr>

<?php } ?>     
            <tr>
                <td><a href="<?= $this->base ?>/posts/index/">+ Ver todos os artigos</a></td>
            </tr>
        </table>
        <h3>Categorias</h3>
        <table class="table">

<?php foreach ($categorias as $rg) {
    ?>
                <tr>
                    <td><h4><a href="<?= $this->base ?>/posts/indexByCategoria/<?= $rg['Categoria']['id'] ?>"><?php echo $rg['Categoria']['description'] ?></a></h4></td>

                </tr>

<?php } ?>     
        </table>
    </div>
</div>