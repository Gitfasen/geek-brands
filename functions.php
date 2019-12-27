<?php
/**
 *
 * @package lptheme
 * @since 1.0
 */

/**
 * Setting constant to inform the plugin that theme is activated
 */
define ('LPTHEME_THEME_ACTIVATED' , true);
add_filter('show_admin_bar', '__return_false');

require get_template_directory() . '/framework/init.php';
require get_template_directory() . '/framework/config.php';


// Дополнительные функции

add_filter('get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

add_action('init', function() {
  add_rewrite_rule('(.?.+?)/page/?([0-9]{1,})/?$', 'index.php?pagename=$matches[1]&paged=$matches[2]', 'top');
});

function get_max_price_apartments() {

	$post_args = array(
		'posts_per_page' => -1,
		'post_type'      => 'kvartira',
		'post_status'    => 'publish'
	);
	$query = new WP_Query( $post_args );
	$price = [];

	if($query -> have_posts()): while ($query -> have_posts()) : $query -> the_post(); 

		$m2 = get_field('apart_m2') ? get_field('apart_m2') : 0;

		if (get_field('apart_price')) {
			$price[] = get_field('apart_price') * $m2;
		}elseif (get_field('gk-price', get_field('apart_gk'))) {
			$price[] = get_field('gk-price', get_field('apart_gk')) * $m2;
		}else {
			continue;
		}

	endwhile; wp_reset_postdata(); else: 
		return;
	endif;

	return max($price);

}


function get_gk() {

	$query = new WP_Query( array(
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_type'      => 'objects',
		'post_status'    => 'publish'
	) );

	if($query -> have_posts()): while ($query -> have_posts()) : $query -> the_post(); 
		$arrGK[] = array(
			'id'    => get_the_ID(),
			'title' => get_the_title()
		);
	endwhile; wp_reset_postdata(); endif;

	return $arrGK;

}

function args_query_apartments() {

	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	$post_args = array(
		'posts_per_page' => 10,
		'orderby'        => 'date',
		'paged'          => $paged,
		'order'          => 'DESC',
		'post_type'      => 'kvartira',
		'post_status'    => 'publish'
	);
	
	$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
	
	$get_gk         = $_GET['gk'] ? $_GET['gk'] : false;
	$get_floor      = $_GET['floor'] ? $_GET['floor'] : false;
	$get_room       = $_GET['room'] ? $_GET['room'] : false;
	$get_price_from = $_GET['price-from'] ? str_replace('.','',$_GET['price-from']) : '';
	$get_price_to   = $_GET['price-to'] ? str_replace('.','',$_GET['price-to']) : '';
	
	if ($get_gk) {
		$post_args['meta_query'][] = array(
			'key'     => 'apart_gk',
			'compare' => '=',
			'value'   => $get_gk
		);
	}
	
	if ($get_floor) {
		$post_args['tax_query'][] = array(
			'taxonomy' => 'floors',
			'field'    => 'id',
			'terms'    => $get_floor
		);
	}
	
	if ($get_room) {
		$post_args['tax_query'][] = array(
			'taxonomy' => 'kvartiry',
			'field'    => 'id',
			'terms'    => $get_room
		);
	}
	
	if ($term && !$get_room) {
		$post_args['tax_query'][] = array(
				'taxonomy' => get_query_var('taxonomy'),
				'field'    => 'id',
				'terms'    => $term
		);
	}
	
	if ($get_price_from && $get_price_to) {
		$post_args['meta_query'][] = array(
			'key'     => 'apart_price',
			'type '   => 'numeric',
			'compare' => 'BETWEEN',
			'value'   => array( $get_price_from, $get_price_to )		
		);
	}

	return $post_args;

}