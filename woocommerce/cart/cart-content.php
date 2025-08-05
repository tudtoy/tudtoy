<? defined( 'ABSPATH' ) || exit; ?>

<div class="cart__loader"></div>
<div class="cart__cards">
    <?
        if(get_field('is_promo_single', 'option')) {
            $promo_tud = get_field('promo_product', 'option');
            if(!empty($promo_tud)) {
                $promo_tud = wc_get_product($promo_tud);
                $promo_tud_id = $promo_tud->get_id();
            }
        }

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $tud_id = $cart_item['product_id'];
            $tud = wc_get_product($tud_id);
            $collection = get_field('collection', $tud_id);
            $is_collectors_sets = get_field('is_collectors_sets', $tud_id);

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

            $price = $tud->get_price_html();
            if($tud->get_price() == 0) {
                $price = 'Free';
            }

            $hideCartButtons = false;
            if(!empty($promo_tud_id)) {
                if($promo_tud_id == $tud_id) {
                    $hideCartButtons = true;
                }
            }elseif($tud_id == 2982){
                $hideCartButtons = true;
            }

            $name = $tud->get_name();

            if ( $is_collectors_sets ) {
                $name = "Collector’s Sets";
            }
            

            ?>
                <div class="cart-card cart__card">
                    <a href="<?=get_permalink($tud_id)?>" class="cart-card__img-wrapper">
                        <img src="<?=get_field('cart_image', $tud_id)['sizes']['medium_large']?>" class="cart-card__img">
                    </a>
                    <div class="cart-card__info">
                        <? if(!empty(get_field('text_instead_of_price', $tud_id))): ?>
                            <h2 class="cart-card__title text_h3"><?=$name?></h2>
                        <? else: ?>
                            
                            <h2 class="cart-card__title text_h3">
                                <? if ( !$is_collectors_sets ) : ?>
                                    TUD x <?=get_the_title($collection)?>
                                <? else : ?>
                                    <?=$tud->get_name()?>
                                <? endif; ?>
                            </h2>
                            <? if ( !$is_collectors_sets ) : ?>
                                <span class="text_body cart-card__name"><?=$name?></span>
                            <? endif; ?>
                        <? endif; ?>
                        <div class="cart-card__props product-props <?= $is_collectors_sets ? "sets": "" ?>">
                            <? if ( !$is_collectors_sets ) : ?>
                                <div class="product-props__prop">
                                    <div class="product-props__key-wrapper">
                                        <span class="text_body product-props__key-text">Size</span>
                                        <div class="catalog-item__size-icon size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                                        </div>
                                    </div>
                                    <span class="text_body product-props__value"><?=get_field('dimensions_mm', $tud_id)['height']?> mm</span>
                                </div>
                            <? else : ?>
                                <?php $i = 1; ?>

                                <?php if( have_rows('size', $tud_id) ): ?>
                                    <div class="product-props__prop size">
                                    <?php while( have_rows('size', $tud_id) ) : the_row(); ?>
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
                                        ?>

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

                                        <?php $i++; ?>
                                    <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            <? endif; ?>
                            <div class="product-props__prop price">
                                <div class="product-props__key-wrapper">
                                    <span class="text_body product-props__key-text">Price</span>
                                </div>
                                <span class="text_body product-props__value"><?=$price?></span>
                            </div>
                        </div>
                        <? if(!$hideCartButtons): ?>
                        <div class="cart-card__buttons">
                            <div uk-form-custom="target: > * > span:first-child" class="cart-card__select-wrapper">
                                <select name="quantity" class="uk-select" data-cart-item-id="<?=$cart_item_key?>">
                                    <? for($index = 1; $index <= 5; $index++): ?>
                                        <? $selected = $index == $cart_item['quantity'] ? 'selected' : ''; ?>
                                        <option value="<?=$index?>" <?=$selected?>><?=$index?></option>
                                    <? endfor; ?>
                                </select>
                                <button class="cart-card__select" type="button" tabindex="-1">
                                    <span class="text_body-small"></span>
                                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/dropdown.svg" uk-svg>
                                </button>
                            </div>
                            <a href="#" class="text_link underline underline_invert cart-card__remove underline_invert-desktop" data-cart-item-id="<?=$cart_item_key?>">Remove</a>
                        </div>
                        <? endif; ?>
                    </div>
                </div>
            <?
        }
    ?>
    <!-- <div class="cart-card cart__card cart-card_gift">
        <div class="cart-card__img-wrapper">
            <img src="images/gift.jpg" class="cart-card__img">
        </div>
        <div class="cart-card__info">
            <h2 class="cart-card__title text_h3">Make It Personal</h2>
            <span class="text_body-small cart-card__text">Need a special touch? Include a personal message in a custom envelope that will be placed inside the box with your TUD. Perfect for gifting!</span>
            <a href="#" class="text_link underline cart-card__link">add a gift note</a>
        </div>
    </div> -->
</div>
<div class="cart__side-wrapper">
    <div class="cart__side">
        <div class="cart__total">
            <div class="cart__total-prop">
                <span class="text_body-small cart__total-prop-key">Items</span>
                <div class="cart__total-prop-value-wrapper">
                    <span class="text_caption cart__total-prop-desc">x<?=WC()->cart->cart_contents_count?></span>
                    <span class="cart__total-prop-value"><?=WC()->cart->get_cart_subtotal()?></span>
                </div>
            </div>
            <div class="cart__total-prop">
                <span class="text_body-small cart__total-prop-key">Shipping</span>
                <div class="cart__total-prop-desc-wrapper">
                    
                    <span class="text_caption cart__total-prop-desc-secondary" data-portal-click="#shipping_accordeon">
                        <span class="text_body-small cart__total-prop-desc"><?=WC()->cart->get_cart_shipping_total();?></span>
                        <img class="uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/question.svg" uk-svg>
                    </span>
                </div>
                
            </div>
            <?php
                $saved_code = WC()->session->get('collectors_key_code');
                $coupon_applied = $saved_code && WC()->cart->has_discount($saved_code);
                $is_active = $coupon_applied;
            ?>

			<?php if (wc_coupons_enabled()) : ?>
				<ul class="cart__accordeon cart__coupon-prop product-detail__accordeon uk-accordion" uk-accordion>
					<li class="product-detail__accordeon-elem <?=$is_active ? 'uk-open' : ''?>">
						<a class="cart__coupon-prop-title product-detail__accordeon-title" href="javascript: void(0);" id="coupon_accordion" aria-controls="uk-coupon-accordion" aria-expanded="<?=$is_active ? 'true' : 'false'?>" aria-disabled="false">
							<span class="text_body-small">Collector's Key</span>
							<img class="product-detail__accordeon-plus" src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" uk-svg>
						</a>
						<div class="product-detail__accordeon-content cart__coupon-prop-content" id="uk-coupon-accordion" role="region" <?=!$is_active ? 'hidden' : ''?> aria-labelledby="coupon_accordion">
							<?=do_shortcode('[custom_coupon_field]')?>
                            <?=wc_print_notices();?>
						</div>
					</li>
				</ul>
			<?php endif; ?>
			
			<?php if ($coupon_applied) : ?>
				<div class="cart__total-prop cart__total-discount">
					<span class="text_body-small cart__total-prop-key">
						<strong>Privilege unlocked</strong>
					</span>
					<div class="cart__total-prop-desc-wrapper">
						<span class="text_body-small cart__total-prop-desc">
							<strong class="cart__total-discount-value">– <?=getCartTotalDiscount($saved_code);?> USD</strong>
						</span>
					</div>
				</div>
			<?php endif; ?>
			
            <div class="cart__total-subtotal">
                <span class="text_body cart__total-subtotal-text">
                    <strong>Total</strong>
                </span>
                <div class="cart__total-subtotal-value-wrapper">
                    <span class="text_body cart__total-subtotal-value"><?=wc_cart_totals_order_total_html();?></span>
                    <span class="text_caption cart__total-subtotal-desc">VAT Included</span>
                </div>
            </div>
			<div class="wc-proceed-to-checkout">
				<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
				<a href="/checkout/" class="btn cart__total-btn text_btn">Proceed to Checkout</a>
			</div>
			
			<div class="uk-flex uk-flex-between uk-flex-middle uk-padding-small uk-padding-remove-left uk-padding-remove-bottom uk-padding-remove-right">
				<div class="checkout__privacy-wrapper uk-margin-remove">
					<img src="<?=get_template_directory_uri()?>/assets/images/icons/secure-new.svg" class="checkout__privacy-wrapper-icon" uk-svg>
					<strong class="text_caption-small checkout__privacy-wrapper-text">Secure and encrypted</strong>
				</div>

				<img src="<?=get_template_directory_uri()?>/assets/images/icons/stripe-logo-icon.svg" class="checkout__stripe-powered uk-preserve uk-margin-remove" uk-svg>
			</div>
        </div>
        
		<ul class="cart__accordeon checkout__accordeon product-detail__accordeon">
			<li class="product-detail__accordeon-elem custom-list">
				<a class="product-detail__accordeon-title" id="returns_accordeon" href>
					<div class="product-detail__accordeon-title-group">
						<img class="product-detail__title-icon uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/returns.svg" uk-svg>
						<span class="text_body">Easy 14-Day Returns</span>								</div>
					<img class="product-detail__accordeon-plus" src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" uk-svg>
				</a>
				<div class="text_body product-detail__accordeon-content">
					<?=get_field('returns', 'option');?>
				</div>
			</li>
			<li class="product-detail__accordeon-elem custom-list">
				<a class="product-detail__accordeon-title" id="shipping_accordeon" href>
					<div class="product-detail__accordeon-title-group">
						<img class="product-detail__title-icon uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/shipping.svg" uk-svg>
						<span class="text_body">Fast & Free Shipping</span>
					</div>
					<img class="product-detail__accordeon-plus" src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" uk-svg>
				</a>
				<div class="text_body product-detail__accordeon-content">
					<?=get_field('shipping_delivery', 'option');?>
				</div>
			</li>
			<li class="product-detail__accordeon-elem custom-list">
				<a class="product-detail__accordeon-title" href>
					<div class="product-detail__accordeon-title-group">
						<img class="product-detail__title-icon uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/secure-payments.svg" uk-svg>
						<span class="text_body">Secure Payment</span>
					</div>
					<img class="product-detail__accordeon-plus" src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" uk-svg>
				</a>
				<div class="text_body product-detail__accordeon-content">
					<?=get_field('payment', 'option');?>
				</div>
			</li>
			<li class="product-detail__accordeon-elem custom-list">
				<a class="product-detail__accordeon-title" href>
					<div class="product-detail__accordeon-title-group">
						<img class="product-detail__title-icon uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/guarantee.svg" uk-svg>
						<span class="text_body">Product Guarantee</span>
					</div>
					<img class="product-detail__accordeon-plus" src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" uk-svg>
				</a>
				<div class="text_body product-detail__accordeon-content">
					<?=get_field('product_guarantee', 'option');?>
				</div>
			</li>
		</ul>

		<div class="support-card">
			<div class="support-card__title product-detail__accordeon-title-group">
				<img class="product-detail__title-icon uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/message.svg" uk-svg>
				<span class="text_body">Need Assistance?</span>
			</div>
			<div class="support-card__text text_body">
				<?=get_field('support', 'option');?>
			</div>
			<a href="#support" class="support-card__button underline">TALK TO US</a>
		</div>
    </div>
</div>