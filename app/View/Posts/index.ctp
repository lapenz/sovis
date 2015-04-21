<?php
echo $this->Html->css(array('bootstrap'));
?>

<div class="row">
    <div class="span8">
        <h4>Posts</h4>
        <table class="table">

            <?php foreach ($data as $article) {
                ?>
                <tr>
                    <td rowspan="2"><h5><?php echo $this->Time->format('d/m/y, h:i', $article['Post']['created']);?></h5></td>
                    <td><h3><a href="<?= $this->base ?>/posts/view/<?= $article['Post']['id'] ?>"><?php echo $article['Post']['title'] ?></a></h3></td>

                </tr>
                <tr><td><?php echo substr($article['Post']['body'], 0, $blogConfig['BlogConfig']['tam_preview']) ?>...  <a href="<?= $this->base ?>/posts/view/<?= $article['Post']['id'] ?>">Ver Mais</a></td></tr>

            <?php } ?>     

        </table>
        <hr />

        <div class="pagination">
            <ul>
                <?php echo $this->Paginator->prev('«', array('tag' => 'li')); ?>
                <?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => null, 'currentClass' => "active")); ?>
                <?php echo $this->Paginator->next('»', array('tag' => 'li')); ?>

            </ul>

        </div>
        <?php echo $this->Paginator->counter('Total de {:count} posts encontrados'); ?>

        <hr />
    </div>
    <div class="span3">
        <h4>Categorias</h4>
        <table class="table">
            
            <?php foreach ($categorias as $categoria) {
                ?>
                <tr>
                    <td><h3><a href="<?= $this->base ?>/posts/indexByCategoria/<?= $categoria['Categoria']['id'] ?>"><?php echo $categoria['Categoria']['description'] ?></a></h3></td>

                </tr>

            <?php } ?>     
                
        </table>
    </div>
</div>




