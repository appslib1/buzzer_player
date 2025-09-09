<?php
/**
 * Stripe Calculation Tracker.
 *
 * @package Stripe\StripeTaxForWooCommerce\Stripe
 */

namespace Stripe\StripeTaxForWooCommerce\Stripe;

// Exit if script started not from WordPress.
defined( 'ABSPATH' ) || exit;

use WP_Post;

/**
 * Stripe Calculation Tracker service
 */
class StripeCalculationTracker {
	/**
	 * Should calculate variable
	 *
	 * @var bool
	 */
	private static $should_calculate = false;

	/**
	 * Subscribe to hooks
	 *
	 * @return void
	 */
	public static function init(): void {
		add_action(
			'rest_dispatch_request',
			function ( $_, $request ) {
				$requests = $request->get_param( 'requests' );
				if ( ! empty( $requests ) ) {
					$data = reset( $requests );
					if ( array_key_exists( 'path', $data ) && str_contains( $data['path'], 'cart' ) ) {
						self::$should_calculate = true;
					}
				}
			},
			10,
			2
		);

		add_action(
			'admin_init',
			function () {
				$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ) : '';
				wp_verify_nonce( $nonce );

				if ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && 'woocommerce_calc_line_taxes' === $_REQUEST['action'] ) {
					self::$should_calculate = true;
				}
			}
		);
	}

	/**
	 * Check if a calculation is needed.
	 *
	 * @return bool
	 */
	public static function is_calculation_needed(): bool {
		try {
			if ( apply_filters( 'stripe_tax_skip_calculation', false ) ) {
				return false;
			}

			if ( self::$should_calculate || is_cart() || is_checkout() ) {
				return true;
			}

			if (
				defined( 'REST_REQUEST' ) && REST_REQUEST &&
				isset( $_SERVER['REQUEST_URI'] ) &&
				(
					str_contains( sanitize_url( wp_unslash( $_SERVER['REQUEST_URI'] ) ), '/wp-json/wc/store/v1/checkout' ) ||
					str_contains( sanitize_url( wp_unslash( $_SERVER['REQUEST_URI'] ) ), '/wp-json/wc/store/v1/cart' )
				)
			) {
				return true;
			}

			$cart_page_id     = wc_get_page_id( 'cart' );
			$checkout_page_id = wc_get_page_id( 'checkout' );
			if ( get_queried_object_id() === $cart_page_id || get_queried_object_id() === $checkout_page_id ) {
				return true;
			}

			if ( isset( $_SERVER['REQUEST_URI'] ) ) {
				$request   = wp_parse_url( sanitize_url( wp_unslash( $_SERVER['REQUEST_URI'] ) ), PHP_URL_PATH );
				$cart_url  = get_permalink( $cart_page_id );
				$cart_path = wp_parse_url( $cart_url, PHP_URL_PATH );
				if ( $cart_path && str_contains( $request, $cart_path ) ) {
					return true;
				}

				$checkout_url  = get_permalink( $checkout_page_id );
				$checkout_path = wp_parse_url( $checkout_url, PHP_URL_PATH );
				if ( $checkout_path && str_contains( $request, $checkout_path ) ) {
					return true;
				}
			}

			$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ) : '';
			wp_verify_nonce( $nonce );

			if ( isset( $_POST['woocommerce-cart-nonce'] ) || isset( $_POST['woocommerce-process-checkout-nonce'] ) ) {
				return true;
			}

			global $post;
			if ( $post instanceof WP_Post ) {
				if (
					has_shortcode( $post->post_content, 'woocommerce_cart' ) ||
					has_shortcode( $post->post_content, 'woocommerce_checkout' ) ||
					str_contains( $post->post_content, 'wp:woocommerce/cart' ) ||
					str_contains( $post->post_content, 'wp:woocommerce/checkout' )
				) {
					return true;
				}
			}

			return static::is_cart_ajax_context() || static::is_checkout_ajax_context() || static::is_order_received_page();
		} catch ( \Throwable $e ) {
			// TODO: add logger after issue #41 is done.
			return false;
		}
	}

	/**
	 * Check if calculation is needed in cart ajax context
	 *
	 * @return bool
	 */
	private static function is_cart_ajax_context(): bool {
		$cart_ajax_actions = array(
			'update_cart',
			'apply_coupon',
			'remove_coupon',
			'get_cart_totals',
			'get_refreshed_fragments',
			'update_shipping_method',
			'checkout_coupon',
		);

		$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ) : '';
		wp_verify_nonce( $nonce );

		return defined( 'DOING_AJAX' ) && DOING_AJAX &&
			isset( $_GET['wc-ajax'] ) &&
			in_array( sanitize_text_field( $_GET['wc-ajax'] ), $cart_ajax_actions, true );
	}

	/**
	 * Check if calculation is needed in checkout ajax context
	 *
	 * @return bool
	 */
	private static function is_checkout_ajax_context(): bool {
		$checkout_ajax_actions = array(
			'update_order_review',
			'checkout',
			'apply_coupon',
			'remove_coupon',
			'get_refreshed_fragments',
			'update_shipping_method',
			'checkout_coupon',
		);

		$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ) : '';
		wp_verify_nonce( $nonce );

		return defined( 'DOING_AJAX' ) && DOING_AJAX &&
			isset( $_GET['wc-ajax'] ) &&
			in_array( sanitize_text_field( $_GET['wc-ajax'] ), $checkout_ajax_actions, true );
	}

	/**
	 * Check if calculation is needed after clicking place order
	 *
	 * @return bool
	 */
	private static function is_order_received_page(): bool {
		$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ) : '';
		wp_verify_nonce( $nonce );

		return is_page( wc_get_page_id( 'checkout' ) ) &&
			isset( $_GET['key'] ) &&
			isset( $_GET['order-received'] );
	}
}
