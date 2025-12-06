<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
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
 *
 * @var bool $show_downloads Controls whether the downloads table should be rendered.
 */

 // phpcs:disable WooCommerce.Commenting.CommentHooks.MissingHookComment

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items        = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$downloads          = $order->get_downloadable_items();
$actions            = array_filter(
	wc_get_account_orders_actions( $order ),
	function ( $key ) {
		return 'view' !== $key;
	},
	ARRAY_FILTER_USE_KEY
);

// We make sure the order belongs to the user. This will also be true if the user is a guest, and the order belongs to a guest (userID === 0).
$show_customer_details = $order->get_user_id() === get_current_user_id();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<section class="woocommerce-order-details">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<h2 class="woocommerce-order-details__title">Basket summary</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="orders-cards">
                <?php foreach ( $order_items as $item_id => $item ) { 
                $selected_audios_json = $item->get_meta( 'Selected Audios' );
                $selected_audios = json_decode( $selected_audios_json, true );
                $product = $item->get_product();    
                $thumbnail         = $product->get_image();
                $product_name      = $product->get_name();
                $product_permalink = $product->is_visible() ? $product->get_permalink() : '';
                $price             = wc_price( $product->get_price() );
                $quantity          = $item->get_quantity();
                $subtotal          = wc_price( $product->get_price() * $quantity );

                // Assuming you have the $order object
                $shipping_address = $order->get_formatted_shipping_address();
                $billing_address  = $order->get_formatted_billing_address();
                $customer_email = $order->get_billing_email();

                ?>
                <div class="order-card">
                    <div class="thumb">
                        <?= $thumbnail ?>
                        <span><?= $subtotal ?></span>
                    </div>
                    <div class="infos">
                        <h3 class="title"><a href="<?= $product_permalink ?>"><?= $product_name ?></a></h3>
                        <?php if ( is_array( $selected_audios ) ) { ?>
                            <div class="audios-list">
                            <?php foreach ( $selected_audios as $audio ) { 
                                
                                ?>
                                <div class="audio">
                                    <button data-audio="<?= $audio['url'] ?>"></button>
                                    <span><?= $audio['name'] ?></span>
                                </div>
                            <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="qte">
                        <span class="title">QUANTITY</span>
                        <span class="nb"><?= $quantity ?></span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-5">
            <div class="contact-card">
                <div class="contact">
                    <p>Contact</p>
                    <a href="mailto:<?= $customer_email ?>"><?= $customer_email ?></a>
                </div>
                <div class="address">
                    <p>Delivery address</p>
                    <span>
                        <?= $billing_address ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>

<script>
    jQuery(document).ready(function($){
        var currentBtn = null;
        var currentAudio = null;
        $(document).on("click",".woocommerce-order-received .audios-list .audio button",function(e) {
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
    });
</script>

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	//wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
