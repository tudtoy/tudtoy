
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
    <input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="checkout__radio-input input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
    <label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>" class="checkout__radio-wrapper" >
        <div class="checkout__radio-circle"></div>
        <span class="text_body-small checkout__radio-text"><?php echo $gateway->get_title(); ?></span>
    </label>
    <?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
        <div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
            <?php $gateway->payment_fields(); ?>
        </div>
    <?php endif; ?>
</li>
