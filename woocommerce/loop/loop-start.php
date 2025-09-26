<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (is_product_category()) {
    $category_name = sanitize_title(single_cat_title('', false)); // Get the queried category name
}

if (is_product_tag()) {
    $tag_name = sanitize_title(single_tag_title('', false)); // Get the queried category name
}


?>
<ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>" data-category="<?php echo isset($category_name) ? $category_name : '' ?>" data-tag="<?php echo isset($tag_name) ? $tag_name : '' ?>">
