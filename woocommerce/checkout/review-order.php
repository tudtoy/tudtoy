<? defined( 'ABSPATH' ) || exit; ?>

<div id="order_review" class="woocommerce-checkout-review-order-table">
    <div class="checkout__total">
        <div class="checkout__total-products">
            <? foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
                <?
                    $tud_id = $cart_item['product_id'];
                    $tud = wc_get_product($tud_id);
                    $collection = get_field('collection', $tud_id);
                    $is_collectors_sets = get_field('is_collectors_sets', $tud_id);

                    $size_label = get_field('size_label', $tud_id);

                    $price = $cart_item['line_total'];
                    if($price == 0) {
                        $price = 'FREE';
                    }
                    else {
                        $price = '$' . $price;
                    }
                ?>

                <div class="checkout__total-product-row">
                    <img src="<?=get_field('avatar', $tud_id)['sizes']['thumbnail'];?>" class="checkout__total-avatar">
                    <div class="checkout__total-product-info">
                        <div class="checkout__total-product-row-left">
                            <? if(!empty(get_field('text_instead_of_price', $tud_id))): ?>
                                <span class="text_body-small checkout__total-product-name"><?=$tud->get_name()?></span>
                            <? else: ?>
                                <span class="text_body-small checkout__total-product-name">TUD x <?=get_the_title($collection)?></span>
                            <? endif; ?>
                            <? if ( !$is_collectors_sets ) : ?>
                                <span class="text_caption-small checkout__total-product-props">Size <?=get_field('size_label', $tud_id)?> / <?=get_field('dimensions_mm', $tud_id)['height']?> mm</span>
                            <? else : ?>
                                <? $i = 0; ?>

                                <? if( have_rows('size', $tud_id) ): ?>
                                    <span class="text_caption-small checkout__total-product-props">
                                        <? while( have_rows('size', $tud_id) ) : the_row(); ?>
                                            <? 
                                                $size_label = get_sub_field('size_label');
                                                $size_add_text = get_sub_field('size_add_text');
                                            ?>
                                            Size <?=$size_label?> / <?=get_sub_field('dimensions_mm')['height']?> mm
                                            <? if ($i == 0) : ?>
                                                <br>
                                            <? endif; ?>

                                            <? $i++; ?>
                                        <? endwhile; ?>
                                    </span>
                                <? endif; ?>
                            <? endif; ?>
                        </div>
                        <div class="checkout__total-product-row-right">
                            <span class="text_caption checkout__total-product-quantity">x<?=$cart_item['quantity']?></span>
                            <span class="text_body-small checkout__total-product-price"><?=$price?></span>
                        </div>
                    </div>
                </div>

            <? endforeach; ?>
        </div>
        <div class="checkout__total-rows">
            <div class="checkout__total-row">
                <div class="checkout__total-row-left">
                    <div class="text_body-small checkout__total-row-title">Items</div>
                </div>
                <div class="checkout__total-row-right">
                    <span class="text_caption checkout__total-row-quantity">x<?=WC()->cart->cart_contents_count;?></span>
                    <span class="text_body-small checkout__total-row-price"><?=wc_cart_totals_subtotal_html();?></span>
                </div>
            </div>
            <!-- <div class="checkout__total-row">
                <div class="checkout__total-row-left">
                    <div class="text_body-small checkout__total-row-title">Gift Note</div>
                </div>
                <div class="checkout__total-row-right">
                    <span class="text_caption checkout__total-row-quantity">x1</span>
                    <span class="text_body-small checkout__total-row-price">Free</span>
                </div>
            </div> -->
            <div class="checkout__total-row">
                <div class="checkout__total-row-left">
                    <div class="text_body-small checkout__total-row-title">Shipping</div>
                </div>
                <div class="checkout__total-row-right">
                    <div class="cart__total-prop-desc-wrapper">
                        <span class="text_caption cart__total-prop-desc-secondary" data-portal-click="#shipping_accordeon">
                            <span class="text_body-small checkout__total-row-quantity"><?=WC()->cart->get_cart_shipping_total();?></span>
                            <img class="uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/question.svg" uk-svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout__main-total-row">
            <div class="checkout__main-total-row-left">
                <span class="text_body checkout__main-total-row-title">
                    <strong>Total</strong>
                </span>
            </div>
            <div class="checkout__main-total-row-right">
                <span class="text_body checkout__main-total-row-price"><?=wc_cart_totals_order_total_html();?></span>
                <span class="text_caption checkout__main-total-row-desc">VAT Included</span>
            </div>
        </div>
        <?php //echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="text_btn btn checkout__btn alt' . esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) . '" name="woocommerce_checkout_place_order" id="place_order" value="Pay Now" data-value="Pay Now">' . 'Pay Now' . '</button>' ); // @codingStandardsIgnoreLine ?>

        <button type="submit" class="text_btn btn checkout__btn">Pay Now</button>
		
		<div class="checkout__privacy-wrapper">
			<img src="<?=get_template_directory_uri()?>/assets/images/icons/secure-new.svg" class="checkout__privacy-wrapper-icon" uk-svg>
			<strong class="text_caption-small checkout__privacy-wrapper-text">Secure and encrypted</strong>
		</div>
		
        <div class="checkout__privacy-wrapper uk-text-center">
            <span class="text_caption-small checkout__privacy-wrapper-text uk-text-center">All transactions are secured. TUD website is provided with an SSL encryption system to protect personal and payment data.</span>
        </div>
		
		<img src="<?=get_template_directory_uri()?>/assets/images/icons/stripe-powered.svg" class="checkout__stripe-powered uk-preserve" uk-svg>
    </div>
</div>