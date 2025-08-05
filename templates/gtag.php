<script>

    $( document ).ready(function() {

        <? if(is_product()): ?>
            <? global $product; ?>

            <?
                $price = $product->get_price();
                if(empty($price)) {
                    $price = 0;
                }
            ?>
        
            let item = {
                id: <?=$product->get_id()?>,
                google_business_vertical: 'retail',
                item_id: <?=$product->get_id()?>,
                item_name: '<?=$product->get_name()?>',
                currency: 'USD',
                item_brand: 'TUD TOY GIFTS TRADING L.L.C, DUBAI, UAE',
                price: <?=$price?>,
                quantity: 1,
            }
            
            console.log('GTAG Event view_item', item);
            gtag('event', 'view_item', {
				send_to: 'AW-16724091888',
                items: [item]
            });
        
            let addToCartButton = $('.product-detail__btn');
            addToCartButton.on('click', (event) => {
                console.log('GTAG Event add_to_cart', item);
                gtag('event', 'add_to_cart', {
					send_to: 'AW-16724091888',
                    items: [item]
                });
            })
        
        
        <? endif; ?>
        
        <? if(is_cart()): ?>
            console.log('GTAG Event view_cart');
            gtag('event', 'view_cart', {
				send_to: 'AW-16724091888',
			});
        
            let deleteCartButtons = $('.cart-card__remove');
            deleteCartButtons.on('click', (event) => {
                console.log('GTAG Event remove_from_cart');
                gtag('event', 'remove_from_cart', {
					send_to: 'AW-16724091888',
				});
            })
            
        <? endif; ?>
        
        <? if(is_checkout()): ?>
        
            <? if(is_wc_endpoint_url( 'order-received' )):?>
                
                let checkout_data = localStorage.getItem('checkout_data');
                if(checkout_data) {
                    console.log('GTAG Event purchase', JSON.parse(checkout_data));
                    gtag('event', 'purchase', JSON.parse(checkout_data));
                    gtag('event', 'conversion_event_purchase', JSON.parse(checkout_data));

                    localStorage.removeItem('checkout_data');
                }
                
        
            <? else: ?>
                let items = [];
                <?
                global $woocommerce;
                $cart_products = $woocommerce->cart->get_cart_contents();


                foreach($cart_products as $cart_product) {
                    //print_r($cart_product);
                    ?>
                        items.push({
                            id: <?=$cart_product['product_id']?>,
                            google_business_vertical: 'retail',
                            item_id: <?=$cart_product['product_id']?>,
                            item_name: '<?=$cart_product['data']->get_name()?>',
                            currency: 'USD',
                            item_brand: 'TUD TOY GIFTS TRADING L.L.C, DUBAI, UAE',
                            price: <?=$cart_product['data']->get_price()?>,
                            quantity: <?=$cart_product['quantity']?>,
                        })
                    <?
                }
                ?>
                let checkout_data = {
					send_to: 'AW-16724091888',
                    currency: 'USD',
                    affiliation: 'TUD TOY GIFTS TRADING L.L.C, DUBAI, UAE',
                    value: <?=$woocommerce->cart->get_total(false)?>,
                    items: items
                }
                console.log('GTAG Event begin_checkout', checkout_data);
                gtag('event', 'begin_checkout', checkout_data);
                localStorage.setItem('checkout_data', JSON.stringify(checkout_data));
            <? endif; ?>
        <? endif; ?>
    });
</script>