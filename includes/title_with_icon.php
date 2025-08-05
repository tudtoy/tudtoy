<section class="title-with-icon">
    <div class="container title-with-icon__container">
        <h2 class="text_h1-bold title-with-icon__title"><?=$args['title']?></h2>

        <? if(!empty($args['icon'])): ?>
            <img src="<?=$args['icon']['url']?>" class="title-with-icon__icon">
        <? endif; ?>
        
        <span class="text_h3 title-with-icon__text"><?=$args['text']?></span>

        <? if(!empty($args['button']) || !empty($args['link'])):?>
            <div class="title-with-icon__nav">
                <? if(!empty($args['button'])): ?>
                    <a href="<?=$args['button']['url']?>" class="btn text_btn title-with-icon__button"><?=$args['button']['title']?></a>
                <? endif; ?>
                <? if(!empty($args['link'])): ?>
                    <a href="<?=$args['link']['url']?>" class="text_link underline title-with-icon__link"><?=$args['link']['title']?></a>
                <? endif; ?>
            </div>
        <? endif; ?>
    </div>
</section>