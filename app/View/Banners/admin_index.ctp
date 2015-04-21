<h1>Banners</h1>
<hr />

<a class="btn btn-primary" href="<?php echo Router::url(array('action' => 'add')); ?>"><i class="icon-plus icon-white"></i> Adicionar Banner</a>
<hr />

<table class="table clearfix">
    <tr>
        <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
        <th>Imagem</th>
        <th><?php echo $this->Paginator->sort('pagina_id', 'Página'); ?></th>
        <th><?php echo $this->Paginator->sort('posicao', 'Posição'); ?></th>
        <th><?php echo $this->Paginator->sort('status', 'Status'); ?></th>
        <th>Ações</th>
    </tr>
    <?php if (empty($data)): ?>
        <tr>
            <td colspan="3" style="text-align: center;">Nenhum Registro Encontrado.</td>
        </tr>
    <?php else: ?>
        <?php #pr($data); ?>

        <?php foreach ($data as $recipe): ?>

            <tr <?php if ($recipe['Banner']['status'] != 1) echo 'class="warning"' ?>>
                <td>
                    <?php echo $recipe['Banner']['id'] ?>
                </td>
                <td>
                    <a data-toggle="modal" href="#myModal<?php echo $recipe['Banner']['id'] ?>" target="_blank" >
                        <img src="<?php echo $this->base; ?>/uploads/banner/img/<?php echo $recipe['Banner']['img']; ?>" alt="" width="400" />
                    </a>
                    <div id="myModal<?php echo $recipe['Banner']['id'] ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Banner #<?php echo $recipe['Banner']['id'] ?></h3>
                        </div>
                        <div class="modal-body">
                            <p><img src="<?php echo $this->base; ?>/uploads/banner/img/<?php echo $recipe['Banner']['img']; ?>" alt="" /></p>
                        </div>
                        <div class="modal-footer">
                            <?php if ($recipe['Banner']['status'] == 1): ?>
                                <a class="btn btn-warning btn-mini" href="<?php echo Router::url(array('action' => 'editBannerSituacao', $recipe['Banner']['id'])); ?>"><i class="icon-ban-circle icon-white"></i>Inativar</a>
                            <?php else: ?>
                                <a class="btn btn-success btn-mini" href="<?php echo Router::url(array('action' => 'editBannerSituacao', $recipe['Banner']['id'], 1)); ?>"><i class="icon-ok icon-white"></i>Ativar</a>
                            <? endif; ?>
                            <a class="btn btn-primary btn-mini" href="<?php echo Router::url(array('action' => 'edit', $recipe['Banner']['id'])); ?>"><i class="icon-edit icon-white"></i>Editar</a>

                            <a class="btn btn-danger btn-mini" onclick="return confirm('Você tem certeza que deseja excluir o registro #<?php echo $recipe['Banner']['id'] ?>?');" href="<?php echo Router::url(array('action' => 'delete', $recipe['Banner']['id'])); ?>"><i class="icon-remove icon-white"></i>Excluir</a>

                        </div>
                    </div>
                </td>
                <td>
                    <?php echo $recipe['Pagina']['Site']['nome'] . ' - ' . $recipe['Pagina']['titulo'] ?>
                </td>
                <td>
                    <?php echo $recipe['Banner']['posicao'] ?>
                </td>
                <td >
                    <?php
                    if ($recipe['Banner']['status'] == 1)
                        echo 'Ativo';
                    else
                        echo 'Inativo';
                    ?>
                </td>
                <td class="actions" >
                    <p>
                        <?php if ($recipe['Banner']['status'] == 1): ?>
                            <a class="btn btn-warning btn-mini" href="<?php echo Router::url(array('action' => 'editBannerSituacao', $recipe['Banner']['id'])); ?>"><i class="icon-ban-circle icon-white"></i>Inativar</a>
                        <?php else: ?>
                            <a class="btn btn-success btn-mini" href="<?php echo Router::url(array('action' => 'editBannerSituacao', $recipe['Banner']['id'], 1)); ?>"><i class="icon-ok icon-white"></i>Ativar</a>
                        <? endif; ?>
                    </p>
                    <p>
                        <a class="btn btn-primary btn-mini" href="<?php echo Router::url(array('action' => 'edit', $recipe['Banner']['id'])); ?>"><i class="icon-edit icon-white"></i>Editar</a>
                    </p>
                    <p>
                        <a class="btn btn-danger btn-mini" onclick="return confirm('Você tem certeza que deseja excluir o registro #<?php echo $recipe['Banner']['id'] ?>?');" href="<?php echo Router::url(array('action' => 'delete', $recipe['Banner']['id'])); ?>"><i class="icon-remove icon-white"></i>Excluir</a>
                    </p>
                </td>
            </tr>

        <?php endforeach; ?>
    <?php endif; ?>
</table>

<hr />

<div class="pagination">
    <ul>
        <?php echo $this->Paginator->prev('«', array('tag' => 'li')); ?>
        <?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => null, 'currentClass' => "active")); ?>
        <?php echo $this->Paginator->next('»', array('tag' => 'li')); ?>

    </ul>

</div>
<?php echo $this->Paginator->counter('Total de {:count} registros encontrados'); ?>

<hr />