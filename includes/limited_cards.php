<section class="collection-limited">
    <div class="container collection-limited__container">
        <h2 class="text_h1-medium collection-limited__title" uk-scrollspy="target: > .limited__title-row; cls: uk-animation-fade; delay: 100; repeat: true">
            <span class="limited__title-row">
                <?=$args['title']?>
            </span>
        </h2>
        <div class="collection-limited__cards">
            <? foreach($args['cards'] as $card): ?>
                <div class="collection-limited__card">
                    <img src="<?=$card['image']['sizes']['large']?>" alt="" class="collection-limited__img">
                    <h3 class="text_h3 collection-limited__card-title"><?=$card['title']?></h3>
                    <span class="text_body collection-limited__text"><?=$card['text']?></span>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>