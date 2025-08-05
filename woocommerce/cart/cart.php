<? defined( 'ABSPATH' ) || exit; ?>

<section class="cart">
    <div class="container cart__container">
        <h1 class="cart__title text_h1-medium"><? the_title(); ?></h1>
        <div class="cart__content">
            <? get_template_part('woocommerce/cart/cart', 'content') ?>
        </div>
    </div>
</section>