<h1>Editar Banner</h1>

<?php echo $this->Form->create('Banner', array('enctype' => 'multipart/form-data')); ?>

<?php
echo $this->Form->input('status', array('label' => 'Ativo', 'type' => 'checkbox'));
echo $this->Form->input('img', array(
    'label' => 'Imagem (960px X 260px)',
    'type' => 'file'));
echo $this->Form->input('url', array(
    'label' => 'Link'));
echo $this->Form->input('alt', array(
    'label' => 'Palavras Chave'));
echo $this->Form->input('posicao', array(
    'label' => 'Posição (Ex: 1)',
    'default' => 1,
    'type' => 'number',
    'min' => 1,
    'max' => 999999));
echo $this->Form->input('pagina_id', array('options' => $paginas, 'label' => 'Página', 'empty' => 'Vazio'));
echo $this->Form->input('dir', array('type' => 'hidden'));
echo $this->Form->input('mimetype', array('type' => 'hidden'));
echo $this->Form->input('filesize', array('type' => 'hidden'));

echo $this->Form->input('id', array('type' => 'hidden'));
?>
<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
?>