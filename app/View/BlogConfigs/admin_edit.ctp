<h1>Configuração</h1>
<?php
echo $this->Form->create('BlogConfig');
?>


<?php
echo $this->Form->input('qtd_posts', array('label' => 'Quantidade de posts por página'));
echo $this->Form->input('tam_preview', array('label' => 'Quantidade de caracteres no preview do post'));
echo $this->Form->input('id', array('type' => 'hidden'));
?>


<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
