<section class="press-kits">
    <div class="container press-kits__container">
        <h1 class="press-kits__title text_h1-medium"><?=$args['title']?></h1>
        <span class="text_body press-kits__text"><?=$args['text']?></span>
        <div class="press-kits__cards">
            <? if(!empty($args['kits'])): ?>
                <? foreach($args['kits'] as $kit): ?>
                    <div class="press-kits-card press-kits__card">
                        <img src="<?=$kit['image']['sizes']['large']?>" class="press-kits-card__img">
                        <div class="press-kits-card__info">
                            <h2 class="press-kits-card__title text_h3"><?=$kit['title']?></h2>
                            <span class="text_body press-kits-card__text"><?=$kit['text']?></span>
                        </div>
                        <a href="<?=$kit['link']?>" target="_blank" class="text_link press-kits-card__link hidden-mobile underline">Download</a>
                        <a href="<?=$kit['link']?>" target="_blank" class="text_link press-kits-card__link press-kits-card__link_icon show-mobile">
                            <img class="press-kits-card__icon" src="images/icons/folder.svg">
                        </a>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>
    </div>
</section>