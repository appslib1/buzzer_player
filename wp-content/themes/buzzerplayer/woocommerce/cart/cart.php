<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="row">
    <div class="col-md-7">
        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <div class="cart-cards">
        <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : 
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

            if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 || !apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) continue;

            if ( $_product->is_sold_individually() ) {
                $min_quantity = 1;
                $max_quantity = 1;
            } else {
                $min_quantity = 0;
                $max_quantity = $_product->get_max_purchase_quantity();
            }
        ?>

        <div class="cart-card">
            <div class="cart-head">
                <div class="thumbnail-price">
                    <?php
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    if ( $product_permalink ) {
                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                    } else {
                        echo $thumbnail;
                    }
                    ?>
                    <div class="product-price">
                        <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                    </div>
                </div>
                <div>
                    <h3><?= $product_name ?></h3>
                    <div class="audios-list">
                        <?php if ( ! empty( $cart_item['selected_audios'] ) ) : ?>
                            <?php foreach ( $cart_item['selected_audios'] as $key => $audio ) : 
                                $audio_name = esc_html( $audio['name'] );
                                $audio_url  = esc_url( $audio['url'] );
                            ?>
                                <?php if ( $key <= 1 ) : ?>
                                    <div class="audio">
                                        <button data-audio="<?= $audio_url ?>"></button>
                                        <span><?= $audio_name ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ( count($cart_item['selected_audios']) > 2 ) : ?>
                            <div class="left-items">
                                <i>+<?= count($cart_item['selected_audios']) - 2 ?> fart sounds</i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="quantity-group">
                <label for="">QUANTITY</label>
                <div class="input-group qte-group" style="max-width:150px;">
                    <button type="button" class="btn btn-outline-secondary btn-decrease <?= $cart_item['quantity']=='1' ? 'delete' : '' ?> ">
                        <?= $cart_item['quantity']=="1" ? "" : "-" ?>
                    </button>
                    
                    <?php
                    if ( $_product->is_sold_individually() ) {
                                $min_quantity = 1;
                                $max_quantity = 1;
                            } else {
                                $min_quantity = 0;
                                $max_quantity = $_product->get_max_purchase_quantity();
                            }

                            $product_quantity = woocommerce_quantity_input(
                                array(
                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                    'input_value'  => $cart_item['quantity'],
                                    'max_value'    => $max_quantity,
                                    'min_value'    => $min_quantity,
                                    'product_name' => $product_name,
                                ),
                                $_product,
                                false
                            );

                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                    ?>

                    <button type="button" class="btn btn-outline-secondary btn-increase">+</button>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
    </div>

    <div class="cart-actions d-none" style="margin-top:20px;">
        <button 
            onclick="window.onbeforeunload = null;" 
            type="submit" 
            class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '' ); ?>" 
            name="update_cart" 
            value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
            <?php esc_html_e('Update cart', 'woocommerce'); ?>
        </button>
        <?php do_action('woocommerce_cart_actions'); ?>
        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
    </div>

    <?php do_action( 'woocommerce_after_cart_contents' ); ?>

    <div class="cart-products">
        <div class="add-more-products">
            <a href="<?= home_url('sounds') ?>" class="add-prodcuts">
                Add another buzzer
            </a>
        </div>
    </div>

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
            <!-- Coupon Form -->
            <?php if ( wc_coupons_enabled() ) { ?>
                <div class="coupon">
                    <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
                    <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                </div>
            <?php } ?>
            <ul class="total">
                <li>
                    <span>Total</span>
                    <span><?php echo wc_price( WC()->cart->get_total('edit') ); ?></span>
                </li>
            </ul>


        </div>
        <a href="<?= home_url('checkout') ?>">Proceed to checkout</a>
    </div>

    <?php do_action( 'woocommerce_after_cart_table' ); ?>


    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents d-none" cellspacing="0">
		
		<tbody>

			


			<tr>
				<td colspan="6" class="actions">



				</td>
			</tr>

		</tbody>
	</table>

    
</form>


    </div>
    <div class="col-md-5">
        <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
        <div class="cart-collaterals">
            <?php
                /**
                 * Cart collaterals hook.
                 *
                 * @hooked woocommerce_cross_sell_display
                 * @hooked woocommerce_cart_totals - 10
                 */
                do_action( 'woocommerce_cart_collaterals' );
            ?>
            <?php if ( wc_coupons_enabled() ) { ?>
                <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                    <div class="coupon">
                        <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
                        <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>

<script>
    jQuery(document).ready(function($){
        var currentBtn = null;
        var currentAudio = null;
        $(document).on("click",".page-template-template-cart main .cart-cards .cart-card .cart-head .audios-list .audio button",function(e) {
            e.preventDefault();
            var audioUrl = $(this).attr('data-audio');

            if (!currentAudio || currentAudio.src !== audioUrl) {
                if (currentAudio) {
                    currentAudio.pause();
                    currentAudio.currentTime = 0;
                    $(currentBtn).removeClass('pause');
                }
                currentAudio = new Audio(audioUrl);
                currentBtn = this;
                currentAudio.play();
                $(this).addClass('pause');
            }
            else {
                if (currentAudio.paused) {
                    currentAudio.play();
                    $(this).addClass('pause');
                } else {
                    currentAudio.pause();
                    $(this).removeClass('pause');
                }
            }

            currentAudio.onended = function() {
                $(currentBtn).removeClass('pause');
            };
            
        });
        //mobile-order-infos
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

    });
</script>