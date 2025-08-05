<section class="story-slider story-content-slider">
    <div class="container collection-slider__container">
        <div class="swiper story-content-slider__swiper collection-slider__swiper">
            <div class="swiper-wrapper">
                <? foreach($args['slides'] as $slide): ?>
                    <? foreach($slide['gallery'] as $image): ?>
                        <div class="swiper-slide collection-slider__swiper-slide" data-text="<?=$slide['text_under_slider']?>" >
                            <img src="<?=$image['sizes']['large']?>" class="collection-slider__img">
                        </div>
                    <? endforeach; ?>
                <? endforeach; ?>
            </div>
            <div class="collection-slider__slide-info">
                <span class="text_h2 collection-slider__slide-text">
                    <?=$args['slides'][0]['text_under_slider']?>
                </span>

                <? if(count($args['slides']) >= 2): ?>
                    <div class="story-content-slider__buttons">
                        <button class="btn btn_control collection-slider__prev-btn pulse swiper-button-disabled">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                        </button>

                        <button class="btn btn_control collection-slider__next-btn pulse">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                        </button>

                        <button class="btn btn_control collection-slider__update-btn pulse">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/reload.svg" uk-svg>
                        </button>
                    </div>
                <? endif; ?>
            </div>
        </div>
    </div>
</section>