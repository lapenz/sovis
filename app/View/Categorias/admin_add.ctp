<h1>Adicionar Categoria</h1>
<?php
echo $this->Form->create('Categoria', array('enctype' => 'multipart/form-data'));
?>
<hr />

<?php
echo $this->Form->input('description', array('label' => 'Descrição'));
?>

<?php echo '<br/>'; ?>

<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
?>
