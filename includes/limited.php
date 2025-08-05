<section class="limited">
    <div class="container limited__container">
        <h2 class="text_h1-medium limited__title-wrapper" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <span class="limited__title-row">
                <?=$args['parallax_title'];?>
            </span>
        </h2>
        <div class="limited__grid" uk-scrollspy="target: > .limited-card; cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <? foreach($args['limited_card'] as $card): ?>
                <div class="limited-card">
                    <img src="<?=$card['image']['url'] ?>" class="limited-card__image uk-preserve">
                    <span class="text_h2 limited-card__title"><?=$card['title']?></span>
                    <span class="text_body limited-card__text"><?=$card['text']?></span>
                    <? if(!empty($card['link'])): ?>
                        <a href="<?=$card['link']['url']?>" target="<?=$card['link']['target']?>" class="text_link underline limited-card__link">
                            <?=$card['link']['title']?>
                        </a>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>