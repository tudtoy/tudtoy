<?
$isOneSlide = count($args['slides']) == 1;
?>

<section class="fullscreen-slider">
    <div class="container container_fluid fullscreen-slider__container">
        <div class="swiper fullscreen-slider__swiper">
            <div class="swiper-wrapper">
                <? foreach($args['slides'] as $slide): ?>
                    <div class="swiper-slide fullscreen-slider__slide">
                        <? if(!empty($slide['mobile_image'])): ?>
                            <picture>
                                <source srcset="<?=$slide['image']['sizes']['2048x2048']?>" media="(min-width: 768px)" />
                                <img class="fullscreen-slider__img" src="<?=$slide['mobile_image']['sizes']['2048x2048']?>" />
                            </picture>
                        <? else: ?>
                            <img class="fullscreen-slider__img" src="<?=$slide['image']['sizes']['2048x2048']?>" />
                        <? endif; ?>
                        <div class="fullscreen-slider__overlay"></div>
                        <div class="fullscreen-slider__slide-info <?=($isOneSlide ? 'fullscreen-slider__slide-info_one' : '')?>">
                            <h2 class="text_h2 fullscreen-slider__slide-title"><?=$slide['title']?></h2>
                            <span class="text_body fullscreen-slider__slide-text"><?=$slide['subtitle']?></span>
                        </div>
                        <? if(!empty($slide['label'])): ?>
                            <div class="fullscreen-slider__label text_body"><?=$slide['label']?></div>
                        <? endif; ?>
                    </div>
                <? endforeach; ?>
            </div>
            <? if(!$isOneSlide): ?>
                <div class="fullscreen-slider__pagination"></div>
                <div class="fullscreen-slider__nav">
                    <button class="btn btn_control btn_white fullscreen-slider__pause">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/pause.svg" class="fullscreen-slider__pause-icon" uk-svg>
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/play.svg" class="fullscreen-slider__play-icon" uk-svg>
                    </button>
                    <button class="btn btn_control fullscreen-slider__prev">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                    </button>
                    <button class="btn btn_control fullscreen-slider__next">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                    </button>
                </div>
            <? endif; ?>
        </div>
    </div>
</section>