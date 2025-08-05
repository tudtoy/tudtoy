<section class="inside">
    <div class="container inside__container" data-switcher>
        <h2 class="text_h1-medium inside__title"><?=$args['title']?></h2>
        <div class="swiper inside__swiper">
            <div class="swiper-wrapper">
                <? if($args['with_switcher']): ?>
                    <? foreach($args['switches'] as $switch_index => $switch): ?>
                        <? foreach($switch['slides'] as $slide): ?>
                            <div class="swiper-slide inside__slide" data-switch="<?=$switch_index?>">
                                <img src="<?=$slide['image']['sizes']['medium_large']?>" class="inside__img">
                                <h3 class="text_h3 inside__slide-title"><?=$slide['title']?></h3>
                                <p class="text_body inside__slide-text"><?=$slide['text']?></p>
                            </div>
                        <? endforeach; ?>
                    <? endforeach; ?>
                <? else: ?>
                    <? foreach($args['slides'] as $slide): ?>
                        <div class="swiper-slide inside__slide">
                            <img src="<?=$slide['image']['sizes']['medium_large']?>" class="inside__img">
                            <h3 class="text_h3 inside__slide-title"><?=$slide['title']?></h3>
                            <p class="text_body inside__slide-text"><?=$slide['text']?></p>
                        </div>
                    <? endforeach; ?>
                <? endif; ?>
            </div>
            <div class="inside__nav <?= ($args['with_switcher'] ? '' : 'inside__nav_switcher')?>">
                <? if($args['with_switcher']): ?>
                    <div class="switcher switcher_white inside__switcher">
                        <? foreach($args['switches'] as $switch_index => $switch): ?>
                            <button class="btn switcher__btn" data-switch-button="<?=$switch_index?>">
                                <?=$switch['switch_name']?>
                            </button>
                        <? endforeach; ?>
                        <div class="switcher__back"></div>
                    </div>
                <? endif; ?>
                <div class="inside__buttons <?=(!$args['with_switcher'] ? 'inside__buttons_center btn-group btn-group_white' : '')?>">
                    <button class="btn btn_control btn_white inside__nav-button inside__nav_prev">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                    </button>
                    <button class="btn btn_control btn_white inside__nav-button inside__nav_next">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>