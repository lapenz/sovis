<h1>Editar Página</h1>
<?php
echo $this->Html->script('ckeditor/ckeditor');

echo $this->Form->create('Pagina', array('enctype' => 'multipart/form-data'));
?>
<hr />
<?php
echo $this->Form->submit('Salvar', array('class' => 'btn btn-success'));
?>

<hr/>
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#lA" data-toggle="tab">Geral</a></li>
        <li class="" id="tB"><a href="#lB" data-toggle="tab">Metadados</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="lA">
            <?php
            echo $this->Form->input('nome', array('label' => 'Nome'));
            echo $this->Form->input('titulo', array('label' => 'Título'));
            echo $this->Form->input('site_id', array('options' => $sites, 'empty' => 'Vazio'));
            ?>
            <?php
            echo $this->Form->input('status', array('options' => array('0' => 'Inativo', '1' => 'Ativo')));
            echo $this->Form->input('target', array('options' => array('_self' => 'Mesma Página (_self)', '_blank' => 'Nova Página (_blank)'), 'default' => '_self'));
            echo $this->Form->input('parent_id', array('options' => $paginas, 'label' => 'Página Pai', 'empty' => 'Nenhuma', 'disabled'));
            echo $this->Form->input('url_key', array('label' => 'URL Chave', 'disabled'));
            echo $this->Form->input('ancora', array('label' => 'Página âncora', 'type' => 'checkbox'));
            echo $this->Form->input('inc_menu', array('label' => 'Incluir no menu', 'type' => 'checkbox'));
            echo $this->Form->input('exibe_irmas', array('label' => 'Exibir páginas irmãs no menu esquerdo', 'type' => 'checkbox'));
            ?>
            <div id="tipo"><?php
                echo $this->Form->input('tipo', array('label' => 'URL externa', 'type' => 'checkbox'));
                ?></div>
            <div id="campos">
                <?php
                echo $this->Form->input('popup_id', array('options' => $popups, 'empty' => 'Vazio'));
                echo $this->Form->input('cabecalho', array(
                    'label' => 'Cabeçalho'));

                echo $this->Form->input('body', array('type' => 'textarea', 'label' => 'Conteúdo', 'class' => 'ckeditor'));
                ?>
            </div>
        </div>
        <div class="tab-pane" id="lB">
            <?php
            echo $this->Form->input('keywords', array('type' => 'textarea', 'label' => 'Meta Keywords - 200 caracteres', 'escape' => false));
            echo $this->Form->input('keywords_restantes', array('label' => '', 'escape' => false, 'disabled'));
            echo $this->Form->input('description', array('type' => 'textarea', 'label' => 'Meta Description - 250 caracteres', 'escape' => false));
            echo $this->Form->input('description_restantes', array('label' => '', 'escape' => false, 'disabled'));


            echo $this->Form->input('dir', array('type' => 'hidden'));
            echo $this->Form->input('mimetype', array('type' => 'hidden'));
            echo $this->Form->input('filesize', array('type' => 'hidden'));
            echo $this->Form->input('id', array('type' => 'hidden'));
            ?>
        </div>
    </div>
</div>


<hr/>
<?php
echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-success'));
?>
<script>
    function escondeCampos() {
        $('#tB').hide();
        $('#campos').hide();
        $('#campos').find('*').each(function() {
            $(this).val("");
        });
    }
    function mostraCampos() {
        $('#tB').show();
        $('#campos').show();
    }
    if ($("#PaginaTipo").is(':checked')) {
        escondeCampos();
        $('#PaginaUrlKey').removeAttr('disabled');
    }
    if ($("#PaginaAncora").is(':checked')) {
        escondeCampos();
        $('#tipo').hide();
    }

    $("#PaginaTipo").change(function() {
        if ($("#PaginaTipo").is(':checked')) {
            escondeCampos();
            $('#PaginaUrlKey').removeAttr('disabled');
        } else {
            $("#PaginaTipo").attr('checked', true);
        }
    });
    $("#PaginaAncora").change(function() {
        if ($("#PaginaAncora").is(':checked')) {
            escondeCampos();
            $('#tipo').hide();
            $("#PaginaUrlKey").attr('disabled', true);

        } else {
            mostraCampos();
            $("#PaginaUrlKey").attr('disabled', true);
            $('#tipo').show();
            if ($("#PaginaTipo").is(':checked')) {
                escondeCampos();
                $('#PaginaUrlKey').removeAttr('disabled');
            }
        }
    });

    $("#PaginaKeywordsRestantes").val($.trim($("#PaginaKeywords").val()).length);
    $("#PaginaDescriptionRestantes").val($.trim($("#PaginaDescription").val()).length);
    
    $("#PaginaKeywords").keyup(function() {
        $("#PaginaKeywordsRestantes").val($.trim($("#PaginaKeywords").val()).length);
    });

    $("#PaginaDescription").keyup(function() {
        $("#PaginaDescriptionRestantes").val($.trim($("#PaginaDescription").val()).length);
    });

</script>