<?
    $tuds = wc_get_products([
        //'limit' => $args['number_of_tuds']
        'limit' => -1,
        'status' => 'publish',
        'exclude' => [get_the_ID(),2126,2944]
    ]);
    
?>

<section class="choose-your-tud-slider" id="choose-your-tud">
    <div class="container choose-your-tud-slider__container">
        <?php if($args['button']):?>
            <div class="choose-your-tud-slider__container_with_button">
                <h2 class="text_h1-medium choose-your-tud-slider__title"><?=$args['title']?></h2>
                <span class="text_h3 choose-your-tud-slider__text"><?=$args['text']?></span>
                <a href="<?=$args['button']['url']?>" class="btn text_btn"><?=$args['button']['title']?></a>
            </div>
        <? else: ?>
            <h2 class="text_h1-medium choose-your-tud-slider__title"><?=$args['title']?></h2>
            <? if(!empty($args['icon'])): ?>
                <img src="<?=$args['icon']['url']?>" class="choose-your-tud-slider__icon">
            <? endif; ?>
            <span class="text_h3 choose-your-tud-slider__subtitle"><?=$args['subtitle']?></span>
            <span class="text_body choose-your-tud-slider__text"><?=$args['text']?></span>
        <? endif; ?>
        <div class="swiper choose-your-tud-slider__slider">
            <div class="swiper-wrapper">
                <? foreach($tuds as $tud): ?>
                    <? 
                        $tud_id = $tud->get_id(); 
                        $collection_id = get_field('collection', $tud_id);

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

                        $isPurchasable = true;
                        $href = 'href="' . get_permalink($tud_id) . '"';
                        $name = 'TUD x ' . get_the_title($collection_id);
                        
                        if(!empty(get_field('text_instead_of_price', $tud_id))) {
                            // В этом блоке показываем только товары, которые можно купить
                            continue;
                            $isPurchasable = false;
                            
                            $href = '';
                            $name = get_the_title($collection_id);
                        }
                    ?>

                    <div class="swiper-slide choose-your-tud-slider__slide<?= $args['button'] ? " with_button" : ""?>">
                        <div class="choose-your-tud-slider__img-wrapper">
                            <? foreach(get_field('preview_gallery', $tud_id) as $index => $image): ?>
                                <? if($index >= 1) break; ?>
                                <img src="<?=$image['sizes']['1536x1536']?>" class="choose-your-tud-slider__img">
                            <? endforeach; ?>
                        </div>
                        <span class="text_body choose-your-tud-slider__product-title"><?=$name?></span>
                        <div class="choose-your-tud-slider__info">
                            <span class="text_body catalog-item__price">
                                <? if($isPurchasable): ?>
                                    <?=$tud->get_price_html();?>
                                <? else: ?>
                                    <?=get_field('text_instead_of_price', $tud_id);?>
                                <? endif; ?>
                            </span>
                            <div class="catalog-item__separator"></div>
                            <span class="catalog-item__size">
                                <span class="text_body">Size</span>
                                <div class="catalog-item__size-icon size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                                </div>
                            </span>
                        </div>
                        <?php if(!$args['button']):?>
                            <div class="product-detail__btn-wrapper">
                                <button class="btn choose-your-tud-slider__btn product-detail__btn text_btn" data-id="<?=$tud_id?>">
                                    <span class="product-detail__btn-text">Add to Cart</span>
                                    <div class="product-detail__btn-loader-wrapper">
                                        <span class="loader"></span>
                                    </div>
                                </button>
                            </div>
                        <? endif; ?>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="btn-group btn-group_white choose-your-tud-slider__group">
                <button class="btn btn_control btn_white choose-your-tud-slider__btn-control choose-your-tud-slider__btn-control_prev">
                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                </button>
                <button class="btn btn_control btn_white choose-your-tud-slider__btn-control choose-your-tud-slider__btn-control_next">
                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                </button>
            </div>
        </div>
    </div>
</section>