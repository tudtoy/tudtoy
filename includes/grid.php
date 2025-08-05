<section class="grid">
    <div class="container container_extra-small grid__container">
        <div class="grid__grid">
            <? foreach($args['cards'] as $card): ?>
                <div class="grid__card">
                    <div class="text_body grid__subtitle"><?=$card['subtitle']?></div>
                    <h3 class="grid__title text_h3 text_mobile_h2"><?=$card['title']?></h3>
                    <img src="<?=$card['background_image']['url']?>" class="grid__img">
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>