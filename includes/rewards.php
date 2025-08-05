<div class="rewards">
    <div class="container rewards__container">
        <h2 class="text_h1-medium rewards__title"><?=$args['title']?><br><b><?=$args['gray_title']?></b></h2>
        <div class="rewards__tabs swiper">
            <div class="swiper-wrapper">
                <? foreach($args['tabs'] as $tab): ?>
                    <div class="rewards__tab-wrapper swiper-slide <?=($tab['is_disabled'] ? 'rewards__tab-wrapper_disabled' : '')?>">
                        <div class="rewards__tab">
                            <span class="text_h3 rewards__tab-title"><?=$tab['tab_name']?></span>
                            <span class="text_body rewards__tab-subtitle"><?=$tab['tab_text']?></span>
                            <span class="text_caption rewards__tab-tag"><?=$tab['tab_tag']?></span>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="rewards__info-wrapper">
            <div class="rewards__info">
                <div class="rewards__info-left">
                    <span class="text_h3 rewards__info-title"><?=$args['tabs'][0]['content_title']?></span>
                </div>
                <div class="rewards__info-right">
                    <ul class="rewards__info-list">
                        <? foreach($args['tabs'][0]['list'] as $elem): ?>
                            <li class="rewards__info-list-elem">
                                <span class="text_body rewards__info-list-elem-text"><?=$elem['text']?></span>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <img src="<?=get_template_directory_uri()?>/assets/images/icons/star-tiny.svg" alt="" class="rewards__info-decor">
            </div>
        </div>
    </div>
</div>