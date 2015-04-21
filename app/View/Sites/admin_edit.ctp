<h1>Editar Site</h1>
<?php
echo $this->Html->script('ckeditor/ckeditor');

echo $this->Form->create('Site', array('enctype' => 'multipart/form-data'));
?>
<hr />
<?php
echo $this->Form->submit('Salvar', array('class' => 'btn btn-success'));
?>

<hr/>

<?php
echo $this->Form->input('nome', array('label' => 'Nome'));

echo $this->Form->input('status', array('options' => array('0' => 'Inativo', '1' => 'Ativo')));

echo $this->Form->input('url_key', array('label' => 'URL Chave', 'placeholder' => 'site'));
echo $this->Form->input('url_atendimento', array('label' => 'URL do Atendimento', 'placeholder' => 'http://www.site.com.br'));
echo $this->Form->input('pagina_id', array('label' => 'URL de Página Inicial', 'options' => $paginas));
?>

<?php echo '<br/>'; ?>

<?php
echo $this->Form->input('id', array('type' => 'hidden'));
?>



<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
?>
