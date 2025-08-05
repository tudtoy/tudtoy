<section class="hero hero-with-image">
    <? if(!empty($args['background_image']['url'])): ?>
        <img src="<?=$args['background_image']['url']?>" class="hero__video">
    <? endif; ?>
    <div class="hero__picture-wrapper">
        <img src="<?=$args['image']['url']?>" class="hero__picture" uk-parallax="y: -400; scale: 1.4">
    </div>
</section>
            