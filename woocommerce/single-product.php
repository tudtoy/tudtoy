<? get_header(); ?>

<?
    global $product;
    $tud = $product;
    $tud_id = $product->get_ID();
    $collection = get_field('collection', $tud_id);
    $all_tuds_in_collection = get_field('products', $collection);

    $enable_badge = get_field('enable_badge', $tud_id);
    $lable_badge = get_field('lable_badge', $tud_id);
    $style_badge = get_field('style_badge', $tud_id);

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

    if(!empty(get_field('text_instead_of_price', $tud_id))) {
        $isPurchasable = false;
    }

    $is_collectors_sets = get_field('is_collectors_sets', $tud_id);
	$is_collectors_sets_button_display = get_field('is_collectors_sets_button_display', $tud_id);

    $collection_title = get_the_title($collection);
    $is_tyson_set = false;

	// if you need to return the label for tyson set, then uncomment the code below
	
    /* if ($collection_title === 'Mike Tyson') {
        $is_tyson_set = true;
    }*/
?>

<? if(!get_field('only_flex_content', $tud_id)): ?>
    <section class="product-detail<?php if ( $is_collectors_sets ) echo ' product-collectors-detail' ?>">
        <div class="container product-detail__container">
            <div class="product-detail__gallery-wrapper">
                <div class="product-detail__gallery" uk-sticky="offset: 160px; end: true; media: 768">
                    <?php $gallery_array = get_field('full_gallery', $tud_id); ?>

                    <?php if ( count($gallery_array) === 1) : ?>
                        <?php $image = $gallery_array[0]; ?>
                        <div class="product-detail__slide uk-margin-auto-left@m">
                            <? if($image['type'] == 'video'): ?>
                                <video src="<?=$image['url']?>" class="product-detail__img product-collectors-detail__img" autoplay loop muted playsinline></video>
                            <? else: ?>
                                <img src="<?=$image['url']?>" class="product-detail__img product-collectors-detail__img">
                            <? endif; ?>
                        </div>
                    <?php else : ?>
                        <div class="swiper product-detail__swiper-thumbs">
                            <div class="swiper-wrapper">
                                <? foreach(get_field('full_gallery', $tud_id) as $image): ?>
                                    <div class="swiper-slide product-detail__slide-thumb">
                                        <? if($image['type'] == 'video'): ?>
                                            <img src="images/icons/play.svg" class="product-detail__play-icon" uk-svg>
                                        <? else: ?>
                                            <img src="<?=$image['sizes']['medium']?>" class="product-detail__img-thumb">
                                        <? endif; ?>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper product-detail__swiper">
                            <? if ( $enable_badge && $lable_badge ) : ?>
                                <span class="uk-badge product-badge catalog-item__badge <?=$style_badge;?>">
                                    <?=$lable_badge;?>
                                </span>
                            <? endif; ?>
                            <div class="swiper-wrapper">
                                <? foreach(get_field('full_gallery', $tud_id) as $image): ?>
                                    <div class="swiper-slide product-detail__slide">
                                        <? if($image['type'] == 'video'): ?>
                                            <video src="<?=$image['url']?>" class="product-detail__img" autoplay loop muted playsinline></video>
                                        <? else: ?>
                                            <img src="<?=$image['url']?>" class="product-detail__img">
                                        <? endif; ?>
                                    </div>
                                <? endforeach; ?>
                            </div>
                            <div class="product-detail__swiper-nav">
                                <button class="btn btn_control btn_white product-detail__swiper-nav-button product-detail__swiper-nav-button_prev">
                                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                                </button>
                                <button class="btn btn_control btn_white product-detail__swiper-nav-button product-detail__swiper-nav-button_next">
                                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="product-detail__info">
				<?
					$name = get_the_title($collection);

					if ( get_field('prefix') ) {
						$name = "TUD x " . $name;
					}

                    if ( $is_collectors_sets ) {
                        $name = "Collector’s Sets";
                    }
				?>
                <? if(get_field('swap_titles')): ?>
                    <h2 class="text_h2 product-detail__title"><?=$tud->get_name()?></h2>

                    <? if(!get_field('hide_subtitle')): ?>
                        <h1 class="text_h3 product-detail__name"><?=$name?></h1>
                    <? endif; ?>
                <? else: ?>
                    <h2 class="text_h2 product-detail__title"><?=$name?></h2>

                    <? if(!get_field('hide_subtitle')): ?>
                        <h1 class="text_h3 product-detail__name"><?=$tud->get_name()?></h1>
                    <? endif; ?>
                <? endif; ?>
                
                <? if(count($all_tuds_in_collection) > 1 && !$is_collectors_sets): ?>
                    <div class="product-detail__avatars">
                        <? foreach($all_tuds_in_collection as $tud_in_collection): ?>
                            <?
                                $is_set = get_field('is_collectors_sets', $tud_in_collection->ID); 
                                
                                if($is_set) {
                                    continue;
                                }
                                if($tud_in_collection->post_status != 'publish') {
                                    continue;
                                }
                                $active_class = '';
                                if($tud_in_collection->ID == $tud_id) {
                                    $active_class = 'product-detail__avatar-wrapper_active';
                                }  
                            ?>

                            <a href="<?=get_permalink($tud_in_collection)?>" class="product-detail__avatar-wrapper <?=$active_class?>">
                                <img src="<?=get_field('avatar', $tud_in_collection->ID)['sizes']['thumbnail'] ?>" class="product-detail__avatar">
                            </a>
                        <? endforeach; ?>
                    </div>
                <? endif; ?>
                
                <?php if ( $is_collectors_sets ) : ?>
                    <div class="product-detail__props product-props-set">
                        <?php $i = 1; ?>
                        
                        <?php if( have_rows('size') ): ?>
                            <div class="product-detail__props product-props-size">
                            <?php while( have_rows('size') ) : the_row(); ?>
                                <?php 
                                    $size_label = get_sub_field('size_label');

                                    if($size_label == 'S') {
                                        $size_image = 'size-s.svg';
                                    }
                                    elseif($size_label == 'M') {
                                        $size_image = 'size-m.svg';
                                    }
                                    elseif($size_label == 'L') {
                                        $size_image = 'size-l.svg';
                                    }

                                    $value_text = get_field('name_'.$i, $tud_id);
                                    $value_avatar = get_field('avatar_'.$i, $tud_id);
                                ?>
                                <? if($i !== 1 && $i > 01): ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="product-detail__accordeon-plus show-mobile uk-svg" style="display: flex;">
                                        <path d="M3.51465 12H20.4852M11.9999 20.4853V3.51472" stroke="#F5F5F7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                <? endif; ?>
                                <div class="product-detail__avatars">
                                    <? if($value_avatar): ?>
                                        <div class="product-detail__avatar-wrapper-nolink">
                                            <img src="<?=$value_avatar['sizes']['thumbnail'] ?>" class="product-detail__avatar">
                                        </div>
                                    <? endif; ?>
                                    <div class="product-props__prop">
                                        <div class="product-props__key-wrapper">
                                            <span class="text_body product-props__key-text">Size</span>
                                            <? if($size_label != 'Unique'): ?>
                                                <div class="catalog-item__size-icon size-icon" uk-tooltip="title: <?=get_sub_field('dimensions_mm')['height']?> mm / <?=get_sub_field('dimensions_inch')['height']?> inch; offset: 5px;">
                                                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                                                </div>
                                            <? endif; ?>
                                        </div>
                                        <span class="text_body product-props__value product-props__value--without-decoration">
                                            <?php echo $value_text; ?>
                                        </span>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
						<?php if (!$is_collectors_sets_button_display && $tud->get_price() > 0) : ?>
							<div class="product-props__prop price">
								<div class="product-props__key-wrapper">
									<span class="text_body product-props__key-text">Price</span>
                                    <span class="text_body product-props__value">
                                        <? if($isPurchasable): ?>
                                            <?=$tud->get_price_html()?>
                                        <? else: ?>
                                            <?=get_field('text_instead_of_price', $tud_id)?>
                                        <? endif; ?>
                                    </span>
								</div>
							</div>
						<?php endif; ?>
                    </div>
                    
                    <?php else : ?>
                    <div class="product-detail__props product-props">
                        <div class="product-props__prop">
                        
                            <div class="product-props__key-wrapper">
                                <span class="text_body product-props__key-text">Size</span>
                                <? if($size_label != 'Unique'): ?>
                                    <div class="catalog-item__size-icon size-icon hidden-mobile" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                                    </div>
                                <? endif; ?>
                            </div>
                            <span class="text_body product-props__value"><?=get_field('dimensions_mm', $tud_id)['height']?> mm</span>
                        </div>
                        <? $quantity = get_field('quantity', $tud_id); ?>
                        <? if(!empty($quantity)): ?>
                            <div class="product-props__prop">
                                <div class="product-props__key-wrapper">
                                    <span class="text_body product-props__key-text">Quantity</span>
                                </div>
                                <span class="text_body product-props__value"><?=$quantity?> pieces</span>
                            </div>
                        <? endif; ?>
                        <div class="product-props__prop">
                            <div class="product-props__key-wrapper">
                                <span class="text_body product-props__key-text">Price</span>
                            </div>
                            
                            <span class="text_body product-props__value">
                                <? if($isPurchasable): ?>
                                    <?=$tud->get_price_html()?>
                                <? else: ?>
                                    <?=get_field('text_instead_of_price', $tud_id)?>
                                <? endif; ?>
                            </span>
                        </div>
                        </div>
                    <?php endif; ?>
                

                <? if(!empty(get_field('is_promo_single', 'option'))): ?>
                    <? $link = get_field('promo_single_banner_link', 'option'); ?>
                    <a href="<?=$link['url']?>" target="<?=$link['target']?>" class="promo-single-banner__link">
                        <img src="<?=get_field('promo_single_banner', 'option')['url']?>" class="promo-single-banner">
                    </a>
                <? endif; ?>


                <?php if ( $is_collectors_sets ) : ?>
					<?php if ($is_collectors_sets_button_display) : ?>
						<div class="product-detail__btn-wrapper">
							<button href="#art-manager" class="btn product-detail__request-btn text_btn">
								<span class="product-detail__btn-text">Request the Collector’s Set</span>
							</button>
						</div>
					<?php elseif (!$is_collectors_sets_button_display && $tud->get_price() > 0) : ?>
						<div class="product-detail__btn-wrapper">
                            <button class="btn product-detail__btn text_btn" data-ID="<?=get_the_ID()?>">
                                <span class="product-detail__btn-text">Add to Cart</span>
                                <div class="product-detail__btn-loader-wrapper">
                                    <span class="loader"></span>
                                </div>
                            </button>
                            <a href="#art-manager" class="product-detail__modal-link text_link underline">or Ask the Art Manager</a>
                        </div>
					<?php endif; ?>
				
                <?php else : ?>
                    <? if($isPurchasable): ?>
                        <div class="product-detail__btn-wrapper">
                            <button class="btn product-detail__btn text_btn" data-ID="<?=get_the_ID()?>">
                                <span class="product-detail__btn-text">Add to Cart</span>
                                <div class="product-detail__btn-loader-wrapper">
                                    <span class="loader"></span>
                                </div>
                            </button>
                            <a href="#art-manager" class="product-detail__modal-link text_link underline">or Ask the Art Manager</a>
                        </div>
                    <? endif; ?>
                <?php endif; ?>

                <span class="text_body product-detail__text"><?=get_field('description', $tud_id)?></span>
                <ul class="product-detail__accordeon">
                    <? if(!empty(get_field('accordion'))): ?>
                        <? foreach(get_field('accordion') as $elem): ?>
                            <? if($elem['is_list']): ?>
                                <li class="product-detail__accordeon-elem">
                                    <a class="product-detail__accordeon-title" href>
                                        <span class="text_body"><?=$elem['title']?></span>
                                        <img class="product-detail__accordeon-plus" src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" uk-svg>
                                    </a>
                                    <div class="product-detail__accordeon-content">
                                        <div class="product-detail__accordeon-props">
                                            <? foreach($elem['list'] as $list_elem): ?>
                                                <?php if ( strtoupper($list_elem['title']) === strtoupper('PRODUCT') ) : ?>
                                                    <div class="product-detail__accordeon-prop product-detail__accordeon-prop_heading">
                                                        <span class="product-detail__accordeon-prop-value text_body-small"><?=$list_elem['text']?></span>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="product-detail__accordeon-prop">
                                                        <span class="product-detail__accordeon-prop-title text_body-small"><?=$list_elem['title']?></span>
                                                        <span class="product-detail__accordeon-prop-value text_body-small"><?=$list_elem['text']?></span>
                                                    </div>
                                                <?php endif;?>
                                            <? endforeach; ?>
                                        </div>
                                    </div>
                                </li>
                            <? else: ?>
                                <li class="product-detail__accordeon-elem">
                                    <a class="product-detail__accordeon-title" href>
                                        <span class="text_body"><?=$elem['title']?></span>
                                        <img class="product-detail__accordeon-plus" src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" uk-svg>
                                    </a>
                                    <div class="product-detail__accordeon-content custom-list text_body-small">
                                        <?=$elem['text']?>
                                    </div>
                                </li>
                            <? endif; ?>
                        <? endforeach; ?>
                    <? endif; ?>
                </ul>
            </div>
        </div>
    </section>
<? endif; ?>

<?
if(!empty(get_field('content'))) {
    foreach(get_field('content') as $block) {
        get_template_part('includes/' . $block['acf_fc_layout'], null, $block);
    } 
}
?>

<? get_footer(); ?>