<?php

echo $this->Html->script('jquery.maskedinput-1.3.min');
echo $this->Html->css(array('bootstrap'));
?>
<script type="text/javascript">
    jQuery(function($) {
        $("#ContatoCelular").mask("(99) 9999-9999");
        $("#ContatoTelefone").mask("(99) 9999-9999");
    });
</script>
    <?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create('Contato', array('enctype' => 'multipart/form-data')) ?>

<?php echo $this->Form->input('nome', array('label' => 'Nome:')) ?>

<?php echo $this->Form->input('email', array('label' => 'E-mail:')) ?>

<?php echo $this->Form->input('celular', array('label' => 'Celular:')) ?>

<?php echo $this->Form->input('telefone', array('label' => 'Telefone:')) ?>

<?php
echo $this->Form->input('area', array(
    'label' => 'Área de interesse:',
    'options' => array('Comercial' => 'Comercial', 'Desenvolvimento' => 'Desenvolvimento', 'Financeiro' => 'Financeiro',
        'Suporte' => 'Suporte', 'Outros' => 'Outros'),
    'empty' => 'Selecione'))
?>
<?php
echo $this->Form->input('como_encontrou', array(
    'label' => 'Como nos encontrou:',
    'options' => array('Google' => 'Google', 'Amigo' => 'Amigo', 'Revista' => 'Revista',
        'Lista telefônica' => 'Lista telefônica', 'Email' => 'Email', 'Outros' => 'Outros'),
    'empty' => 'Selecione'))
?>

<?php
echo $this->Form->input('observacao', array(
    'label' => 'Observação:',
    'type' => 'textarea'))
?>

<?php

echo $this->Form->input('arquivo', array(
    'label' => 'Selecione seu curriculum para enviar para a Sovis',
    'class' => 'file',
    'type' => 'file'));
?>
<?php
$this->Captcha->input();
?>
<hr/>
<?php
echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-success'));
?>

