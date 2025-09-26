<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php $viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' ); ?>
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="circularcursor"></div>

<?php hello_elementor_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content">
	<?php esc_html_e( 'Skip to content', 'hello-elementor' ); ?></a>

<?php
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
		get_template_part( 'template-parts/dynamic-header' );
	} else {
		get_template_part( 'template-parts/header' );
	}
}

if (class_exists("woocommerce")) {
	if (is_shop() || is_product_category() || is_product_tag()) {
		echo "<div class='sparrow-product-filter-container-overlay'>";
			echo "<div class='sparrow-product-filter-container-overlay-bar'>";
				echo '<h2>Filters</h2>';
				
				
			echo '<button class="sparrow-product-filter-btn-close close-filter-popup">';
			
			
			echo '<svg class="close-icon" viewBox="0 0 52.83 54" width="30" height="30">
						<defs><style>.cls-1{fill:none;stroke:#000;stroke-width:4px;}</style></defs>
						<line class="cls-1" x1="1.41" y1="2.59" x2="51.41" y2="52.59"/>
						<line class="cls-1" x1="51.41" y1="1.41" x2="1.41" y2="51.41"/>
					</svg>';
			echo '</button>';
			echo '</div>';
			print_shop_categories(true);
		echo "</div>";	
	}
}