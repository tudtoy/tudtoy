<?

add_filter('wc_stripe_elements_params', function($params) {
    $params['stripeStyles'] = [
        'base' => [
            'iconColor' => '#4A6CF7',
            'color' => '#2D3748',
            'fontSize' => '16px',
            '::placeholder' => [
                'color' => '#A0AEC0',
            ],
        ],
    ];
    return $params;
});

/* Cart Coupon - start */

// Save coupon status & value after page reloading
add_action('wp_loaded', 'handle_collectors_key_persistence');
function handle_collectors_key_persistence() {
    if (isset($_POST['apply_coupon']) && !empty($_POST['coupon_code'])) {
        WC()->session->set('collectors_key_code', sanitize_text_field($_POST['coupon_code']));
    }
    
    if (isset($_POST['remove_coupon'])) {
        $coupon_code = WC()->session->get('collectors_key_code');
        if ($coupon_code) {
            WC()->cart->remove_coupon($coupon_code);
            WC()->session->__unset('collectors_key_code');
            WC()->session->__unset('collectors_key_status');
        }
    }
}

// Add coupon removing functionality
add_action('wp_ajax_remove_collectors_key', 'ajax_remove_collectors_key');
add_action('wp_ajax_nopriv_remove_collectors_key', 'ajax_remove_collectors_key');
function ajax_remove_collectors_key() {
    $coupon_code = WC()->session->get('collectors_key_code');
    if ($coupon_code) {
        WC()->cart->remove_coupon($coupon_code);
        WC()->session->__unset('collectors_key_code');
        WC()->session->__unset('collectors_key_status');
        echo 'removed';
    }
    wp_die();
}

// Custom Coupon Shortcode
add_shortcode('custom_coupon_field', 'custom_coupon_field_shortcode');
function custom_coupon_field_shortcode() {
    ob_start();
    $saved_code = WC()->session->get('collectors_key_code');
    $coupon_applied = $saved_code && WC()->cart->has_discount($saved_code);
    ?>
	<div class="coupon">
		<input 
			   type="text" 
			   name="coupon_code" 
			   class="input-text" 
			   id="coupon_code" 
			   value="<?php echo $saved_code ? esc_attr($saved_code) : ''; ?>" 
			   
			   <?php echo $coupon_applied ? 'readonly' : ''; ?>
		/>
		
		<button type="submit" class="button" id="apply-coupon" name="apply_coupon" <?php if ($coupon_applied) echo 'hidden'; ?> >
			<?php esc_html_e('Apply', 'woocommerce'); ?>
		</button>

		<button type="submit" class="button" id="remove-coupon" name="remove_coupon" <?php if (!$coupon_applied) echo 'hidden'; ?>>
			<?php esc_html_e('Remove', 'woocommerce'); ?>
		</button>
	</div>

	<div class="collectors-key-feedback">
		<?php
		if ($coupon_applied) {
			echo '<div class="collectors-key-success">Welcome inside</div>';
		} elseif (WC()->session->get('collectors_key_status') === 'error') {
			echo '<div class="collectors-key-error">Key not valid</div>';
		}
		?>
	</div>
    <?php
    return ob_get_clean();
}

// Модифицированная AJAX функция для применения купона
add_action('wp_ajax_apply_collectors_key', 'ajax_apply_collectors_key');
add_action('wp_ajax_nopriv_apply_collectors_key', 'ajax_apply_collectors_key');
function ajax_apply_collectors_key() {
    $coupon_code = sanitize_text_field($_POST['coupon_code']);
    $coupon = new WC_Coupon($coupon_code);

    if ($coupon->get_id() && $coupon->is_valid()) {
        WC()->cart->apply_coupon($coupon_code);
        WC()->session->set('collectors_key_code', $coupon_code);
        WC()->session->set('collectors_key_status', 'success');
        echo '<div class="collectors-key-success">Welcome inside</div>';
    } else {
        WC()->session->set('collectors_key_status', 'error');
        echo '<div class="collectors-key-error">Key not valid</div>';
    }
    wp_die();
}

// Вспомогательная функция для получения суммы скидки
function getCartTotalDiscount($coupon_code) {
    $discount = WC()->cart->get_discount_total();
    return number_format($discount, 0);
}

/* Cart Coupon - end */

add_action( 'wp_enqueue_scripts', 'add_themes_assets' );
function add_themes_assets(){
	
	// CSS
	/*BASE*/
	wp_enqueue_style( 'uikit', get_template_directory_uri().'/assets/static/uikit.min.css' );
	wp_enqueue_style( 'swiper', get_template_directory_uri().'/assets/static/swiper-bundle.min.css' );
	wp_enqueue_style( 'intlTelInput', get_template_directory_uri().'/assets/static/intlTelInput.min.css' );
	wp_enqueue_style( 'style', get_template_directory_uri().'/assets/css/style.css?v='.filemtime(get_theme_file_path() . '/assets/css/style.css'));
	wp_enqueue_style( 'cookies', get_template_directory_uri().'/assets/css/cookies.css?v='.filemtime(get_theme_file_path() . '/assets/css/cookies.css')); 
    /*BASE*/
	
    /*ADDITIONAL*/
	wp_enqueue_style( 'custom', get_template_directory_uri().'/additional/css/custom.css?v='.filemtime(get_theme_file_path() . '/additional/css/custom.css'));
	if(is_admin_bar_showing()) {
		wp_enqueue_style( 'admin', get_template_directory_uri().'/additional/css/admin.css?v='.filemtime(get_theme_file_path() . '/additional/css/admin.css'));
	}
    /*ADDITIONAL*/
	
	// JS
	
	/*BASE*/
	wp_deregister_script('jquery');
 	wp_enqueue_script('jquery', get_template_directory_uri().'/assets/static/jquery.min.js', array(), null, true);
	wp_enqueue_script('uikit', get_template_directory_uri().'/assets/static/uikit.min.js','','',true);
	wp_enqueue_script('imask', get_template_directory_uri().'/assets/static/imask.min.js','','',true);
	wp_enqueue_script('swiper', get_template_directory_uri().'/assets/static/swiper-bundle.min.js','','',true);
	wp_enqueue_script('intlTelInput', get_template_directory_uri().'/assets/static/intlTelInputWithUtils.min.js','','',true);
	wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), filemtime( get_theme_file_path() . '/assets/js/app.js' ), true);
	wp_enqueue_script('cookies-script', get_template_directory_uri() . '/assets/js/cookies-script.js', '', filemtime( get_theme_file_path() . '/assets/js/cookies-script.js' ), true);
	/*BASE*/
	
	/*ADDITIONAL*/
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/additional/js/custom.js', array('jquery'), filemtime( get_theme_file_path() . '/additional/js/custom.js' ), true);
	/*ADDITIONAL*/

	wp_localize_script( 'main-script', 'wp',
		array(
			'url' => admin_url('admin-ajax.php'),
			'country' => Wt::$geolocation->getValue('country')
		)
	);

}

function add_jquery() { 
	wp_enqueue_script( 'jquery' );
}    
add_action('init', 'add_jquery');

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
function add_type_attribute($tag, $handle, $src) {

    if ( 'main-script' !== $handle ) return $tag;
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

// Разрешение на добавление SVG в медиафайлы
add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}

add_theme_support('menus');
add_theme_support( 'title-tag' );

register_nav_menus( array(
	'header' => 'Header',
	'burger-about' => 'Burger about',
	'burger-contact' => 'Burger contact',
	'footer-main' => 'Footer Main',
	'footer-about' => 'Footer About',
	'footer-contact' => 'Footer Contact',
	'footer-social' => 'Footer Social',
	'footer-privacy' => 'Footer Privacy',
));

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
  add_theme_support( 'woocommerce' );
}

add_filter ('woocommerce_enqueue_styles', '__return_empty_array');

// Подмена mime типа SVG
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	}
	else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
	}

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){

		// разрешим
		if( current_user_can('manage_options') ){

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext']  = false;
			$data['type'] = false;
		}

	}

	return $data;
}

function debug($val)
{
	echo '<pre>';
	print_r($val);
	echo '</pre>';
}

require_once 'ajax/cart.php';

add_action( 'wp_ajax_addToCart', 'addToCart' ); 
add_action( 'wp_ajax_nopriv_addToCart', 'addToCart' ); 

add_action( 'wp_ajax_removeFromCart', 'removeFromCart' ); 
add_action( 'wp_ajax_nopriv_removeFromCart', 'removeFromCart' ); 

add_action( 'wp_ajax_changeQuantityCart', 'changeQuantityCart' ); 
add_action( 'wp_ajax_nopriv_changeQuantityCart', 'changeQuantityCart' );

require_once 'ajax/verify.php';

add_action( 'wp_ajax_verify', 'verify' ); 
add_action( 'wp_ajax_nopriv_verify', 'verify' ); 

require_once 'ajax/send.php';

add_action( 'wp_ajax_subscribe', 'subscribe' ); 
add_action( 'wp_ajax_nopriv_subscribe', 'subscribe' ); 

require_once 'ajax/utils/telegram.php';
require_once 'ajax/utils/amo/send.php';
require_once 'ajax/utils/amo/webhook.php';

add_action( 'wp_ajax_submit', 'submit' ); 
add_action( 'wp_ajax_nopriv_submit', 'submit' ); 

add_action( 'wp_ajax_sendAmoOrder', 'sendAmoOrder' ); 
add_action( 'wp_ajax_nopriv_sendAmoOrder', 'sendAmoOrder' ); 

add_action( 'wp_ajax_sendAmoLeed', 'sendAmoLeed' ); 
add_action( 'wp_ajax_nopriv_sendAmoLeed', 'sendAmoLeed' ); 

function sendAmoOrder() {
	amoCreateLead('order', $_POST);
}

function sendAmoLeed() {
	amoCreateLead('leed', $_POST);
}

add_filter( 'woocommerce_form_field_text', 'filter_woocommerce_form_field_text', 10, 4 );
function filter_woocommerce_form_field_text( $field, $key, $args, $value ) {

	$half_class = '';
	if (!empty($args['half'])) {
		$half_class = 'checkout__input-label_half';
	}

	ob_start();

	?>
		<label class="checkout__input-label input__label <?=$half_class?>">
			<input name="<?=$key?>" id="<?=$key?>" type="text" class="text_body-small input checkout__input input_checkout">
			<span class="checkout__input-placeholder input__placeholder text_body-small"><?=$args['placeholder']?></span>
			<span class="checkout__input-error-text text_caption-small"></span>
		</label>
	<?

	$field = ob_get_contents();
    ob_end_clean();
    
    return $field;
}

add_filter( 'woocommerce_form_field_tel', 'filter_woocommerce_form_field_tel', 10, 4 );
function filter_woocommerce_form_field_tel( $field, $key, $args, $value ) {
	$half_class = '';
	if (!empty($args['half'])) {
		$half_class = 'checkout__input-label_half';
	}

	ob_start();

	?>
		<label class="checkout__input-label input__label input-mask input-mask_white input-mask_disabled <?=$half_class?>">
			<input name="<?=$key?>" id="<?=$key?>" type="text" class="text_body-small input checkout__input input_checkout">
			<span class="checkout__input-placeholder input__placeholder input__placeholder_focus text_body-small"><?=$args['placeholder']?></span>
			<span class="checkout__input-error-text text_caption-small"></span>
		</label>
		<input type="hidden" name="phone_valid" value="false">
	<?

	$field = ob_get_contents();
    ob_end_clean();
    
    return $field;
}

add_filter( 'woocommerce_form_field_email', 'filter_woocommerce_form_field_email', 10, 4 );
function filter_woocommerce_form_field_email( $field, $key, $args, $value ) {

	ob_start();

	?>
		<label class="checkout__input-label input__label">
			<input name="<?=$key?>" id="<?=$key?>" type="text" class="text_body-small input checkout__input input_checkout">
			<span class="checkout__input-placeholder input__placeholder text_body-small"><?=$args['placeholder']?></span>
			<span class="checkout__input-error-text text_caption-small"></span>
		</label>
	<?

	$field = ob_get_contents();
    ob_end_clean();
    
    return $field;
}

add_filter( 'woocommerce_form_field_textarea', 'filter_woocommerce_form_field_textarea', 10, 4 );
function filter_woocommerce_form_field_textarea( $field, $key, $args, $value ) {

	ob_start();

	?>
		<label class="checkout__input-label input__label">
			<textarea name="<?=$key?>" id="<?=$key?>" type="text" class="text_body-small input textarea checkout__input input_checkout"></textarea>
			<span class="checkout__input-placeholder input__placeholder text_body-small"><?=$args['placeholder']?></span>
			<span class="checkout__input-error-text text_caption-small"></span>
		</label>
	<?

	$field = ob_get_contents();
    ob_end_clean();
    
    return $field;
}

add_filter( 'woocommerce_checkout_fields' , 'wpbl_fileds_validation', 9999  );
function wpbl_fileds_validation( $array ) {

    unset($array['billing']['billing_company']);
    unset($array['billing']['billing_address_2']);
    unset($array['billing']['billing_state']);

    $array['billing']['billing_email']['placeholder'] = 'Email';

    // $array['billing']['billing_phone']['priority'] = 25;
	// $array['billing']['billing_email']['priority'] = 26;

	// $array['billing']['billing_email']['required'] = true;

	$array['billing']['billing_first_name']['half'] = true;
	$array['billing']['billing_last_name']['half'] = true;
	$array['billing']['billing_city']['half'] = true;
	$array['billing']['billing_postcode']['half'] = true;

	$array['billing']['billing_country']['class'] = 'checkout__input-label';
	$array['order']['order_comments']['class'] = 'checkout__input-label';

    $array['billing']['billing_first_name']['placeholder'] = 'First Name';
    $array['billing']['billing_last_name']['placeholder'] = 'Last Name';
    $array['billing']['billing_phone']['placeholder'] = 'Phone Number';
    $array['billing']['billing_country']['label'] = 'Country/Region';
	$array['billing']['billing_city']['placeholder'] = 'City';
	$array['billing']['billing_address_1']['placeholder'] = 'Street address';
	$array['billing']['billing_postcode']['placeholder'] = 'Postal or ZIP code';
    $array['order']['order_comments']['placeholder'] = 'Your any wishes';

    return $array;
    
}


add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 4);
function special_nav_class($classes, $item, $args, $depth){
	if($args->menu == 'header') {
		$classes[] = 'text_link underline underline_invert';
	}
	if($args->menu == 'burger-about') {
		$classes[] = 'text_h3';
	}
	if($args->menu == 'burger-contact') {
		$classes[] = 'text_h3';
	}
	if($args->menu == 'footer-main') {
		$classes[] = 'text_link underline underline_invert';
	}
	if($args->menu == 'footer-about') {
		$classes[] = 'text_link underline underline_invert';
	}
	if($args->menu == 'footer-contact') {
		$classes[] = 'text_link underline underline_invert';
	}
	if($args->menu == 'footer-social') {
		$classes[] = 'text_link underline underline_invert';
	}
	if($args->menu == 'footer-privacy') {
		$classes[] = 'text_caption';
	}
    return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'change_wp_nav_menu', 10, 3 );
function change_wp_nav_menu( $classes, $args, $depth ) { 
	$classes[] = 'uk-dropdown';
	return $classes; 
}

add_action( 'init', function(){
	add_rewrite_rule( '^(check)/([^/]*)/([^/]*)/?', 'index.php?pagename=$matches[1]&verify-collection=$matches[2]&tud=$matches[3]', 'top' );
	add_rewrite_rule( '^(check)/([^/]*)/?', 'index.php?pagename=$matches[1]&tud=$matches[2]', 'top' );

	add_filter( 'query_vars', function( $vars ){
		$vars[] = 'tud';
		$vars[] = 'verify-collection';
		return $vars;
	} );
} );


function ru_redirect() {
	
    if(Wt::$geolocation->getValue('country') == 'Россия') {
		$ruVerifyLinks = [
			'/check/punkmetender/the-moon-is-ours/' => '/punkmetender-collection/about-tud-x-punkmetender/',
			'/check/mike-tyson/the-boxing-duck/' => '/tyson-collection/about-tud-x-mike-tyson/',
			'/check/pantone/orange-171-c/' => '/pantone-collection/about/',
			'/check/michael-jackson/king-of-pop/' => '/jackson-collection/about/',
			'/check/jean-michel-basquiat/bird-on-money-untitled-bone/' => '/basquiat-l-collection/about/',
			'/check/jean-michel-basquiat/untitled-bird/' => '/basquiat-m-collection/about/',
			'/check/chupa-chups/duckberry/' => '/chupachups-collection/about/',
			'/check/frida-kahlo/viva-la-vida/' => '/fridakahlo-l-collection/about/',
			'/check/frida-kahlo/flowers/' => '/fridakahlo-m-collection/about/',
			'/check/harif-guzman/duckulla/' => '/harifguzman-l-collection/about/',
			'/check/harif-guzman/quackulla/' => '/harifguzman-m-collection/about/',
			'/check/coca-cola/fizz-black/' => '/cocacola-fizzblack-collection/about/',
			'/check/cocacola/fizzblack/' => '/cocacola-fizzblack-collection/about/',
			'/check/cocacola/fizzblack' => '/cocacola-fizzblack-collection/about/',
			'/check/coca-cola/georgia-green/' => '/cocacola-georgiagreen-collection/about/',
			'/check/cocacola/georgiagreen/' => '/cocacola-georgiagreen-collection/about/',
			'/check/cocacola/georgiagreen' => '/cocacola-georgiagreen-collection/about/',
			'/nfc/tyson/' => '/check/mike-tyson/the-boxing-duck/',
			'/check/sample-s' => '/check/sample-s/',
			'/check/sample-s/' => '/check/sample-s/',
		];

		

		

		$url = $_SERVER['REQUEST_URI'];
		$url = explode('?', $url);
		$url = $url[0];

		foreach($ruVerifyLinks as $from => $to) {
			if($url == $from) {
				wp_redirect('https://tudtoy.ru' . $to);
				exit;
			}
		}
	}
}
add_action('init', 'ru_redirect', 10000);

add_action("template_redirect", function()  { 
    $currentUrl = trailingslashit(strtok($_SERVER['REQUEST_URI'], "?"));
    
    if (str_contains($currentUrl, '/check/')) {
		$collection_slug = get_query_var('verify-collection');
		$tud_slug = get_query_var('tud');

		if(empty($collection_slug) && $tud_slug == 'sample-s') {
			return;
		}

		$collection = get_page_by_path( $collection_slug, OBJECT, 'collection' );
		if(empty($collection)) {
			global $wp_query;
			$wp_query->set_404();
			status_header(404);
			get_template_part(404); 
			die();
		}


		$tuds = get_field('products', $collection->ID);
		if(empty($tuds)) {
			global $wp_query;
			$wp_query->set_404();
			status_header(404);
			get_template_part(404); 
			die();
		}

		$tud_in_colection = false;

		foreach($tuds as $tud) {
			if($tud->post_name == $tud_slug) {
				$tud_in_colection = true;
			}
		}

		if(!$tud_in_colection) {
			global $wp_query;
			$wp_query->set_404();
			status_header(404);
			get_template_part(404); 
			die();
		}
        
        // if (empty($author)) {
        //     global $wp_query;
        //     $wp_query->set_404();
        //     status_header(404);
        //     get_template_part(404); 
        //     die();
        // }
    }
});

add_action( 'woocommerce_checkout_update_order_meta', 'true_save_field', 25 );
 
function true_save_field( $order_id ){
	if( ! empty( $_POST[ 'full_phone' ] ) ) {
		update_post_meta( $order_id, 'full_phone', sanitize_text_field( $_POST[ 'full_phone' ] ) );
	}
}

add_action( 'woocommerce_checkout_update_order_meta', 'telegram_new_order_send', 1000, 2 );
function telegram_new_order_send( $order_id, $data ){

	$order = wc_get_order( $order_id );
	$data = $order->get_base_data();
	$items = $order->get_items();

	$order_data = [];
	$order_data['title'] = 'New order from tudtoy.com';
	$order_data['order_id'] = $order_id;
	$order_data['total_price'] = $data['total'];
	$order_data['full_name'] = $data['billing']['first_name'] . ' ' . $data['billing']['last_name'];
	$order_data['country'] = $data['shipping']['country'];
	$order_data['address'] = $data['billing']['address_1'];
	$order_data['postcode'] = $data['billing']['postcode'];
	$order_data['email'] = $data['billing']['email'];
	$order_data['phone'] = $data['billing']['phone'];

	$order_data['full_phone'] = get_post_meta( $order_id, 'full_phone', true);

	$order_data['comment'] = $data['customer_note'];
	$order_data['status'] = $order->get_status();
	$order_data['link_to_order'] = get_site_url() . '/wp-admin/admin.php?page=wc-orders&action=edit&id=' . $order_id;

	$order_data['products'] = [];
	foreach($items as $item) {
		$product = $item->get_product();
		$order_data['products'][] = [
			'item_name' => $product->get_name(),
			'price' => $product->get_price(),
			'quantity' => $item->get_quantity()
		];
	}

	sendTelegramMessage('order', $order_data);
	amoCreateLead('order', $order_data);
}

add_action('woocommerce_order_status_processing', 'orderIsPayment', 10, 2);
function orderIsPayment( $order_id, $order ) {
	if($order->get_payment_method() == 'cod') {
        return;
    }
	
    $data = $order->get_base_data();
    $items = $order->get_items();

    $order_data = [];
    $order_data['title'] = 'Статус заказа ' . $order_id . ' изменён на "Оплачен"';

    sendTelegramMessage('order', $order_data);
}

add_filter( 'do_redirect_guess_404_permalink', '__return_false' );
remove_filter('template_redirect','redirect_canonical');


add_action( 'template_redirect', 'auto_gift', 25 );
 
function auto_gift() {
 
	if ( is_admin() ) {
		return;
	}
 
	if ( WC()->cart->is_empty() ) {
		return;
	}

	// Если включена акция "Подарок"
	if (get_field('is_promo_single', 'option')) {
		$promo_tud_post = get_field('promo_product', 'option');
		if(!empty($promo_tud_post)) {
			$promo_tud = wc_get_product($promo_tud_post);
			$promo_tud_id = $promo_tud->get_id();
			$is_cart_with_products = false;
			$is_gift_in_cart = WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $promo_tud_id ));

			foreach ( WC()->cart->get_cart() as $cart_item ) {
				if($cart_item['product_id'] != $promo_tud_id) {
					$is_cart_with_products = true;
					break;
				}
			}

			if($is_cart_with_products) {
				if(!$is_gift_in_cart) {
					WC()->cart->add_to_cart( $promo_tud_id );
				}
				else {
					WC()->cart->set_quantity( WC()->cart->generate_cart_id( $promo_tud_id ), 1 );
				}
			}
			else {
				if ( $is_gift_in_cart ) {
					WC()->cart->remove_cart_item( WC()->cart->generate_cart_id( $promo_tud_id ) );
				}
			}
		}
	}
}



add_action( 'woocommerce_admin_order_data_after_billing_address', 'true_print_field_value', 25 );
 
function true_print_field_value( $order ) {
 
	if( $phone = get_post_meta( $order->get_id(), 'full_phone', true ) ) {
		echo '<p><strong>Full Phone:</strong><br>' . esc_html( $phone ) . '</p>';
	}
}

function get_product_category_by_id( $product_id ) {
    $terms = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'names'));
    return $terms[0];
}

add_filter('woocommerce_currency_symbol', 'change_currency_symbol', 10, 2);

function change_currency_symbol($currency_symbol, $currency) {
    if ($currency == 'USD') {
        return 'USD';
    }
    return $currency_symbol;
}

add_filter('woocommerce_format_sale_price', 'tud_format_sale_price', 100, 3);
function tud_format_sale_price( $price, $regular_price, $sale_price ) {
    $output_price = '<ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins> <del>' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del>' ;
    return $output_price;
}

add_action( 'pre_get_posts', 'hide_from_query' );
function hide_from_query($q) {
    $exclude_ids = array(2982);
	if ( is_admin() || is_single()) { 
		return;
	}
	if ( $exclude_ids ) {
		$q->set( 'post__not_in', $exclude_ids );
	}
	return;
}




add_filter( 'woocommerce_coupon_discount_types', 'add_free_gift_coupon_type' );
function add_free_gift_coupon_type($types) {
    $types['free_gift'] = 'Free gift';
    return $types;
}

add_action('woocommerce_applied_coupon', 'add_free_gift_to_cart_on_coupon', 10, 1);

function add_free_gift_to_cart_on_coupon($coupon_code) {
	$code = wc_format_coupon_code( $coupon_code );
    $coupon = new WC_Coupon( $code );
	$promo_tud_post = 2982;
	$cart = WC()->cart;
	$excluded_products = array(2126,2944);

    if (! is_wp_error( $coupon_code ) && $coupon->is_type( 'free_gift' )) {
        if ( has_valid_products_for_coupon($cart, $excluded_products) ) {
			if(!empty($promo_tud_post)) {
				$promo_tud = wc_get_product($promo_tud_post);
				$promo_tud_id = $promo_tud->get_id();
				$is_cart_with_products = false;
				$is_gift_in_cart = $cart->find_product_in_cart( $cart->generate_cart_id( $promo_tud_id ));

				foreach ( $cart->get_cart() as $cart_item ) {
					if($cart_item['product_id'] != $promo_tud_id) {
						$is_cart_with_products = true;
						break;
					}
				}

				if($is_cart_with_products) {
					if(!$is_gift_in_cart) {
						$cart->add_to_cart( $promo_tud_id );
					}
					else {
						$cart->set_quantity( $cart->generate_cart_id( $promo_tud_id ), 1 );
					}
				}
				else {
					if ( $is_gift_in_cart ) {
						$cart->remove_cart_item( $cart->generate_cart_id( $promo_tud_id ) );
					}
				}
			}
		}else{
			$applied_coupons = $cart->get_applied_coupons();
			foreach ($applied_coupons as $coupon_code) {
				$cart->remove_coupon($coupon_code);
			}
		}
    }
}

add_action( 'woocommerce_removed_coupon', 'delete_free_gift_to_cart' );
function delete_free_gift_to_cart( $coupon_code ){
	$code = wc_format_coupon_code( $coupon_code );
    $coupon = new WC_Coupon( $code );

    if ($coupon->is_type( 'free_gift' )) {
		$product_id = 2982;
		$cart = WC()->cart;

        foreach($cart->get_cart() as $cart_item_key => $cart_item ) {
            if ($cart_item['product_id'] === $product_id) {
                $cart->remove_cart_item( $cart_item_key );
            }
        }
	}
}

add_action('woocommerce_cart_item_removed', 'check_gift_coupon_after_removal', 20, 2);

function check_gift_coupon_after_removal($cart_item_key, $cart) {
    $applied_coupons = $cart->get_applied_coupons();
    
    foreach ($applied_coupons as $coupon_code) {
        $coupon = new WC_Coupon($coupon_code);
        $product_id = 2982;
		$excluded_products = array(2126,2944);

        if ($coupon->is_type( 'free_gift')) {
            if (!has_valid_products_for_coupon($cart, $excluded_products)) {
                $cart->remove_coupon($coupon_code);

				foreach($cart->get_cart() as $cart_item_key => $cart_item ) {
					if ($cart_item['product_id'] === $product_id) {
						$cart->remove_cart_item( $cart_item_key );
					}
				}
            }else{
				$excluded = array(2126,2944,2982);
				if (!has_valid_products_for_coupon($cart, $excluded)) {
					foreach($cart->get_cart() as $cart_item_key => $cart_item ) {
						if ($cart_item['product_id'] === $product_id) {
							$cart->remove_cart_item( $cart_item_key );
							$cart->remove_coupon($coupon_code);
						}
					}
				}

			}
        }
    }
}

function has_valid_products_for_coupon($cart, $excluded_products) {

    if ($cart->is_empty()) {
        return false;
    }
    
    foreach ($cart->get_cart() as $item) {
        $product_id = $item['product_id'];
        $variation_id = $item['variation_id'];
        $is_excluded = false;
        
        if (!empty($excluded_products)) {
            if (in_array($product_id, $excluded_products) || 
                ($variation_id && in_array($variation_id, $excluded_products))) {
                $is_excluded = true;
            }
        }

        if ($is_excluded) {
            continue;
        }
        return true;
    }
    
    return false;
}

add_filter( 'woocommerce_cart_shipping_total', 'woocommerce_cart_shipping_total_filter_callback', 11, 2 );
function woocommerce_cart_shipping_total_filter_callback( $total, $cart )
{
		$total = __( 'Free', 'woocommerce' );

		if ( 0 < $cart->get_shipping_total() ) {

			if ( $cart->display_prices_including_tax() ) {
				$total = wc_price( $cart->shipping_total + $cart->shipping_tax_total );

				if ( $cart->shipping_tax_total > 0 && ! wc_prices_include_tax() ) {
					$total .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
				}
			} else {
				$total = wc_price( $cart->shipping_total );

				if ( $cart->shipping_tax_total > 0 && wc_prices_include_tax() ) {
					$total .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
				}
			}
		}
    return  $total;
}

add_action('wp_enqueue_scripts', 'enqueue_popup_key_scripts');

function enqueue_popup_key_scripts() {
    wp_enqueue_script('key-popup-handler', get_template_directory_uri() . '/additional/js/key-popup.js', ['jquery'], null, true);
    
	wp_localize_script('key-popup-handler', 'keyPopup', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('apply_coupon_nonce')
    ));
}


remove_action( 'add_option_new_admin_email', 'update_option_new_admin_email' );
remove_action( 'update_option_new_admin_email', 'update_option_new_admin_email' );

function wpdocs_update_option_new_admin_email( $old_value, $value ) {
    update_option( 'admin_email', $value );
}
add_action( 'add_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
add_action( 'update_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );


// PINTEREST
//add_action('woocommerce_add_to_cart', 'track_add_to_cart_datalayer', 10, 6);
function track_add_to_cart_datalayer($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data) {
    $product = wc_get_product($product_id);
    
    // Prepare the data
    $data = [
        'event' => 'add_to_carta',
        'ecommerce' => [
            'currency' => get_woocommerce_currency(),
            'add' => [
                'products' => [[
                    'name' => $product->get_name(),
                    'id' => $product_id,
                    'price' => $product->get_price(),
                    'quantity' => $quantity
                ]]
            ]
        ]
    ];
    
    // Encode the data for JavaScript
    $json_data = wp_json_encode($data);
    
    // Output the script
    wc_enqueue_js("
        window.dataLayer = window.dataLayer || [];
		dataLayer.push({ ecommerce: null });
        dataLayer.push($json_data);
    ");
}


add_action('wp_footer', 'track_pinterest_woocommerce_events');
function track_pinterest_woocommerce_events() {
    if (!class_exists('WooCommerce')) return;
    
    // ViewContent event - product page view
    if (is_product()) {
        global $product;
        ?>
        <script>
            if (typeof pintrk === 'function') {
                pintrk('track', 'pagevisit', {
                    np: 'product',
                    product_id: '<?php echo $product->get_id(); ?>',
                    product_name: '<?php echo addslashes($product->get_name()); ?>',
                    product_price: <?php echo $product->get_price(); ?>,
                    currency: '<?php echo get_woocommerce_currency(); ?>'
                });
            }
        </script>
        <?php
    }
    
    // AddToCart event
    if (is_cart() && !WC()->cart->is_empty()) {
        ?>
        <script>
            if (typeof pintrk === 'function') {
                pintrk('track', 'addtocart', {
                    currency: '<?php echo get_woocommerce_currency(); ?>',
                    line_items: [
                        <?php foreach (WC()->cart->get_cart() as $cart_item): 
                        $product = $cart_item['data'];
                        ?>
                        {
                            product_id: '<?php echo $product->get_id(); ?>',
                            product_name: '<?php echo addslashes($product->get_name()); ?>',
                            product_price: <?php echo $product->get_price(); ?>,
                            product_quantity: <?php echo $cart_item['quantity']; ?>
                        },
                        <?php endforeach; ?>
                    ]
                });
            }
        </script>
        <?php
    }
    
    // Purchase event
    if (is_order_received_page()) {
        $order_id = absint(get_query_var('order-received'));
        if ($order_id && ($order = wc_get_order($order_id))) {
            ?>
            <script>
                if (typeof pintrk === 'function') {
                    pintrk('track', 'checkout', {
                        order_id: '<?php echo $order->get_order_number(); ?>',
                        value: <?php echo $order->get_total(); ?>,
                        currency: '<?php echo $order->get_currency(); ?>',
                        line_items: [
                            <?php foreach ($order->get_items() as $item): 
                            $product = $item->get_product();
                            ?>
                            {
                                product_id: '<?php echo $product->get_id(); ?>',
                                product_name: '<?php echo addslashes($product->get_name()); ?>',
                                product_price: <?php echo $product->get_price(); ?>,
                                product_quantity: <?php echo $item->get_quantity(); ?>
                            },
                            <?php endforeach; ?>
                        ]
                    });
                }
            </script>
            <?php
        }
    }
}