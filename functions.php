<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

// Hide temporary PHP 8.1 notices (WP UPDATE 6)
add_filter( 'deprecated_constructor_trigger_error', '__return_false' );
add_filter( 'deprecated_function_trigger_error', '__return_false' );
add_filter( 'deprecated_file_trigger_error', '__return_false' );
add_filter( 'deprecated_argument_trigger_error', '__return_false' );
add_filter( 'deprecated_hook_trigger_error', '__return_false' );



//==============================================================
//=========================   Base  ============================
//==============================================================

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
	if ( ! class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
		return;
	}
	$template_id = 20578;
	$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
	$css_file->enqueue();
}, 500 );

*/


//==========================================================================
//============== Create custom WooCommerce empty cart page (pagina carrello vuoto)
//==========================================================================
/*
add_action( 'woocommerce_cart_is_empty', 'sparrow_add_content_empty_cart' );
  
function sparrow_add_content_empty_cart() {
   echo'
 	<div class="borsa" style="display: block; text-align: center; width: 100%;">
 	
 <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="61.75px" height="76px" viewBox="0 0 61.75 76" enable-background="new 0 0 61.75 76" xml:space="preserve">
<g>
	<path fill="#202020" d="M58.885,19.391H44.739v-5.119c0-7.645-6.22-13.864-13.864-13.864c-7.644,0-13.864,6.219-13.864,13.864
		v5.119H2.862L0.308,75.592h61.133L58.885,19.391z M21.009,14.272L21.009,14.272c0.001-5.439,4.426-9.864,9.865-9.864
		s9.864,4.425,9.864,9.864v5.119H21.009V14.272z M4.492,71.592l2.19-48.202h10.326v7.491c0,1.104,0.896,2,2,2s2-0.896,2-2v-7.491
		h19.729v7.491c0,1.104,0.896,2,2,2s2-0.896,2-2v-7.491h10.325l2.191,48.202H4.492z"/>
	<path fill="#202020" d="M19.01,40.368c1.104,0,2-0.896,2-2v-1.531c0-1.105-0.895-2-2-2c-1.104,0-2,0.896-2,2v1.531
		C17.01,39.472,17.906,40.368,19.01,40.368z"/>
	<path fill="#202020" d="M42.739,40.368c1.104,0,2-0.896,2-2v-1.531c0-1.105-0.896-2-2-2s-2,0.896-2,2v1.531
		C40.739,39.472,41.635,40.368,42.739,40.368z"/>
	<path fill="#202020" d="M30.875,50.726c-7.756,0-14.065,6.31-14.065,14.065c0,0.967,0.784,1.75,1.75,1.75s1.75-0.783,1.75-1.75
		c0-5.826,4.74-10.565,10.565-10.565c5.826,0,10.565,4.739,10.565,10.565c0,0.967,0.783,1.75,1.75,1.75s1.75-0.783,1.75-1.75
		C44.94,57.035,38.631,50.726,30.875,50.726z"/>
	<path fill="#202020" d="M43.084,42.463c-0.088-0.309-0.604-0.309-0.691,0c-0.005,0.017-0.477,1.666-1.39,3.036
		c-0.647,0.971-1.4,3.023-0.664,4.399c0.29,0.542,0.941,1.188,2.399,1.188s2.109-0.646,2.399-1.188
		c0.736-1.376-0.017-3.429-0.664-4.399C43.562,44.129,43.089,42.479,43.084,42.463z"/>
</g>
</svg>
			
						
						
					</div> 

 ';

}

*/

//==========================================================================
//====================== Link pulsante my account =======
//==========================================================================
/*
function tuulikki_woocommerce_get_myaccount_url() {
		return get_permalink(get_option('woocommerce_myaccount_page_id'));
	}
*/
//==========================================================================
//====================== Register our sidebars and widgetized areas. ==========================
//==========================================================================
/*
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

*/

//==========================================================================
//===========================  ACF Option page ==========================
//==========================================================================

/*

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Sale Table Settings',
        'menu_title'    => 'Sale Table',
        'parent_slug'   => 'sale-table-settings',
    ));
    
       
}
*/



//==========================================================================
//===========================   WOOCOMMERCE ================================
//==========================================================================

/**
 * Change number of products that are displayed per page (shop page)
 */
        
// Change the Number of WooCommerce Products Displayed Per Page
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_filter( 'loop_shop_per_page', 'sas_loop_shop_per_page', 20 );

function sas_loop_shop_per_page( $products ) {
    $products = 9;
    return $products;
}



/**
 * Remove Product Zoom 
 */
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

/**
 * Remove Single Product TAB ( additional_information e reviews )
 */

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    //unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;

}

/**
 * Remove additional note (Check-out page)
 */

add_filter('woocommerce_enable_order_notes_field', '__return_false');


/**
 * Remove Single Product TAB title description
 */
add_filter( 'woocommerce_product_description_heading', '__return_null' );




//===== Don't display products in the services category on the shop page. =========

function custom_pre_get_posts_query( $q ) {
    $tax_query = (array) $q->get( 'tax_query' );
    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'services', 'uncategorized', 'custom-design', 'creative-market-coupon' ), // Don't display products in the services category on the shop page.
           'operator' => 'NOT IN'
    );
    $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );


//======================================================================
//===    Remove range price woocommerce
//======================================================================
 
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) {
     $price = '';
     $price .= wc_price($product->get_price());

     return $price;
}


//======================================================================
//===    Woocommerce Change placeholder and label text
//======================================================================

add_filter( 'woocommerce_checkout_fields' , 'custom_rename_wc_checkout_fields' );

function custom_rename_wc_checkout_fields( $fields ) {
//	placeholder
//$fields['billing']['billing_first_name']['placeholder'] = 'First Name*';
//$fields['billing']['billing_last_name']['placeholder'] = 'Last Name*';
//$fields['billing']['billing_email']['placeholder'] = 'Email Address*';
//	label
$fields['billing']['billing_first_name']['label'] = '';
$fields['billing']['billing_last_name']['label'] = '';
$fields['billing']['billing_email']['label'] = '';
$fields['billing']['billing_company']['label'] = '';
$fields['billing']['billing_company']['label'] = '';
return $fields;
}




//======================================================================
//===    Woocommerce Change order MY ACCOUNT
//======================================================================
 
function wpb_woo_my_account_order() {
	$myorder = array(

		'downloads'          => __( 'Downloads', 'woocommerce' ),
		'orders'             => __( 'Recent Payments', 'woocommerce' ),
		'edit-address'       => __( ' Billing Details', 'woocommerce' ),
		//	'my-custom-endpoint' => __( 'My Stuff', 'woocommerce' ),
		//	'payment-methods'    => __( 'Payment Methods', 'woocommerce' ),
		//'dashboard'          => __( 'Dashboard', 'woocommerce' ),
		'edit-account'       => __( 'Account Settings', 'woocommerce' ),
		'customer-logout'    => __( 'Logout', 'woocommerce' ),
		//'register-product'          => __( 'Registration Product', 'woocommerce' ),
	);
	return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );


function sas_woo_account_download_columns() {
	$columns = array(
		'download-image'   => __( 'Image', 'woocommerce' ),
		'download-product'   => __( 'Product', 'woocommerce' ),
		'download-file'      => __( 'Download', 'woocommerce' ),
		'download-actions'   => '&nbsp;',
	);
	return $columns;
}
add_filter ( 'woocommerce_account_downloads_columns', 'sas_woo_account_download_columns' );

add_action( 
	'woocommerce_account_downloads_column_download-image',
	function ($download) { 
        $product = wc_get_product( $download['product_id'] );
        $product_parent = $product->get_parent_id();
        $product_images = get_field('product_images_key', $product_parent, false);
        $downloads = $product -> get_downloads();
        
		$index = 0;

        //get index
        foreach($downloads as $download_index) {
			if ($download_index->get_id() == $download['download_id']) {
				break;
			}
			$index++;
        }

        if ($product_images) {
            echo '<a href="' . esc_url( get_permalink($download['product_id']) ) . '">' .
                wp_get_attachment_image( $product_images[$index]["product_image_key"], 'medium') .
            '</a>';
        } else {
            echo '<a href="' . esc_url( get_permalink($download['product_id']) ) . '">' .
                wp_get_attachment_image( get_post_thumbnail_id($download['product_id']), 'medium') .
            '</a>';
        }
        

	}
	, 10, 1 
);


//======  Logout Without Confirmation =====
function iconic_bypass_logout_confirmation() {
    global $wp;
    if ( isset( $wp->query_vars['customer-logout'] ) ) {
        wp_redirect( str_replace( '&amp;', '&', wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) );
        exit;
    }
}

add_action( 'template_redirect', 'iconic_bypass_logout_confirmation' );





//======================================================================
//===    Redirect
//======================================================================
 
//====== Login Redirect  =====
add_filter('woocommerce_login_redirect', 'pro_login_redirect');
function pro_login_redirect( $redirect_to ) {
	//$redirect_to = home_url();
	$redirect_to = get_permalink( 559 );

return $redirect_to;
}

//====== Registration Redirect  =====
function custom_registration_redirect_after_registration() {
    return get_permalink( 562 );
}
add_action('woocommerce_registration_redirect', 'custom_registration_redirect_after_registration', 2);


//======================================================================
//===    invoice for company
//======================================================================
 
add_filter( 'wpo_wcpdf_custom_attachment_condition', 'wpo_wcpdf_invoice_attachment_condition', 100, 4 );
function wpo_wcpdf_invoice_attachment_condition( $condition, $order, $status, $template_type ) {
    // only apply condition to invoices
    if ($template_type == 'invoice') {
        $valid_eu_vat_number = $order->get_meta( 'Valid EU VAT Number' );
        $vat_number_validated = $order->get_meta( 'VAT number validated' );
        $vat_number = $order->get_meta( 'VAT Number' );

        // if no vat number, don't attach
        if (empty($vat_number)) {
            $condition = false;
        }
    }

    return $condition;
}

//======================================================================
//===    Sovrascrivere lo style delle mail 
//======================================================================
 

add_action('woocommerce_email_header', 'add_css_to_email');

function add_css_to_email() {
echo '
<style type="text/css">

#header_wrapper {
    padding: 36px 48px 5px;
    }
#header_wrapper h1 {
	text-align: center;
	}
th, td, address.address {
	font-size: 14px;
}
#template_container {
	box-shadow: none !important;
    border: none;
}
p a,
p a.link {
	color: #000;
	font-weight: normal;
	text-decoration: underline;
}
td#credit {
	color: #000 !important;
}
td a, td h2 {
	color: #000;
	font-weight: bold;
	text-decoration: none !important;
}
td h2 {
	color: #464646;
}
#body_content_inner blockquote {
	background: #f1f1f1;
    padding: 20px;
    margin: 0px 0px 20px 0px;
}
#body_content_inner h2 a{
	color: #000;
}
#template_header_image p img {
	width: 150px;
}
</style>
';
}

//======================================================================
//===    Change numero di post nella pagina shop 
//======================================================================


//====== Change add "“Freyja” has been added to your cart"  wc_add_to_cart_message_html =====

/*
add_filter ( 'wc_add_to_cart_message', 'wc_add_to_cart_message_filter', 10, 2 );
function wc_add_to_cart_message_filter($message, $product_id = null) {
    $titles[] = get_the_title( $product_id );

    $titles = array_filter( $titles );
    $added_text = sprintf( _n( '%s', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

    $message = sprintf( '%s has been added to your <a href="https://sparrowandsnow.com/cart/"><b>cart</b></a>.',
                    esc_html( $added_text ),
                    esc_url( wc_get_page_permalink( 'checkout' ) ),
                    esc_html__( 'Checkout', 'woocommerce' ),
                    esc_url( wc_get_page_permalink( 'cart' ) ),
                    esc_html__( 'View Cart', 'woocommerce' ));

    return $message;
}
*/


//======================================================================
//===    Product key per for woocommerce  
//======================================================================
 

 /* 
function action_wpcf7_posted_data($array) {
	$array["product-key"] = "";
	$array["data_scadenza"] = "";

	$url = "https://sparrowandsnow.com/api2/contact-insert?name=".urlencode($array["your-name"])."&email=".urlencode($array["your-email"])."&theme=".urlencode($array["menu-428"])."&domain=".urlencode($array["domain_name"])."&nn=".time();

	$objurl = wp_remote_get($url);

	if (isset($objurl["body"])) {
		$cache = $objurl["body"];
		if ($cache) {
			$data = json_decode($cache, true);
			if (isset($data["purchase_code"])) {
				$array["product-key"] = $data["purchase_code"];
				$array["data_scadenza"] = $data["data_scadenza"];
				$array["data_creazione"] = $data["data_creazione"];
			}
		}
	}

    return $array;
};
add_filter("wpcf7_posted_data", "action_wpcf7_posted_data", 10, 1 );

*/

//======================================================================
//===    HIDE PHURCASE CODE   
//======================================================================
 
/*
function force_type_private($post)
{
    if ($post['post_type'] == 'purchasecodes')
    $post['post_status'] = 'private';
    return $post;
}
add_filter('wp_insert_post_data', 'force_type_private');

*/


//======================================================================
//===    ADD 5% in paypal  
//======================================================================

// Part 1: assign fee
add_action( 'woocommerce_cart_calculate_fees', 'bbloomer_add_checkout_fee_for_gateway' );
  
function bbloomer_add_checkout_fee_for_gateway() {
   
  global $woocommerce;
  $chosen_gateway = $woocommerce->session->chosen_payment_method;
  
  if ( $chosen_gateway == 'ppcp-gateway' ) {
    $percentage = 0.05;
    $surcharge = ( $woocommerce->cart->cart_contents_total + $woocommerce->cart->shipping_total ) * $percentage;    
  $woocommerce->cart->add_fee( 'PayPal Fee', $surcharge, true, '');
  }
   
}
 
// Part 2: reload checkout on payment gateway change
add_action( 'woocommerce_review_order_before_payment', 'bbloomer_refresh_checkout_on_payment_methods_change' );
 
function bbloomer_refresh_checkout_on_payment_methods_change(){
    ?>
    <script type="text/javascript">
        (function($){
            $( 'form.checkout' ).on( 'change', 'input[name^="payment_method"]', function() {
                $('body').trigger('update_checkout');
            });
        })(jQuery);
    </script>
    <?php
}

// Part 3: Default payment
add_action( 'woocommerce_before_checkout_form', 'action_before_checkout_form' );

function action_before_checkout_form(){
    $default_payment_gateway_id = 'stripe';
    WC()->session->set('chosen_payment_method', $default_payment_gateway_id);
}



//======================================================================
//===    Move & Change Number of Cross-Sells @ WooCommerce Cart   ======
//======================================================================
 
// ---------------------------------------------
// Remove Cross Sells From Default Position 
 
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
 
 
// ---------------------------------------------
// Add them back UNDER the Cart Table
 
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );
 
 
// ---------------------------------------------
// Display Cross Sells on 3 columns instead of default 4
 
add_filter( 'woocommerce_cross_sells_columns', 'indie_change_cross_sells_columns' );
 
function indie_change_cross_sells_columns( $columns ) {
return 3;
}
 
// ---------------------------------------------
// Display Only 3 Cross Sells instead of default 4
 
add_filter( 'woocommerce_cross_sells_total', 'indie_change_cross_sells_product_no' );
  
function indie_change_cross_sells_product_no( $columns ) {
return 3;
}

add_image_size('sparrow_carousel', 600, 400);


//======================================================================
//LOAD MORE PRODUCTS  ======
//======================================================================

function load_more_products() {
    global $wp_query;

    $page = $_POST['page'];
    $posts_per_page = $_POST['posts_per_page'];
    $category = $_POST['category'];
    $tag = $_POST['tag'];

    $tax_query = array(
        array(
            'taxonomy'  => 'product_visibility',
            'terms'     => array( 'exclude-from-catalog' ),
            'field'     => 'name',
            'operator'  => 'NOT IN'
        )
    );

    if ($category) {
        $tax_query['relation'] = 'AND';
        array_push($tax_query, array(
            'taxonomy'  => 'product_cat',
            'field'     => 'slug',
            'terms'     => $category,
            'operator'  => 'IN'
        ));
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
        'tax_query' => array(
            $tax_query
        )
    );

    if ($tag) {
        $args['product_tag'] = $tag;
    }


    $query = new WP_Query($args);

    $response["data"] = '';
    $response["max_num_pages"] = $query->max_num_pages;


    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ob_start();
            wc_get_template_part( 'content', 'product' );
            $response["data"] .= ob_get_clean();
        }
        wp_reset_postdata();
    }

    echo json_encode($response);
    die();
}

add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');





// ajax function
add_action('wp_ajax_sparrow_category_data_fetch' , 'sparrow_category_data_fetch');
add_action('wp_ajax_nopriv_sparrow_category_data_fetch','sparrow_category_data_fetch');

function sparrow_category_data_fetch() {
    
    if ($_POST['pcat']) {
        $product_cat_id = array(esc_attr( $_POST['pcat'] ));
    }else {
        $terms = get_terms( 'product_cat' ); 
        $product_cat_id = wp_list_pluck( $terms, 'term_id' );
    }

    $the_query = new WP_Query( 
        array( 
            'posts_per_page' => 9,
            'post_type' => array('product'),
            'post_status'=> 'publish',
            
            'tax_query' => array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'term_id',
                    'terms'     => $product_cat_id,
                    'operator'  => 'IN',
                )
            )
        ) 
    );

    $response["data"] = '';

    $response["max_num_pages"] = $the_query->max_num_pages;

    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post();
            ob_start();
            wc_get_template_part( 'content', 'product' );
            $response["data"] .= ob_get_clean();
        endwhile;
        wp_reset_postdata();
    endif;

    echo json_encode($response);
    die();
}

add_action('wp_ajax_sparrow_tag_data_fetch' , 'sparrow_tag_data_fetch');
add_action('wp_ajax_nopriv_sparrow_tag_data_fetch','sparrow_tag_data_fetch');

function sparrow_tag_data_fetch() {

    $product_tag_id = $_POST['ptag'] ? array(esc_attr( $_POST['ptag'] )) : false;
    $the_query = new WP_Query( 
        array( 
            'posts_per_page' => 9,
            'post_type' => 'product',
            'post_status'=> 'publish',
            'product_tag' => $product_tag_id,
        ) 
    );

    $response["data"] = '';

    $response["max_num_pages"] = $the_query->max_num_pages;

    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post();
            ob_start();
            wc_get_template_part( 'content', 'product' );
            $response["data"] .= ob_get_clean();
        
        endwhile;
        wp_reset_postdata();  
    endif;

    echo json_encode($response);
    die();
}

add_action("woocommerce_before_shop_loop", "print_shop_categories_wrapper", 10, 1);

function print_shop_categories_wrapper() {
    echo '<div class="sparrow-product-wrapper">';
        echo '<button class="sparrow-product-filter-btn">';
        
        echo '  <svg class="filter_icon" viewBox="0 0 53 30" width="30" height="27"><defs><style>.cls-2{fill:none;stroke:#fff;}.cls-2,.cls-2{stroke-width:3px;}.cls-2{fill:#445acb;stroke:#f5f4f1;}</style></defs><line class="cls-2" x1="53" y1="6.5" y2="6.5"/><line class="cls-2" x1="53" y1="23.5" y2="23.5"/><circle class="cls-2" cx="13" cy="6" r="4.5"/><circle class="cls-2" cx="38" cy="24" r="4.5"/></svg>';

        echo ' Filters</button>';
        echo '<div class="sparrow-product-filter-container">';
            print_shop_categories();
        echo '</div>';
}  

function print_shop_categories($mobile = false) { ?>
            
    <?php
        /** 
         * 
         * 
         * ID CATEGORIE DA NASCONDERE (sotto)
         * 
         * 
        */

        $cat_args = array(
            'orderby'      => 'name',
            'order'        => 'ASC',
            'parent'       => 0,
            'taxonomy'     => 'category',
            'exclude'      => array( 660, 43, 210 ) //ID CATEGORIE NASCOSTE
        );
        
        // CATEGORIES
        $product_categories = get_terms( 'product_cat', $cat_args );
        $current_term = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : 0;

        if( !empty($product_categories) ){
            echo '<h3>Categories</h3>';
            echo "<ul class='sparrow-product-categories'>";
                $classes = "sparrow-category";
                if ($current_term === 0) {
                    $classes .= " active";
                }
                echo "<li class='{$classes}' id='0' data-catname=''  
                    data-cursor-hover='true' 
                    data-cursor-hover-background='rgba(105,102,255,0,678)'
                    >";
                if ($mobile) {
                    $shop_url = get_permalink( wc_get_page_id( 'shop' ) );
                    echo "<a href='$shop_url'>All</a>";
                } else {
                    echo "All";
                }
                echo '</li>';
                foreach ($product_categories as $key => $category) {
                    $children = get_term_children($category->term_id, 'product_cat');
                    $classes = "sparrow-category";

                    if ($current_term == $category->term_id) {
                        $classes .= " active";
                    }

                    if ($children) { 
                        $classes .= " has-children";
                    }

                    echo "<li class='{$classes}' id='{$category->term_id}' data-catname='$category->slug' 
                        data-cursor-hover='true' 
                        data-cursor-hover-background='rgba(105,102,255,0,678)'
                        >";
                    if ($mobile) {
                        $cat_url = get_term_link($category->term_id, 'product_cat');
                        echo "<a href='$cat_url'>$category->name</a>";
                    } else {
                        echo $category->name;
                    }
                    echo '</li>';

                    $children = get_term_children($category->term_id, 'product_cat');
                    if ($children) {
                        echo '<ul class="sparrow-product-categories sparrow-product-categories-children">';
                        foreach($children as $child) {
                            $child_term = get_term_by('term_id', $child, 'product_cat');
                            echo "<li class='sparrow-category sparrow-category-child' id='{$child_term->term_id}' data-catname='$child_term->slug' 
                                data-cursor-hover='true' 
                                data-cursor-hover-background='rgba(105,102,255,0,678)'
                                >";
                            if ($mobile) {
                                $cat_url = get_term_link($child_term->term_id, 'product_cat');
                                echo "<a href='$cat_url'>$child_term->name</a>";
                            } else {
                                echo $child_term->name;
                            }
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                }
            echo '</ul>';
        }

        // TAGS
        $product_tags = get_terms( 'product_tag' );
        if( !empty($product_tags) ){
            echo '<h3 class="filter_tag_style">Style</h3>';
            echo '<ul class="sparrow-product-tags">';
                $classes = "sparrow-tag";
                foreach ($product_tags as $product_tag) {
                    $check_shop_page = isset(get_term_meta($product_tag->term_id)['shop_page'][0]) ? get_term_meta($product_tag->term_id)['shop_page'][0] : false;
                    if ($check_shop_page) {
                        $classes = "sparrow-tag";

                        if ($current_term == $product_tag->term_id) {
                            $classes .= " active";
                        }    

                        echo "<li class='{$classes}' id='{$product_tag->slug}' 
                            data-cursor-hover='true' 
                            data-cursor-hover-background='rgba(105,102,255,0,678)'
                            >";
                        if ($mobile) {
                            $cat_url = get_term_link($product_tag->slug, 'product_tag');
                            echo "<a href='$cat_url'>$product_tag->name</a>";
                        } else {
                            echo $product_tag->name;
                        }
                        echo '</li>';
                    }
                }
            echo '</ul>';
        }?>
<?php
}

add_action("woocommerce_after_shop_loop", function() {
    global $wp_query; 
    $disabled = true;
    if ($wp_query->max_num_pages > 1) {
        $disabled = false;
    }

    ?> 
        <div></div>
        <div class="loadmore-trigger" data-disabled="<?php echo $disabled ?>">
            <p>Scroll down to load more products</p>
        </div>

    </div> <!-- END sparrow-product-wrapper -->
    <?php
});


/** 
 * 
 * 
 * LOOP PRODOTTO PREZZO - CATEGORIA
 * 
 * 
*/

add_action("woocommerce_after_shop_loop_item_title", function() {
        $product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */

        $terms = get_the_terms( get_the_ID(), 'product_cat' ) ? get_the_terms( get_the_ID(), 'product_cat' ) : get_the_terms( $product->get_parent_id(), 'product_cat' );
        $product_price = $product->get_price_html();
        $product_cat_id = "";
        if($terms) {
            foreach ($terms as $term) {
                if($product_cat_id == "") {
                    $product_cat_id .= $term->name;
                } else {
                    $product_cat_id .= ', ' . $term->name;
                }   
            }
        }

        if ($product->get_price() == 0) {
        ?>
            <p class="ajax_shop_price">free</p>
        <?php 
        } else { 
        ?>
            <p class="ajax_shop_price">from <?php echo $product_price; //PREZZO?></p>
        <?php 
        }
        ?>

        <p class="ajax_shop_cat"><?php echo $product_cat_id; //CATEGORIA?></p>
        </div>

    <?php
});


// Due immagini woocommerce archive
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', function() {

        global $product;

        // SALE, BUNDLE, NEW, FREE label
        $label = get_field('labels');
        if ($label) {
	        echo "<p class='p__anim'>";
            echo "<span class='shop__badge style__".strtolower($label)."'>$label! </span>";
	        echo "</p>";
        }

        $img_1 = get_field('preview_gif_image_1');
        $img_2 = get_field('preview_gif_image_2');
        $gif = get_field('gif');

        if ($gif == 'on') {
            echo '<div class="product_acf_gif_img_animation">';
            echo "	<div class='product_acf_gif_img_animation-inner'>" . wp_get_attachment_image($img_2, 'full') . "</div>";
            echo "	<div class='product_acf_gif_img_animation-inner'>" . wp_get_attachment_image($img_1, 'full') . "</div>";
            echo '</div>';
        } else {
            echo '<div class="product_acf_gif_img">';
            echo "	<div class='product_acf_gif_img-inner'>" . wp_get_attachment_image($img_2, 'full') . "</div>";
            echo "	<div class='product_acf_gif_img-inner'>" . wp_get_attachment_image($img_1, 'full') . "</div>";
            echo '</div>';
        }
		
		echo '<div class="product_flex">';


});




/**
 * Change WooCommerce Add to cart message with cart link.
 */
function quadlayers_add_to_cart_message_html( $message, $products ) {

$count = 0;
$titles = array();
foreach ( $products as $product_id => $qty ) {
$titles[] = ( $qty > 1 ? absint( $qty ) . ' &times; ' : '' ) . sprintf( _x( '&ldquo;%s&rdquo;', 'Item name in quotes', 'woocommerce' ), strip_tags( get_the_title( $product_id ) ) );
$count += $qty;
}

$titles     = array_filter( $titles );
$added_text = sprintf( _n(
'%s has been added to your cart. Thank you for shopping!', // Singular
'%s have been added to your cart. Thank you for shopping!', // Plural
$count, // Number of products added
'woocommerce' // Textdomain
), wc_format_list_of_items( $titles ) );
$message    = sprintf( '<div style="background: red; width: 0px; height:0px;"></div><a href="%s" class="button wc-forward">%s</a> %s', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View cart', 'woocommerce' ), esc_html( $added_text ) );

return $message;
}
add_filter( 'wc_add_to_cart_message_html', 'quadlayers_add_to_cart_message_html', 10, 2 );


//DA RIMUOVERE
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );