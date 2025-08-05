<section class="product-nfc">
    <div class="container product-nfc__container">
        <h2 class="text_h1-medium collection-limited__title" uk-scrollspy="target: > .limited__title-row; cls: uk-animation-fade; delay: 100; repeat: true">
            <span class="limited__title-row">
                <?=$args['title']?>
            </span>
        </h2>
        <div class="product-nfc__animation">
            <img src="<?=$args['background_image']['sizes']['large']?>" class="product-nfc__img">
            <div class="product-nfc__overlay"></div>
            <div class="product-nfc__animation-wrapper">
                <div class="product-nfc__animation-circle"></div>
                <div class="product-nfc__animation-circle"></div>
                <div class="product-nfc__animation-circle"></div>
                <div class="product-nfc__animation-circle"></div>
                <div class="text_body product-nfc__animation-text">NFC</div>
            </div>
        </div>
        <div class="product-nfc__cards">
            <? foreach($args['cards'] as $card): ?>
                <div class="product-nfc__card">
                    <h3 class="text_h2 product-nfc__card-title"><?=$card['title']?></h3>
                    <span class="text_body product-nfc__card-text"><?=$card['text']?></span>
                    <? if(!$card['link_or_button']): ?>
                        <a href="<?=$card['link']['url']?>" target="<?=$card['link']['target']?>" class="underline product-nfc__card-link">
                            <?=$card['link']['title']?>
                        </a>
                    <? else: ?>
                        <a href="<?=$card['link']['url']?>" target="<?=$card['link']['target']?>" class="text_link btn btn_disabled product-nfc__card-btn">
                            <?=$card['link']['title']?>
                        </a>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>