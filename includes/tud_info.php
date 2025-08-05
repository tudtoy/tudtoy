<?
    $tud = wc_get_product($args['tud']);
    if(!empty($tud)) {
        $tud_id = $tud->get_ID();
        $collection = get_field('collection', $tud_id);
        if($tud_id == 2990) {
            $tud_2 = wc_get_product(2991);
            $tud_id_2 = $tud_2->get_ID();

            $size_label_2 = get_field('size_label', $tud_id_2); 
            if($size_label_2 == 'S') {
                $size_image_2 = 'size-s.svg';
            }
            elseif($size_label_2 == 'M') {
                $size_image_2 = 'size-m.svg';
            }
            elseif($size_label_2 == 'L') {
                $size_image_2 = 'size-l.svg';
            }

            $price_2 = $tud_2->get_price_html();

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

        $link = get_permalink($tud_id);
        
        if($args['custom_title'] && !empty($args['button_link'])) {
            $link = $args['button_link']['url'];
        }

        if(!empty(get_field('text_instead_of_price', $tud_id))) {
            $isPurchasable = false;
            $name = get_the_title($tud_id);
        }

        $price = $tud->get_price_html();
        $text_price = get_field('text_instead_of_price', $tud_id);

        if($tud->get_price() == 0) {
            $price = 'Free!';
        }
        if(!empty($text_price)) {
            $price = $text_price;
        }

        ?>
        <div class="collection-products">
            <div class="container container_small collection-products__container">
                <div class="collection-product <?=($args['inverse_row'] ? 'collection-product_reverse' : '')?>">
                    <div class="collection-product__image-wrapper">
                        <video class="collection-product__image" src="<?=get_field('video_360', $tud_id)['url']?>" autoplay loop muted playsinline></video>
                    </div>
                    <div class="collection-product__info">
                        <? $subtitle = $args['custom_title'] ? $args['subtitle'] : 'TUD x ' . get_the_title($collection); ?>
                        <? $title = $args['custom_title'] ? $args['title'] : $tud->get_name(); ?>
                        <? $desc = $args['custom_title'] ? $args['description'] : get_field('description', $tud_id); ?>

                        <span class="text_h3 collection-product__collection-text"><?=$subtitle?></span>
                        <h2 class="text_h1-bold collection-product__title"><?=$title;?></h2>
                        <span class="text_body collection-product__text"><?=$desc;?></span>
                    
                    <? if($tud_id == 2990) :?> 
                    <div class="collection-product-sizes">
                        <div class="collection-product__props product-props">
                            <div class="product-props__prop">
                                <div class="product-props__key-wrapper">
                                    <span class="text_body product-props__key-text">Size</span>
                                    <div class="size-icon catalog-item__size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                                    </div>
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
                                <span class="text_body product-props__value"><?=$price;?></span>
                            </div>
                        </div>
                        <div class="collection-product__props product-props">
                            <div class="product-props__prop">
                                <div class="product-props__key-wrapper">
                                    <span class="text_body product-props__key-text">Size</span>
                                    <div class="size-icon catalog-item__size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id_2)['height']?> mm / <?=get_field('dimensions_inch', $tud_id_2)['height']?> inch; offset: 5px;">
                                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image_2?>" uk-svg>
                                    </div>
                                </div>
                                <span class="text_body product-props__value"><?=get_field('dimensions_mm', $tud_id_2)['height']?> mm</span>
                            </div>
                            <? $quantity_2 = get_field('quantity', $tud_id_2); ?>
                            <? if(!empty($quantity_2)): ?>
                                <div class="product-props__prop">
                                    <div class="product-props__key-wrapper">
                                        <span class="text_body product-props__key-text">Quantity</span>
                                    </div>
                                    <span class="text_body product-props__value"><?=$quantity_2?> pieces</span>
                                </div>
                            <? endif; ?>
                            <div class="product-props__prop">
                                <div class="product-props__key-wrapper">
                                    <span class="text_body product-props__key-text">Price</span>
                                </div>
                                <span class="text_body product-props__value"><?=$price_2;?></span>
                            </div>
                        </div>
                    </div>
                    <? else: ?>
                        <div class="collection-product__props product-props">
                            <div class="product-props__prop">
                                <div class="product-props__key-wrapper">
                                    <span class="text_body product-props__key-text">Size</span>
                                    <div class="size-icon catalog-item__size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                                    </div>
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
                                <span class="text_body product-props__value"><?=$price;?></span>
                            </div>
                        </div>
                    <? endif; ?>
                        <? if(!empty($args['button_text'])): ?>
                            <a href="<?=$link?>" class="btn text_btn collection-product__btn">
                                <?=$args['button_text']?>
                            </a>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?
    }
    
?>

