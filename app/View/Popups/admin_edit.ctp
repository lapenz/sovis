<h1>Editar Popup</h1>
<?php
echo $this->Html->script('ckeditor/ckeditor');

echo $this->Form->create('Popup', array('enctype' => 'multipart/form-data'));
?>
<hr />
<?php
echo $this->Form->submit('Salvar', array('class' => 'btn btn-success'));
?>

<hr/>

<?php
echo $this->Form->input('titulo', array('label' => 'Título'));
echo $this->Form->input('status', array('options' => array('0' => 'Inativo', '1' => 'Ativo')));
echo $this->Form->input('conteudo', array('type' => 'textarea', 'label' => 'Conteúdo', 'class' => 'ckeditor'));
?>

<?php echo '<br/>'; ?>


<?php
echo $this->Form->input('dir', array('type' => 'hidden'));
echo $this->Form->input('mimetype', array('type' => 'hidden'));
echo $this->Form->input('filesize', array('type' => 'hidden'));
echo $this->Form->input('id', array('type' => 'hidden'));
?>



<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));

?>
