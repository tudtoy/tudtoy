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

<section class="about-b">
    <div class="container about-b__container">
        <div class="about-b__header">
            <h2 class="text_h1-medium about-b__title"><?=$args['title']?></h2>
            <span class="text_body about-b__text"><?=$args['text']?></span>
        </div>
        <div class="swiper variable-grid about-b__variable-grid <?=$cover_class?> <?=$many_class?>">
            <div class="swiper-wrapper variable-grid__wrapper">
                <? foreach($args['gallery'] as $image): ?>
                    <div class="swiper-slide variable-grid__slide">
                        <? if($image['type'] == "video"): ?>
                            <video src="<?=$image['url']?>" autoplay="" loop="" muted="" playsinline="" class="variable-grid__img"></video>
                        <? else: ?>
                            <img src="<?=$image['sizes']['large']?>" class="variable-grid__img">
                        <? endif; ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</section>