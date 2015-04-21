<h1>Configuração</h1>
<?php
echo $this->Form->create('Config');
?>


<?php
echo $this->Form->input('email', array(
    'label' => 'Email'));
echo $this->Form->input('id', array('type' => 'hidden'));
?>


<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
