<?
$cover_class = '';
$many_class = '';
if($args['is_cover']) {
    $cover_class = 'variable-grid_cover';
}

if(count($args['gallery']) >= 4) {
    $many_class = 'variable-grid_many';
}

?>

<section class="about-a">
    <div class="container about-a__container">
        <h2 class="text_h1-medium about-a__title"><?=$args['title']?></h2>
        <? if(!empty($args['top_link'])): ?>
            <a href="<?=$args['top_link']['url']?>" target="<?=$args['top_link']['target']?>" class="about-a__top-link underline text_link"><?=$args['top_link']['title']?></a>
        <? endif; ?>
        <div class="swiper variable-grid about-a__variable-grid <?=$cover_class?> <?=$many_class?>">
            <div class="swiper-wrapper variable-grid__wrapper">
                <? foreach($args['gallery'] as $index => $image): ?>
                    <div class="swiper-slide variable-grid__slide">
                        <? if(!empty($args['mobile_gallery'] && $args['mobile_gallery'][$index])): ?>
                            <? if($image['type'] == "video"): ?>
                                <video autoplay loop muted playsinline class="variable-grid__img">
                                    <source src="<?=$image['url']?>" media="(min-width: 768px)" type="video/mp4">
                                    <source src="<?=$args['mobile_gallery'][$index]['url']?>" type="video/mp4">
                                </video>
                            <? else: ?>
                                <picture>
                                    <source srcset="<?=$image['url']?>" media="(min-width: 768px)" />
                                    <img class="variable-grid__img" src="<?=$args['mobile_gallery'][$index]['url']?>" />
                                </picture>
                            <? endif; ?>
                        <? else: ?>
                            <? if($image['type'] == "video"): ?>
                                <video src="<?=$image['url']?>" autoplay="" loop="" muted="" playsinline="" class="variable-grid__img"></video>
                            <? else: ?>
                                <img src="<?=$image['url']?>" class="variable-grid__img">
                            <? endif; ?>
                        <? endif; ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <? if(!empty($args['text'])): ?>
            <span class="about-a__text text_body"><?=$args['text']?></span>
        <? endif; ?>
        <button class="about-a__btn btn btn_plus">
            <div class="btn__plus-wrapper">
                <img src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" class="btn__plus-icon" uk-svg>
            </div>
            <span class="text_body">Read More</span>
            
        </button>
    </div>
</section>