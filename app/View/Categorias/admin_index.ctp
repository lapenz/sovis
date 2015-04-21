<h1>Categorias</h1>
<hr />

<a class="btn btn-primary" href="<?php echo Router::url(array('action' => 'add')); ?>"><i class="icon-plus icon-white"></i> Adicionar Categoria</a>

<hr />

<table class="table  table-hover">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
            <th><?php echo $this->Paginator->sort('description', 'Descrição'); ?></th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $recipe): ?>

            <tr>
                <td><?php echo $recipe['Categoria']['id']; ?> </td>
                <td><?php echo h($recipe['Categoria']['description']); ?> </td>
                <td>
                    <a class="btn btn-danger btn-mini" onclick="return confirm('Você tem certeza que deseja excluir o registro #<?php echo $recipe['Categoria']['id']?>?');" href="<?php echo Router::url(array('action' => 'delete', $recipe['Categoria']['id'])); ?>"><i class="icon-remove icon-white"></i>Excluir</a>
                    <a class="btn btn-primary btn-mini" href="<?php echo Router::url(array('action' => 'edit', $recipe['Categoria']['id'])); ?>"><i class="icon-edit icon-white"></i>Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>



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