<?
    
    $collections = get_posts([
        'post_type' => 'collection',
        'posts_per_page' => -1,
        'exclude' => [get_the_ID()]
    ]);

?>

<section class="masterpieces">
    <div class="container masterpieces__container">

        <div uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <h2 class="text_h1-medium">
                <span class="masterpieces__title"><?=$args['title'][0]['line']?></span>
                <span class="masterpieces__subtitle"><?=$args['title'][1]['line']?></span>
            </h2>
            <? if(!empty($args['button'])): ?>
                <a href="<?=$args['button']['url']?>" target="<?=$args['button']['target']?>" class="btn text_btn btn_white masterpieces__btn">
                    <?=$args['button']['title']?>
                </a>
            <? endif; ?>
        </div>
        
        <div class="swiper masterpieces__swiper" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <div class="swiper-wrapper">
                <? foreach($collections as $collection): ?>
                    <a href="<?=get_permalink($collection)?>" class="swiper-slide masterpieces-card">
                        <img src="<?=get_field('preview_image', $collection)['sizes']['large'] ?>" class="masterpieces-card__img">
                        <span class="text_h3 masterpieces-card__title"><?=get_the_title($collection)?></span>
                        <span class="text_body masterpieces-card__text"><?=get_field('preview_text', $collection);?></span>
                    </a>
                <? endforeach; ?>
            </div>
            <div class="btn-group masterpieces__btn-group">
                <button class="btn btn_control masterpieces__btn-control masterpieces__btn-control_prev">
                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                </button>
                <button class="btn btn_control masterpieces__btn-control masterpieces__btn-control_next">
                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                </button>
            </div>
        </div>
    </div>
</section>