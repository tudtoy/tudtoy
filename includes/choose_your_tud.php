<section class="own">
    <div class="container own__container">
        <h2 class="text_h1-medium own__title"><?=$args['title']?></h2>
        <span class="text_h3 own__text"><?=$args['text']?></span>
        <div class="own__content swiper">
            <? $wrapperClass = count($args['cards']) < 3 ? 'own__swiper-wrapper_lock' : ''; ?>
            <? $wrapperSingleClass = count($args['cards']) == 1 ? 'own__swiper-wrapper_single' : ''; ?>
            <div class="swiper-wrapper own__swiper-wrapper <?=$wrapperClass?> <?=$wrapperSingleClass?>">
                <? foreach($args['cards'] as $card): ?>
                    <? 
                        $tud = wc_get_product($card['tud']); 
                        if(!empty($tud)) {
                            $tud_id = $tud->get_ID();

                            $size_label = get_field('size_label', $tud_id); 
                            if($size_label == 'S') {
                                $size_image = 'size-s.svg';
                            }
                            elseif($size_label == 'M') {
                                $size_image = 'size-m.svg';
                            }
                            elseif($size_label == 'L') {
                                $size_image = 'size-l.svg';
                            }

                            if(!empty($size_image)) {
                                $size_image = get_template_directory_uri() . '/assets/images/icons/' . $size_image;
                            }

                            
                            ?>
                                <div class="own__card swiper-slide">
                                    <img class="own__card-bg" src="<?=$card['background_image']['url']?>">
                                    <div class="own__card-content">
                                        <h3 class="text_h2 own__card-title"><?=$tud->get_name()?></h3>
                                        <div class="own__card-info">
                                            <span class="text_body own__card-price">
                                                <? if(empty(get_field('text_instead_of_price', $tud_id))): ?>
                                                    <?=$tud->get_price_html();?>
                                                <? else: ?>
                                                    <?=get_field('text_instead_of_price', $tud_id);?>
                                                <? endif; ?>
                                            </span>
                                            <div class="own__card-separator"></div>
                                            <? if(!empty($size_image)): ?>
                                                <span class="text_body own__card-size">Size</span>
                                                <div class="size-icon own__size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                                                    <img src="<?=$size_image?>" uk-svg>
                                                </div>
                                            <? else: ?>
                                                <span class="text_body own__card-size"><?=get_field('dimensions_mm', $tud_id)['height']?> mm</span>
                                            <? endif; ?>
                                            
                                        </div>
                                        <? if(!empty($card['button_name'])): ?>
                                            <a href="<?=get_permalink($tud_id)?>" class="btn text_btn own__btn"><?=$card['button_name']?></a>
                                        <? endif; ?>
                                    </div>
                                </div>
                            <?
                        }
                    ?>
                <? endforeach; ?>
            </div>
            
        </div>
        <span class="text_caption own__privacy"><?=$args['privacy_text']?></span>
        <? $navClass = count($args['cards']) < 4 ? 'own__nav_lock' : ''; ?>
        <div class="own__nav <?=$navClass?>">
            <button class="btn btn_control btn_white own__nav-button own__nav_prev">
                <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
            </button>
            <button class="btn btn_control btn_white own__nav-button own__nav_next">
                <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
            </button>
        </div>
    </div>
</section>