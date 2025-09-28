<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="row">
	<div class="col-md-7">
		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<div class="shipping-form">
					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					<div class="col2-set" id="customer_details">
						<div class="col-1">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
						</div>

						<div class="col-2">
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						</div>
					</div>
				</div>

				<div class="paying-form d-none">
					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
				</div>

			<?php endif; ?>

			<div class="mobile-order-infos">
        <button>
            <span>Order Summary</span>
            <span><?php echo WC()->cart->get_total(); ?></span>
        </button>
        <div class="order-totals">
            <ul>
                <li>
                    <span>Subtotal</span>
                    <span><?php echo wc_price( WC()->cart->get_subtotal() ); ?></span>
                </li>
                <li>
                    <span>Shipping</span>
                    <span>
                        <?php 
                        $shipping_total = WC()->cart->get_shipping_total();
                        echo $shipping_total > 0 ? wc_price( $shipping_total ) : 'Free';
                        ?>
                    </span>
                </li>
            </ul>
            <ul class="total">
                <li>
                    <span>Total</span>
                    <span><?php echo wc_price( WC()->cart->get_total('edit') ); ?></span>
                </li>
            </ul>


        </div>
		<div class="accept-check d-none">
			<input id="terms" type="checkbox" name="" id="">
			<label for="terms">I accept the <a href="" target="_blank">Terms & Conditions</a>, including for custom products.</label>
		</div>
        <a href="<?= home_url('checkout') ?>">Proceed to checkout</a>
    </div>



		</form>

	</div>
	<div class="col-md-5">
		<div class="cart-collaterals">
			<div class="cart_totals">
				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
					
				<h3 id="order_review_heading"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h3>
				
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php 
						do_action( 'woocommerce_checkout_order_review' ); 
					?>
					<div class="accept-check d-none">
						<input id="terms" type="checkbox" name="" id="">
						<label for="terms">I accept the <a href="" target="_blank">Terms & Conditions</a>, including for custom products.</label>
					</div>
					<div class="wc-proceed-to-checkout pb-0">
						<a href="" class="checkout-button button alt wc-forward mb-0">
							Proceed to checkout
						</a>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
			<?php if ( wc_coupons_enabled() ) { ?>
                <div class="coupon">
                    <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
                    <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                </div>
            <?php } ?>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<script>
    jQuery(document).ready(function($){

		$(document).on("click", ".page-template-template-checkout .cart_totals .checkout-button,.mobile-order-infos a", function(e) {
			e.preventDefault(); // prevent default checkout action

			let allFilled = true; // flag to track if all required fields are filled
			let firstEmptyField = null;

			// Loop through all inputs/selects with aria-required="true"
			$('.woocommerce-billing-fields input[aria-required="true"]').each(function() {
				let value = $(this).val();
				if (!value || value.trim() === "") {
					allFilled = false;
					firstEmptyField = firstEmptyField || this; // store the first empty field
					$(this).addClass('error'); // optional: add class to highlight empty field
				} else {
					$(this).removeClass('error'); // remove error class if filled
				}
			});

			if (!allFilled) {
				alert("Please fill all required fields before proceeding."); 
				if (firstEmptyField) $(firstEmptyField).focus(); // focus first empty field
				return false;
			}

			// If all fields are filled, submit the form
			if($('.paying-form').hasClass('d-none')){
				$('.cart_totals a').text('Confirm and pay');
				$('.cart_totals a').addClass('pay');

				$('.mobile-order-infos a').text('Confirm and pay');
				$('.mobile-order-infos a').addClass('pay');

				$('.accept-check').removeClass('d-none');

				$('.paying-form').removeClass('d-none');
				$('.shipping-form').addClass('d-none');
				$("html, body").animate({ scrollTop: 0 }, "slow");
			}
			else{
				if (!$('.accept-check input').is(':checked')) {
					$('.accept-check').addClass('error');
				}
				else{
					$('.accept-check').removeClass('error');
					$('#place_order').trigger('click');
				}
			}
			//$('form.checkout').submit();
		});

		$(document).on("click", ".mobile-order-infos button", function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $totals = $('.mobile-order-infos .order-totals');

            if (!$btn.hasClass('open')) {
                $btn.addClass('open');
                $totals.stop(true, true).slideDown(300); // smooth slide down
            } else {
                $btn.removeClass('open');
                $totals.stop(true, true).slideUp(300); // smooth slide up
            }
        });
		$(document).on("change", ".accept-check input[type=checkbox]", function(e) {
			if($(this).is(':checked')){
				$('.accept-check input[type=checkbox]').prop('checked', true);
			}
			else{
				$('.accept-check input[type=checkbox]').prop('checked', false);
			}
		});

	});
</script>