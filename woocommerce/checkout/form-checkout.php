<? defined( 'ABSPATH' ) || exit; ?>

<? 
    $billing_fields = $checkout->get_checkout_fields( 'billing' ); 
    $order_fields = $checkout->get_checkout_fields( 'order' );
?>

<section class="checkout-section">
    <div class="container checkout__container">
        <a href="/cart" class="checkout__back-link">
            <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
            <span class="text_link underline underline_invert checkout__back-link-text">Back to cart</span>
        </a>
        <h1 class="checkout__title text_h1-medium">Checkout</h1>
        <form class="checkout__content checkout woocommerce-checkout" name="checkout" method="post" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" novalidate="novalidate" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">
            <div class="checkout__form">

                <div class="checkout__input-group">
                    <h2 class="text_btn checkout__input-group-title">Contact information</h2>
                    <div class="checkout__inputs">
                        <?
                            woocommerce_form_field( 'billing_phone', $billing_fields['billing_phone'], $checkout->get_value('billing_phone'));
                            woocommerce_form_field( 'billing_email', $billing_fields['billing_email'], $checkout->get_value('billing_email'));
                        ?>
                    </div>
                </div>

                <div class="checkout__input-group">
                    <h2 class="text_btn checkout__input-group-title">Shipping address</h2>
                    <div class="checkout__inputs">
                        <?
                            woocommerce_form_field( 'billing_first_name', $billing_fields['billing_first_name'], $checkout->get_value('billing_first_name'));
                            woocommerce_form_field( 'billing_last_name', $billing_fields['billing_last_name'], $checkout->get_value('billing_last_name'));

                            woocommerce_form_field( 'billing_country', $billing_fields['billing_country'], $checkout->get_value('billing_country'));
                            woocommerce_form_field( 'billing_city', $billing_fields['billing_city'], $checkout->get_value('billing_city'));
                            woocommerce_form_field( 'billing_postcode', $billing_fields['billing_postcode'], $checkout->get_value('billing_postcode'));
                            woocommerce_form_field( 'billing_address_1', $billing_fields['billing_address_1'], $checkout->get_value('billing_address_1'));
                        ?>
                    </div>
                </div>

                <?  do_action('woocommerce_checkout_before_customer_details'); ?>

                <div class="checkout__input-group">
                    <h2 class="text_btn checkout__input-group-title">Payment</h2>
                    <? wc_get_template('checkout/payment.php'); ?>
                </div>

                <div class="checkout__input-group">
                    <h2 class="text_btn checkout__input-group-title">Anything else?</h2>
                    <div class="checkout__inputs">
                        <?
                            woocommerce_form_field( 'order_comments', $order_fields['order_comments'], $checkout->get_value('order_comments'));
                        ?>
                    </div>
                </div>

                <div class="checkout__shipping">
                    <? wc_cart_totals_shipping_html(); ?>
                </div>
                
                <? wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
            </div>

            <div class="checkout__side-wrapper">
                <div class="checkout__side" uk-sticky="end: true; offset: 160px; media: 768;">
                    <? wc_get_template('checkout/review-order.php'); ?>
                    <ul class="checkout__accordeon product-detail__accordeon">
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
        </form>
    </div>
</section>