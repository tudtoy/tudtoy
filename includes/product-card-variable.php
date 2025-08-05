<?php
/**
 * Template for displaying a single product card
 * 
 * @param WC_Product $tud The product object
 * @param int $tud_id The product ID
 * @param array $gallery The product gallery images
 * @param int $collection_id The collection ID
 * @param string $size_label The size label
 * @param string $size_image The size image filename
 * @param bool $isPurchasable Whether the product is purchasable
 * @param string $href The product link
 * @param string $name The product name
 * @param bool $is_collectors_sets Whether this is a collector's collection
 */

$tud_id = $tud->get_id();
$gallery = get_field('preview_gallery', $tud_id);
if(empty($gallery)) {
    return;
}

$collection_id = get_field('collection', $tud_id);

$tags = get_field('tags', $collection_id);

if(!empty($tags)) {
    $tags = implode(' ', $tags);
}

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

$name = get_the_title($collection_id);
if(get_field('prefix', $tud_id)) {
    $name = 'TUD x ' . $name;
}

if(!empty(get_field('text_instead_of_price', $tud_id))) {
    $isPurchasable = false;
}

if($tud_id == 1787) {
    $name = get_the_title($tud_id);
}

if(get_field('disable_url', $tud_id)) {
    $href = '';
}

$is_collectors_sets = get_field('is_collectors_sets', $tud_id);

if ($is_collectors_sets) {
    $name = $name . ' Set';
}
?>

<div class="catalog-item <? if(!$is_collectors_sets) echo 'catalog-item_variable'; ?> <? if($tud_product_add_class) echo $tud_product_add_class; ?>" data-tags="<?=$tags?>" data-size="<?=$size_label?>">
    <a href="<? the_permalink($tud_id) ?>" class="swiper catalog-item__swiper">
        <? if ( $is_collectors_sets ) : ?>
            <span class="uk-badge product-badge catalog-item__badge">
                Collector's Sets
            </span>
        <? endif; ?>

        <div class="swiper-wrapper">
            <? foreach($stack_tud['tuds'] as $index => $tud): ?>
                <? $inner_tud_id = $tud->get_id(); ?>
                <? foreach(get_field('preview_gallery', $inner_tud_id) as $image): ?>
                    <? if ( $is_collectors_sets && $index === 0 || !$is_collectors_sets ) : ?>
                        <div class="swiper-slide catalog-item__slide" data-color="<?=get_field('preview_color', $inner_tud_id);?>">
                            <img src="<?=$image['sizes']['1536x1536']?>" class="catalog-item__image">
                        </div>
                    <? endif; ?>
                <? endforeach; ?>
            <? endforeach; ?>
        </div>

        <? if (!$is_collectors_sets) : ?>
            <div class="catalog-item__dots"></div>
            <div class="catalog-item__colors">
                <? foreach($stack_tud['tuds'] as $tud): ?>
                    <? $inner_tud_id = $tud->get_id(); ?>
                    <div class="catalog-item__color-wrapper" data-color="<?=get_field('preview_color', $inner_tud_id);?>" data-link="<?=get_permalink($inner_tud_id);?>">
                        <div class="catalog-item__color" style="background-color: <?=get_field('preview_color', $inner_tud_id);?>;"></div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endif; ?>
    </a>

    <a <?=$href?> class="text_body catalog-item__title"><?=$name?></a>

    <div class="catalog-item__info<? if ($is_collectors_sets) echo ' catalog-item__info-collectors'; ?>">
        <? if ( !$is_collectors_sets ) : ?>
            <span class="text_body catalog-item__price">
                <? if($isPurchasable): ?>
                    <?=$tud->get_price_html();?>
                <? else: ?>
                    <?=get_field('text_instead_of_price', $tud_id);?>
                <? endif; ?>
            </span>

            <? if($size_label != 'Unique'): ?>
                <div class="catalog-item__separator"></div>

                <span class="catalog-item__size">
                    <span class="text_body">Size</span><span class="show-mobile text_body"> <?=$size_label?></span>
                    <div class="catalog-item__size-icon size-icon hidden-mobile" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                    </div>
                </span>
            <? endif; ?>
        <? else : ?>
            <? $i = 0; ?>

                <? if( have_rows('size', $tud_id) ): ?>
                    <? while( have_rows('size', $tud_id) ) : the_row(); ?>
                        <? 
                            $size_label = get_sub_field('size_label');
                            $size_add_text = get_sub_field('size_add_text');

                            if($size_label == 'S') {
                                $size_image = 'size-s.svg';
                            }
                            elseif($size_label == 'M') {
                                $size_image = 'size-m.svg';
                            }
                            elseif($size_label == 'L') {
                                $size_image = 'size-l.svg';
                            }
                        ?>
                        <span class="catalog-item__size">
                            <? if ($i == 0) : ?>
                                <span class="text_body">Size</span>
                            <? endif; ?>
                            <span class="show-mobile text_body"> <?=$size_label?></span>
                            <div class="catalog-item__size-icon size-icon hidden-mobile" uk-tooltip="title: <?=get_sub_field('dimensions_mm')['height']?> mm / <?=get_sub_field('dimensions_inch')['height']?> inch; offset: 5px;">
                                <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                            </div>
                        </span>
                        
                        <? if($size_add_text): ?>
                            <span class="text_body"><?=$size_add_text?></span>
                        <? endif; ?>

                        <? if($i == 0 && count(get_field('size', $tud_id)) > 1): ?>
                            <span class="text_body">+</span>
                        <? endif; ?>

                        <? $i++; ?>

                    <? endwhile; ?>
                <? endif; ?>
        <? endif; ?>
    </div>
</div>