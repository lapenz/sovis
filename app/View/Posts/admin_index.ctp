<h1>Posts</h1>
<hr />

<a class="btn btn-primary" href="<?php echo Router::url(array('action' => 'add')); ?>"><i class="icon-plus icon-white"></i> Adicionar Post</a>
<hr />

<table class="table clearfix">
    <tr>
        <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
        <th><?php echo $this->Paginator->sort('categoria_id', 'Categoria'); ?></th>
        <th><?php echo $this->Paginator->sort('title', 'Título'); ?></th>
        <th>Ações</th>
    </tr>
    <?php if (empty($data)): ?>
        <tr>
            <td colspan="4" style="text-align: center;">Nenhum Registro Encontrado.</td>
        </tr>
    <?php else: ?>
        <?php #pr($data); ?>

        <?php foreach ($data as $recipe): ?>

            <tr>
                <td>
                    <?php echo $recipe['Post']['id'] ?>
                </td>
                <td>
                    <?php echo $recipe['Categoria']['description'] ?>
                </td>

                <td>
                    <?php echo $recipe['Post']['title'] ?>
                </td>


                <td class="actions" >
                    <a class="btn btn-primary btn-mini" href="<?php echo Router::url(array('action' => 'edit', $recipe['Post']['id'])); ?>"><i class="icon-edit icon-white"></i>Editar</a>

                    <a class="btn btn-danger btn-mini" onclick="return confirm('Você tem certeza que deseja excluir o registro #<?php echo $recipe['Post']['id'] ?>?');" href="<?php echo Router::url(array('action' => 'delete', $recipe['Post']['id'])); ?>"><i class="icon-remove icon-white"></i>Excluir</a>
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