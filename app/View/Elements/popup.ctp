<?php
$popup = $this->requestAction(array('controller' => 'popups', 'action' => 'exibe', $page_id));

if (!empty($popup)):
    echo $this->Html->css('reveal');
    echo $this->Html->script('popup/jquery.reveal');
    ?>
    <div id="myModal" class="reveal-modal">
        <h1><?php echo $popup['Popup']['titulo']; ?></h1>
        <p><?php echo $popup['Popup']['conteudo']; ?></p>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').reveal({
                animation: 'fadeAndPop', //fade, fadeAndPop, none
                animationspeed: 300, //how fast animtions are
                closeonbackgroundclick: true, //if you click background will modal close?
                dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
            });
        });
    </script>
    <?php


 endif ?>
