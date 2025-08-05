<? defined( 'ABSPATH' ) || exit; ?>

<?
    $WC_Payment_Gateways = new WC_Payment_Gateways();
    $available_gateways = $WC_Payment_Gateways->get_available_payment_gateways();
?>

<div id="payment" class="woocommerce-checkout-payment checkout__inputs">
    <ul class="wc_payment_methods payment_methods methods">
        <? foreach ( $available_gateways as $gateway ): ?>
            <?wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );?>
        <? endforeach; ?>
    </ul>
</div>