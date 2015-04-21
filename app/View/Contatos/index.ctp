<?php
echo $this->Html->script('jquery.maskedinput-1.3.min');

echo $this->Html->css(array('bootstrap'));
?>
<script type="text/javascript">
    jQuery(function($) {
        $("#ContatoTelefone").mask("(99) 9999-9999");
    });
</script>
    <?php echo $this->Session->flash(); ?>

<?php echo $this->Form->create('Contato') ?>

<?php echo $this->Form->input('nome', array('label' => 'Nome:')) ?>

<?php echo $this->Form->input('email', array('label' => 'E-mail:')) ?>

<?php echo $this->Form->input('estado', array('label' => 'Estado:')) ?>

<?php echo $this->Form->input('cidade', array('label' => 'Cidade:')) ?>

<?php echo $this->Form->input('telefone', array('label' => 'Telefone:')) ?>
<?php
echo $this->Form->input('como_encontrou', array(
    'label' => 'Como nos encontrou:',
    'options' => array('Google' => 'Google', 'Amigo' => 'Amigo', 'Revista' => 'Revista',
        'Lista telefônica' => 'Lista telefônica', 'Email' => 'Email', 'Outros' => 'Outros'),
    'empty' => 'Selecione'))
?>
<?php
echo $this->Form->input('assunto', array(
    'label' => 'Assunto:',
    'options' => array('Comercial' => 'Comercial', 'Críticas e Sugestões' => 'Críticas e Sugestões', 'Financeiro' => 'Financeiro',
        'Suporte Técnico' => 'Suporte Técnico', 'Outros' => 'Outros'),
    'empty' => 'Selecione'))
?>

<?php echo $this->Form->input('mensagem', array('cols' => '40', 'rows' => '6')) ?>

<hr/>
<?php
echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-success'));
?>


