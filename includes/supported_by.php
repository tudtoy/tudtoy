<section class="partners">
    <div class="container partners__container">
        <div class="partners__row" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <h2 class="text_h2 partners__title"><?=$args['title']?></h2>
            <? if(!empty($args['link'])): ?>
                <a href="<?=$args['link']['url']?>" target="<?=$args['link']['target']?>" class="text_link underline partners__link">
                    <?=$args['link']['title']?>
                </a>
            <? endif; ?>
        </div>
        <div class="partners__cards" uk-scrollspy="target: > .partners__partner; cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <? foreach($args['partners'] as $partner): ?>
                <a target="_blank" href="<?=$partner['link']?>" class="partners__partner">
                    <img src="<?=$partner['logo']['url']?>" class="partners__partner-img">
                </a>
            <? endforeach; ?>
        </div>
    </div>
</section>