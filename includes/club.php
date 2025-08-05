<div class="club">
    <div class="club__gradient">
        <div class="container club__container" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <h2 class="text_h1-medium club__title"><?=$args['title']?></h2>
            <span class="text_h3 club__text"><?=$args['text']?></span>
            <? if(!empty($args['button'])): ?>
                <a href="<?=$args['button']['url'];?>" target="<?=$args['button']['target']?>" class="btn text_btn club__btn">
                    <?=$args['button']['title']?>
                </a>
            <? endif; ?>
        </div>
    </div>
    <div class="club__image-wrapper">
        <div class="club__blur"></div>
        <picture>
            <source srcset="<?=$args['background']['mobile_background']['url']?>" media="(max-width: 1100px)">
            <img src="<?=$args['background']['desktop_background']['url']?>" class="club__image">
        </picture>
    </div>
</div>