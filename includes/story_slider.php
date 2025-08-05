<section class="story-slider">
    <div class="container collection-slider__container">
        <div class="swiper collection-slider__swiper">
            <div class="swiper-wrapper">
                <? foreach($args['gallery'] as $image): ?>
                    <div class="swiper-slide collection-slider__swiper-slide">
                        <img src="<?=$image['sizes']['large']?>" class="collection-slider__img">
                    </div>
                <? endforeach; ?>
            </div>
            <div class="collection-slider__slide-info">
                <span class="text_h2 collection-slider__slide-text">
                    <?=$args['text_under_slider']?>
                </span>
                <? if(count($args['gallery']) >= 3): ?>
                    <button class="btn btn_control collection-slider__next-btn pulse">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                    </button>
                <? endif; ?>
            </div>
        </div>
    </div>
</section>