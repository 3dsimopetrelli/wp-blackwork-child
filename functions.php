<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

//require_once(get_template_directory() . '/framework/php/library.php');
//require_once(get_template_directory() . '/framework/php/post-type.php');
require get_theme_file_path( 'php/acf.php' );

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
        wp_enqueue_style(
                'hello-elementor-child-style',
                get_stylesheet_directory_uri() . '/style.css',
                [
                        'hello-elementor-theme-style',
                ],
                '1.0.0'
        );

   // wp_enqueue_script('cursor-js', get_stylesheet_directory_uri() . '/assets/js/sparrow-cursor.js', ['jquery'], '1.0.0');
    //wp_enqueue_script('smooth-js', get_stylesheet_directory_uri() . '/assets/js/sparrow-smooth-scroll.js', [], '1.0.0');

   // wp_enqueue_script('lazy-js', get_stylesheet_directory_uri() . '/assets/js/sparrow-lazy-load.js', [], '1.0.0');

/*

    wp_register_script( 'sparrow-ajax-categories', get_stylesheet_directory_uri(  ) . "/assets/js/sparrow-ajax-categories.js", ['jquery', 'lazy-js'] );
        wp_localize_script( 'sparrow-ajax-categories', 'ajax_categories', [
                'ajaxurl' => admin_url( "admin-ajax.php" )
        ] );
        wp_enqueue_script( 'sparrow-ajax-categories' );

    wp_register_script( 'sparrow-products-loadmore', get_stylesheet_directory_uri(  ) . "/assets/js/sparrow-products-loadmore.js", ['jquery'] );
        wp_localize_script( 'sparrow-products-loadmore', 'ajax_loadmore', [
                'ajaxurl' => admin_url( "admin-ajax.php" )
        ] );
        wp_enqueue_script( 'sparrow-products-loadmore' );

*/

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts' );

// Reorder parent css
function sparrow_reorder_child_css() {
        wp_enqueue_style( "child-style", get_template_directory_uri()."/style.css");
        //wp_enqueue_style( "font-awesome", get_template_directory_uri()."/fonts/font-awesome/font-awesome.min.css");
        //wp_enqueue_style( "cursor-style", get_stylesheet_directory_uri()."/assets/css/cursor.css");
}

add_action( "wp_enqueue_scripts", "sparrow_reorder_child_css", 11);

//==========================================================================
//====================== SVG permessi
//==========================================================================

// SVG Support - Metodo più diretto
function allow_svg_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_mime_types');

function custom_upload_check($file) {
    if ($file['name']) {
        $filetype = wp_check_filetype_and_ext($file['tmp_name'], $file['name']);
        if ($filetype['ext'] === 'svg') {
            $file['type'] = 'image/svg+xml';
        }
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'custom_upload_check');

//==========================================================================
//====================== Eliminare glich load Elementor
//==========================================================================

/*

add_action( 'wp_enqueue_scripts', function() {
        if ( ! class_exists( '\\Elementor\\Core\\Files\\CSS\\Post' ) ) {
                return;
        }
        $template_id = 20578;
        $css_file = new \\Elementor\\Core\\Files\\CSS\\Post( $template_id );
        $css_file->enqueue();
}, 500 );

*/

// Remove output buffer flushing added by some configurations.
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
