<?php
/**
 * @version 3.0.0
 * @var WC_Payment_Gateway_Stripe_CC $gateway
 */
?>
<div class="wc-stripe-simple-form">
    <div class="row">
        <div class="field">
            <div id="stripe-card-number" class="input empty"></div>
            <label for="stripe-card-number"
                   data-tid=""><?php esc_html_e( 'Card number', 'woo-stripe-payment' ) ?></label>
            <div class="baseline"></div>
        </div>
    </div>
    <div class="row">
        <div class="field half-width">
            <div id="stripe-exp" class="input empty"></div>
            <label for="stripe-exp"
                   data-tid=""><?php esc_html_e( 'MM/YY', 'woo-stripe-payment' ) ?></label>
            <div class="baseline"></div>
        </div>
        <div class="field half-width cvc">
            <div id="stripe-cvv" class="input empty"></div>
            <label for="stripe-cvv"
                   data-tid=""><?php esc_html_e( 'CVC', 'woo-stripe-payment' ) ?></label>
            <div class="baseline"></div>
        </div>
    </div>
	<?php if ( $gateway->postal_enabled() ): ?>
        <div class="row">
            <div class="field postalCode" tabindex="-1">
                <input type="text" id="stripe-postal-code" class="input empty"
                       value="<?php echo esc_attr( WC()->checkout()->get_value( 'billing_postcode' ) ) ?>"/>
                <label><?php esc_html_e( 'ZIP', 'woo-stripe-payment' ) ?></label>
                <div class="baseline"></div>
            </div>
        </div>
	<?php endif; ?>
</div>
<style type="text/css">
.gpay-button-fill .gpay-button {
    height: 52px!important;
}

ul.payment_methods {
    margin-bottom: 0;
}

#wc-stripe-card {
    display: none !important;
}

.wc-stripe-simple-form {
    background-color: transparent;
    padding: 0;
    margin: 20px 0;
    display: flex;
    flex-direction: row;
    gap: 12px;
    box-shadow: none;
    border: none;
    outline: none;
}

.wc-stripe-simple-form .StripeElement,
.wc-stripe_cc-container .wc-stripe-simple-form .StripeElement {
    padding-left: 0;
}

.wc-stripe_cc-container .StripeElement {
    border-radius: 8px !important;
    border: none !important;
    padding: 0 16px !important;
    height: 30px !important;
}

.wc-stripe-simple-form * {
    font-family: inherit;
    font-size: 16px;
    font-weight: 400;
}

.wc-stripe-simple-form .postalCode label {

}

.wc-stripe-simple-form .row {
    display: -ms-flexbox;
    display: flex;
    width: 100%;
    margin: 0;
    gap: 12px;
}

.wc-stripe-simple-form .field {
    position: relative;
    border-radius: 8px;
    width: 100%;
    height: 56px;
    color: var(--charcoal);
    border: 1px solid var(--platinum);
    padding-top: 30px;
    margin: 0;
    transition: all .3s ease-in-out;
}

.wc-stripe-simple-form .field:hover {
    border: 1px solid var(--graphite);
}

.wc-stripe-simple-form .field.half-width {
    width: 50%;
}

.wc-stripe-simple-form .field.quarter-width {
    width: 25%;
}

.wc-stripe-simple-form .baseline {
    display: none;
    position: absolute;
    width: 100%;
    height: 1px;
    left: 0;
    bottom: 0;
    background-color: var(--platinum);
    transition: background-color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.wc-stripe-simple-form label,
.woocommerce-checkout .woocommerce-checkout #payment ul.payment_methods li .wc-stripe-simple-form label {
    position: absolute;
    width: 100%;
    left: 0;
    bottom: 16px;
    color: var(--silverstone);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    transform-origin: 0 50%;
    cursor: text;
    transition-property: color, transform;
    transition-duration: 0.3s;
    transition-timing-function: cubic-bezier(0.165, 0.84, 0.44, 1);
    margin-bottom: 0;
    padding: 0 16px;
}

.wc-stripe-simple-form .input {
    position: absolute;
    width: 100%;
    left: 0;
    bottom: 0;
    padding-bottom: 7px;
    color: #32325d;
    background-color: transparent;
}

.wc-stripe-simple-form #stripe-postal-code {
    height: 56px;
    padding: 0;
    margin: 0;
    box-shadow: none;
    border: none;
    outline: none;
}

.wc-stripe-simple-form input#stripe-postal-code:focus {
    outline: none;
}

.wc-stripe-simple-form .input::-webkit-input-placeholder {
    color: transparent;
    transition: color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.wc-stripe-simple-form .input::-moz-placeholder {
    color: transparent;
    transition: color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.wc-stripe-simple-form .input:-ms-input-placeholder {
    color: transparent;
    transition: color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.wc-stripe-simple-form .input.StripeElement {
    opacity: 0;
    transition: opacity 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    will-change: opacity;
}

.wc-stripe-simple-form .input.focused,
.wc-stripe-simple-form .input:not(.empty) {
    opacity: 1;
}

.wc-stripe-simple-form .input.focused::-webkit-input-placeholder,
.wc-stripe-simple-form .input:not(.empty)::-webkit-input-placeholder {
    color: var(--charcoal);
}

.wc-stripe-simple-form .input.focused::-moz-placeholder,
.wc-stripe-simple-form .input:not(.empty)::-moz-placeholder {
    color: var(--charcoal);
}

.wc-stripe-simple-form .input.focused:-ms-input-placeholder,
.wc-stripe-simple-form .input:not(.empty):-ms-input-placeholder {
    color: var(--charcoal);
}

.wc-stripe-simple-form .input.focused + label,
.wc-stripe-simple-form .input:not(.empty) + label {
    color: #aab7c4;
    transform: scale(0.8) translate(2px, -18px);
    cursor: default;
}

.wc-stripe-simple-form .input.focused + label {
    color: #24b47e;
}

.wc-stripe-simple-form .input.invalid + label {
    color: #ffa27b;
}

.wc-stripe-simple-form .field:has(> .input.focused) {
    border: 1px solid var(--graphite);
}

.wc-stripe-simple-form .field:has(> .input.focused.invalid) {
    border: 1px solid #e25950;
}

.wc-stripe-simple-form input, .wc-stripe-simple-form button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: none;
    border-style: none;
}

.wc-stripe-simple-form input:-webkit-autofill {
    -webkit-text-fill-color: #e39f48;
    transition: background-color 100000000s;
    -webkit-animation: 1ms void-animation-out;
}

.wc-stripe-simple-form .StripeElement--webkit-autofill {
    background: transparent !important;
}

.wc-stripe-simple-form input, .wc-stripe-simple-form button {
    -webkit-animation: 1ms void-animation-out;
}

.wc-stripe-simple-form button {
    display: block;
    width: calc(100% - 30px);
    height: 56px;
    margin: 40px 15px 0;
    background-color: #24b47e;
    border-radius: 4px;
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    cursor: pointer;
}

.wc-stripe-simple-form .error svg {
    margin-top: 0 !important;
}

.wc-stripe-simple-form .error svg .base {
    fill: #e25950;
}

.wc-stripe-simple-form .error svg .glyph {
    fill: #fff;
}

.wc-stripe-simple-form .error .message {
    color: #e25950;
}

.wc-stripe-simple-form .success .icon .border {
    stroke: #abe9d2;
}

.wc-stripe-simple-form .success .icon .checkmark {
    stroke: #24b47e;
}

.wc-stripe-simple-form .success .title {
    color: #32325d;
    font-size: 16px !important;
}

.wc-stripe-simple-form .success .message {
    color: #8898aa;
    font-size: 13px !important;
}

.wc-stripe-simple-form .success .reset path {
    fill: #24b47e;
}

@media all and (max-width: 620px) {
    .wc-stripe-simple-form {
        margin: 16px 0;
        gap: 10px;
    }

    .wc-stripe_cc-container .StripeElement {
        padding: 0 10px !important;
    }

    .wc-stripe-simple-form .row {
        gap: 10px;
    }

    .wc-stripe-simple-form label,
    .woocommerce-checkout .woocommerce-checkout #payment ul.payment_methods li .wc-stripe-simple-form label {
        bottom: 14px;
        padding: 0 10px;
        font-size: 14px;
    }

    .wc-stripe-simple-form .input.focused + label,
    .wc-stripe-simple-form .input:not(.empty) + label {
        transform: scale(0.8) translate(4px, -16px);
    }

    .wc-stripe-simple-form .field {
        height: 48px;
        padding-top: 24px;
    }

    .wc-stripe-simple-form .success .title {
        font-size: 14px !important;
    }

    .wc-stripe-simple-form .success .message {
        font-size: 12px !important;
    }
}
</style>