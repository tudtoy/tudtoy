<section class="personal">
    <div class="container personal__container" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
        <h2 class="text_h1-medium personal__title"><?=$args['title']?></h2>
        <span class="text_h3 personal__text"><?=$args['text']?></span>
        <? if(!empty($args['link'])): ?>
            <a href="#art-manager" target="<?=$args['link']['target']?>" class="btn text_btn btn_white personal__btn" uk-toggle>
                <?=$args['link']['title']?>
            </a>
        <? endif; ?>
    </div>
    <div class="personal__overflow"></div>
    <video src="<?=$args['background_video']['url']?>" autoplay loop muted playsinline class="personal__video"></video>
    <? if($args['show_link_to_top']): ?>
        <a href="#" class="personal__anchor" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-up.svg" class="personal__anchor-icon" uk-svg>
            <span class="text_link personal__anchor-text">back to top</span>
        </a>
    <? endif; ?>
</section>