<?php
//catalog mode ------------------------------------------------------------------------------- 
add_action( 'init', 'catalog_mode', 10 );
function catalog_mode() {
	remove_action( 'woocommerce_after_shop_loop_item'  , 'woocommerce_template_loop_add_to_cart'          , 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart'        , 30 );
	remove_action( 'woocommerce_simple_add_to_cart'    , 'woocommerce_simple_add_to_cart'                 , 30 );
	remove_action( 'woocommerce_grouped_add_to_cart'   , 'woocommerce_grouped_add_to_cart'                , 30 );
	remove_action( 'woocommerce_variable_add_to_cart'  , 'woocommerce_variable_add_to_cart'               , 30 );
	remove_action( 'woocommerce_external_add_to_cart'  , 'woocommerce_external_add_to_cart'               , 30 );
	remove_action( 'woocommerce_single_variation'      , 'woocommerce_single_variation'                   , 10 );
	remove_action( 'woocommerce_single_variation'      , 'woocommerce_single_variation_add_to_cart_button', 20 );
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

// Change number of products that are displayed per page (shop page) ------------------------------------------------------------------------------- 
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  $cols = 8;
  return $cols;
}
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; 
	}
}

// remove woocommerce pagination dependency ------------------------------------------------------------------------------- 
function my_customize_register() {     
  global $wp_customize;
  $wp_customize->remove_panel( 'woocommerce' );
  $wp_customize->remove_section( 'background_image' );
  $wp_customize->remove_section( 'themes' ); 
  $wp_customize->remove_section( 'header_image');
  } 
  add_action( 'customize_register', 'my_customize_register', 11 );

// Remove woocommerce default styles ------------------------------------------------------------------------------- 
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	//	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}
// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// remove actions---------------------------------------------------------------------------
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5); 
add_action('woocommerce_new_title', 'woocommerce_template_single_title', 60);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {return '';}
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );

//hide attr
function remove_attribute( $attributes ) {
  if( is_product() ){
      if( isset( $attributes['pa_gorod'] ) ){
          unset( $attributes['pa_gorod'] );
      }
  }
  return $attributes;
}
add_filter( 'woocommerce_product_get_attributes', 'remove_attribute' );


