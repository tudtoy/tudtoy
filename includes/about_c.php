<section class="about-c">
    <div class="container container_small about-c__container">
        <div class="about-c__row <?=($args['inverse_row'] ? 'about-c__row_inverse' : '')?>">
            <div class="about-c__info">
                <h2 class="text_h1-medium about-c__title"><?=$args['title']?></h2>
                <p class="text_body about-c__text"><?=$args['text']?></p>
                <? if(!empty($args['link'])): ?>
                    <a href="<?=$args['link']['url']?>" target="$args['link']['target']" class="text_link about-c__link underline">
                        <?=$args['link']['title']?>
                    </a>
                <? endif; ?>
            </div>
            <? if(!empty($args['image'])): ?>
                <?php $image = $args['image'][0]; ?>
                <? if($image['type'] == "video"): ?>
                    <video src="<?=$image['url']?>" autoplay="" loop="" muted="" playsinline="" class="about-c__img"></video>
                <? else: ?>
                    <img src="<?=$image['sizes']['medium_large']?>" class="about-c__img">
                <? endif; ?>
            <? endif; ?>
        </div>
    </div>
</section>