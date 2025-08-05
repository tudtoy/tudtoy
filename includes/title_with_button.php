<section class="collection-slider">
    <div class="container collection-slider__container">
        <h2 class="text_h1-bold collection-slider__title"><?=$args['title']?></h2>
        <span class="text_h3 collection-slider__text"><?=$args['text']?></span>
        <? if(!empty($args['content'])): ?>
            <div class="text_body collection-slider__content">
                <?=$args['content']?>
            </div>
        <? endif; ?>
        <? if(!empty($args['bottom_content'])): ?>
            <div class="text_body-small collection-slider__bottom-content">
                <?=$args['bottom_content']?>
            </div>
        <? endif; ?>
        <? if(!empty($args['button'])): ?>
            <a href="<?=$args['button']['url']?>" target="<?=$args['button']['target']?>" class="btn text_btn collection-slider__btn">
                <?=$args['button']['title']?>
            </a>
        <? endif; ?>
    </div>
</section>