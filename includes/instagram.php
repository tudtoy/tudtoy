<section class="instagram">
    <div class="container instagram__container" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
        <h2 class="text_h1-medium instagram__title-wrapper">
            <span class="instagram__title"><?=$args['title'][0]['line']?></span>
            <span class="instagram__subtitle"><?=$args['title'][1]['line']?></span>
        </h2>
        <?php if(!empty($args['button'])): ?>
            <a href="<?=$args['button']['url']?>" target="<?=$args['button']['target']?>" class="btn text_btn instagram__btn">
                <img src="<?=get_template_directory_uri()?>/assets/images/icons/instagram.svg" uk-svg>
                <span><?=$args['button']['title']?></span>
            </a>
        <?php endif; ?>
        <div class="instagram__gallery">
            <?php foreach($args['gallery'] as $index => $image): ?>
                <img src="<?=$image['sizes']['medium_large']?>" class="instagram__gallery-img">
            <?php endforeach; ?>
        </div>
        <div class="instagram__separator"></div>
    </div>
</section>