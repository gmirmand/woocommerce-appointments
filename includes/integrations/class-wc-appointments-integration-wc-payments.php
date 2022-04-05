<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce Payments integration class.
 *
 * Last compatibility check: 3.0.0
 */
class WC_Appointments_Integration_WC_Payments {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'wcpay_payment_request_supported_types', [ $this, 'appointments_add_to_supported_types' ] );
		add_filter( 'woocommerce_product_addons_option_price_raw', [ $this, 'change_price' ] );
	}

	/**
	 * Add 'appointment' product type to the array.
	 *
	 * @param array $product_types Supported product types.
	 *
	 * @return array Supported product types.
	 */
	public function appointments_add_to_supported_types( $product_types ) {
		$product_types[] = 'appointment';

		return $product_types;
	}

	/**
	 * Convert the add-on price with multi-currency.
	 *
	 * @param array $price_raw raw price for the add-on.
	 *
	 * @return string Price.
	 */
	public function change_price( $price_raw ) {
		if ( ! $price_raw ) {
			return $price_raw;
		}

		if ( ! class_exists( 'WC_Payments_Multi_Currency' ) ) {
			return $price_raw;
		}

		return WC_Payments_Multi_Currency()->get_price( $price_raw, 'product' );
	}

}

new WC_Appointments_Integration_WC_Payments();
