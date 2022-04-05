<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$opt_price_type        = ! empty( $option['price_type'] ) ? $option['price_type'] : 'flat_fee';
$opt_display_image     = ( ! empty( $addon['display'] ) && 'images' === $addon['display'] ) ? 'show' : 'hide';
$opt_label_column      = ( ! empty( $addon['display'] ) && 'images' === $addon['display'] ) ? '' : 'full';
$opt_image             = ! empty( $option['image'] ) ? $option['image'] : '';
$opt_show_image_swatch = ! empty( $opt_image ) ? 'show' : 'hide';
$opt_show_add_image    = ! empty( $opt_image ) ? 'hide' : 'show';
$opt_label             = ( '0' === $option['label'] ) || ! empty( $option['label'] ) ? $option['label'] : '';
$opt_price             = ! empty( $option['price'] ) ? $option['price'] : '';
$opt_image_thumb       = '<img />';
$opt_decimal_separator = wc_get_price_decimal_separator();

if ( 'show' === $opt_show_image_swatch ) {
	$opt_image_thumb = wp_get_attachment_image_src( $opt_image, 'thumbnail' );
	if ( $opt_image_thumb ) {
		$opt_image_thumb = '<img src="' . esc_url( $opt_image_thumb[0] ) . '" />';
	} else {
		$opt_image_thumb = wc_placeholder_img();
	}
}
?>
<div class="wc-pao-addon-option-row">
	<span class="wc-pao-addon-sort-handle dashicons dashicons-menu"></span>
	<div class="wc-pao-addon-content-image <?php esc_attr_e( $opt_display_image ); ?>">
		<span class="dashicons dashicons-format-image wc-pao-addon-add-image <?php esc_attr_e( $opt_show_add_image ); ?>">
			<input type="hidden" name="product_addon_option_image[<?php echo $loop; ?>][]" value="<?php esc_attr_e( $opt_image ); ?>" class="wc-pao-addon-option-image-id" />
		</span>
		<span class="dashicons dashicons-plus <?php esc_attr_e( $opt_show_add_image ); ?>"></span>
		<a href="#" class="wc-pao-addon-image-swatch <?php esc_attr_e( $opt_show_image_swatch ); ?>"><?php echo $opt_image_thumb; ?><span class="dashicons dashicons-dismiss"></span></a>
	</div>

	<div class="wc-pao-addon-content-label <?php esc_attr_e( $opt_label_column ); ?>">
		<input type="text" name="product_addon_option_label[<?php echo $loop; ?>][]" value="<?php esc_attr_e( $opt_label ); ?>" placeholder="<?php esc_html_e( 'Enter an option', 'woocommerce-appointments' ); ?>" />
	</div>

	<div class="wc-pao-addon-content-price-type">
		<select name="product_addon_option_price_type[<?php echo $loop; ?>][]" class="wc-pao-addon-option-price-type">
			<option <?php selected( 'flat_fee', $opt_price_type ); ?> value="flat_fee"><?php esc_html_e( 'Flat Fee', 'woocommerce-appointments' ); ?></option>
			<option <?php selected( 'quantity_based', $opt_price_type ); ?> value="quantity_based"><?php esc_html_e( 'Quantity Based', 'woocommerce-appointments' ); ?></option>
			<option <?php selected( 'percentage_based', $opt_price_type ); ?> value="percentage_based" class="disabled_if_appointment"><?php esc_html_e( 'Percentage Based', 'woocommerce-appointments' ); ?></option>
		</select>
	</div>

	<div class="wc-pao-addon-content-price">
		<input type="text" name="product_addon_option_price[<?php echo $loop; ?>][]" value="<?php esc_attr_e( wc_format_localized_price( $opt_price ) ); ?>" placeholder="0<?php esc_attr_e( $opt_decimal_separator ); ?>00" class="wc_input_price" />
	</div>

	<?php do_action( 'woocommerce_product_addons_panel_option_row', isset( $post ) ? $post : null, $product_addons, $loop, $option ); ?>

	<div class="wc-pao-addon-content-remove">
		<button type="button" class="wc-pao-remove-option button">x</button>
	</div>
</div>
