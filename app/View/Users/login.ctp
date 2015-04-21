
<h1>Login</h1>


<?php

// if an error occured display the error message
if (isset($error)) {
    echo "<div class='error-inner'>" . $error . "</div>";
}

echo $this->Form->create('User', array('url' => array(
        'controller' => 'users',
        'action' => 'login')));
echo $this->Form->input('username');
echo $this->Form->input('password', array('type' => 'password'));
?>
<hr/>
<?php
echo $this->Form->end(array('label' => 'Login', 'class' => 'btn btn-success'));
?>