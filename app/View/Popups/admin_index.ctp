<h1>Popups</h1>
<hr />

<a class="btn btn-primary" href="<?php echo Router::url(array('action' => 'add')); ?>"><i class="icon-plus icon-white"></i> Adicionar Popup</a>

<hr />

<table class="table table-hover">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
            <th><?php echo $this->Paginator->sort('titulo', 'Titulo'); ?></th>
            <th><?php echo $this->Paginator->sort('status', 'Status'); ?></th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($data)): ?>
            <tr>
                <td colspan="6" style="text-align: center;">Nenhum Registro Encontrado.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($data as $recipe): ?>

                <tr  <?php if ($recipe['Popup']['status'] != 1) echo 'class="warning"' ?>>
                    <td><?php echo $recipe['Popup']['id']; ?> </td>
                    <td><?php echo h($recipe['Popup']['titulo']); ?> </td>
                    <td><?php echo ($recipe['Popup']['status'] == 1) ? "Ativo" : "Inativo"; ?> </td>
                    <td>
                        <a class="btn btn-danger btn-mini" onclick="return confirm('Você tem certeza que deseja excluir o registro #<?php echo $recipe['Popup']['id'] ?>?');" href="<?php echo Router::url(array('action' => 'delete', $recipe['Popup']['id'])); ?>"><i class="icon-remove icon-white"></i>Excluir</a>
                        <a class="btn btn-primary btn-mini" href="<?php echo Router::url(array('action' => 'edit', $recipe['Popup']['id'])); ?>"><i class="icon-edit icon-white"></i>Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
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