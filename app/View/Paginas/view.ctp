<?php if ($data['exibe_irmas'] == 1) { ?>
    <div id="page-left" >
        <div>
            <ul>
                <?php foreach ($paginas_irmas as $rg) { ?>
                    <li><?php echo $this->Html->link('+ ' . $rg['Pagina']['titulo'], $rg['Pagina']['url_key']); ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div id="page-middle" class="retracted-div">
        <?php if (!empty($data['cabecalho'])): ?>
            <div class="page-title"><?php echo $data['cabecalho']; ?></div>
            <div class="fb-like" data-href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER ['REQUEST_URI']; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
        <?php endif ?>

        <div class="conteudo"><?php echo $data['body']; ?></div>

    </div>



<?php } else { ?>
    <div id="page-middle" class="full-div">

        <?php if (!empty($data['cabecalho'])): ?>
            <div class="page-title"><?php echo $data['cabecalho']; ?></div>
            <div class="fb-like" data-href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER ['REQUEST_URI']; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
        <?php endif ?>

        <div class="conteudo"><?php echo $data['body']; ?></div>
    </div>
<?php } ?>