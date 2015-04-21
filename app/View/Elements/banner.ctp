<?php
$banners = $this->requestAction(array('controller' => 'banners', 'action' => 'exibe', $page_id));

if (!empty($banners)):
    echo $this->Html->css('slider/coin-slider-styles');
    echo $this->Html->script('slider/coin-slider.min');
    ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#coin-slider').coinslider({
                width: 960, // width of slider panel
                height: 260, // height of slider panel
                spw: 7, // squares per width
                sph: 5, // squares per height
                delay: 3000, // delay between images in ms
                sDelay: 30, // delay beetwen squares in ms
                opacity: 0.7, // opacity of title and navigation
                titleSpeed: 500, // speed of title appereance in ms
                effect: '', // random, swirl, rain, straight
                navigation: true, // prev next and buttons
                links: true, // show images as links
                hoverPause: true // pause on hover
            });
        });
    </script>

    <div id='coin-slider'>
        <?php
        foreach ($banners as $banner) :
            if ($banner['Banner']['status'] == 1):
                ?>
                <a href="<?php echo $banner['Banner']['url']; ?>" >
                    <?php echo $this->Html->image('/uploads/banner/img/' . $banner['Banner']['img'], array('alt' => $banner['Banner']['alt'])); ?>
                </a>
                <?php
            endif;
        endforeach;
        ?>
    </div>

    <?php

 endif;