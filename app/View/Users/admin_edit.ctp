
<h1>Alterar senha</h1>


<?php

// if an error occured display the error message
if (isset($error)) {
    echo "<div class='error-inner'>" . $error . "</div>";
}

echo $this->Form->create('User');

echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('old', array('label' => 'Senha Atual', 'type' => 'password'));
echo $this->Form->input('new', array('label' => 'Nova Senha', 'type' => 'password'));
echo $this->Form->input('repeat', array('label' => 'Repetir Nova Senha', 'type' => 'password'));
?>
<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
?>