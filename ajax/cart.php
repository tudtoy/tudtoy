<?
function getCart() {
    ob_start();

    get_template_part('woocommerce/cart/cart', 'content');  
    
    $cart = ob_get_contents();
    ob_end_clean();
    return $cart;
}

function addToCart() {
    if(empty($_POST['id'])) {
		wp_die();
	}

    $tud_id = $_POST['id'];
	
    WC()->cart->add_to_cart($tud_id);

    echo json_encode([
        'status' => 'success',
        'count' => WC()->cart->cart_contents_count,
        'mini_cart' => get_mini_cart()
    ]);
		
	wp_die();
}

function get_mini_cart() {
    ob_start();
    ?>
        <? foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
            <?
                $tud_id = $cart_item['product_id'];
                $tud = wc_get_product($tud_id);
                $collection = get_field('collection', $tud_id);
                $is_collectors_sets = get_field('is_collectors_sets', $tud_id);

                $size_label = get_field('size_label', $tud_id);

                $price = $cart_item['line_total'];
                $regular_price = $tud->get_regular_price();
                $sale_price = $tud->get_sale_price();

                $qty = $cart_item['quantity'];
                
                if($price == 0) {
                    $price = 'FREE';
                }elseif(!empty($sale_price)) {
                    $price = $sale_price ? '<ins>' . esc_html( '$' . $price ) . '</ins> <br><del>' . esc_html( '$' . $regular_price * $qty ) . '</del>' : '';
                } else {
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
    <?
    return ob_get_clean();
}

function removeFromCart() {
    if(empty($_POST['cart_item_id'])) {
		wp_die();
	}

    $cart_item_id = $_POST['cart_item_id'];
	
    WC()->cart->remove_cart_item($cart_item_id);

    echo json_encode([
        'status' => 'success',
        'count' => WC()->cart->cart_contents_count,
        'cart_html' => getCart()
    ]);
		
	wp_die();
}

function changeQuantityCart() {
    if(empty($_POST['quantityData'])) {
		wp_die();
	}
    $quantityData = $_POST['quantityData'];

    foreach($quantityData as $item) {
        WC()->cart->set_quantity( $item['cart_item_id'], $item['quantity'] );
    }

    echo json_encode([
        'status' => 'success',
        'count' => WC()->cart->cart_contents_count,
        'cart_html' => getCart()
    ]);

    wp_die();
}

?>