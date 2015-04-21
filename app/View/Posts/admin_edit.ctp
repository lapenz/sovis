<h1>Editar Post</h1>

<?php 
echo $this->Html->script('ckeditor/ckeditor');

echo $this->Form->create('Post', array('enctype' => 'multipart/form-data')); ?>

<?php
echo $this->Form->input('categoria_id', array('options' => $categorias, 'label' => 'Categoria', 'empty' => 'Vazio'));
echo $this->Form->input('title', array('label' => 'Título'));
echo $this->Form->input('body', array('type' => 'textarea', 'label' => 'Conteúdo', 'class' => 'ckeditor'));

echo $this->Form->input('dir', array('type' => 'hidden'));
echo $this->Form->input('mimetype', array('type' => 'hidden'));
echo $this->Form->input('filesize', array('type' => 'hidden'));
?>

<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
?>