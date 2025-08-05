<section class="product-explore">
    <div class="container product-explore__container">
        <h2 class="text_h1-medium product-explore__title"><?=$args['title']?></h2>
        <? if(!empty($args['gallery'])): ?>
            
            <div class="swiper product-explore__swiper product-explore__swiper_full">
                <div class="swiper-wrapper">
                    <? foreach($args['gallery'] as $index => $image):
                        $slideClass = $index < 1 ? 'product-explore__slide-desktop' : 'product-explore__slide-mobile';
                        ?>
                        <div class="swiper-slide product-explore__slide <?=$slideClass;?>">
                            <? if($image['type'] == 'video'): ?>
                                <video src="<?=$image['url']?>" autoplay muted playsinline loop class="product-explore__img"></video>
                            <? else: ?>
                                <img src="<?=$image['url']?>" class="product-explore__img">
                            <? endif; ?>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        <? endif; ?>
        <span class="text_body product-explore__text"><?=$args['text']?></span>
        <? if(!empty($args['button'])): ?>
            <a href="<?=$args['button']['url']?>" target="<?=$args['button']['target']?>" class="btn btn_white text_btn product-explore__btn">
                <?=$args['button']['title']?>
            </a>
        <? endif; ?>
        <? if(!empty($args['autograph'])): ?>
            <img src="<?=$args['autograph']['url']?>" class="product-explore__autograph">
        <? endif; ?>
        <? if(!empty($args['privacy_text'])): ?>
            <span class="text_caption product-explore__privacy"><?=$args['privacy_text']?></span>
        <? endif; ?>
    </div>
</section>