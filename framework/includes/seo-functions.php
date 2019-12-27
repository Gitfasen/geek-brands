<?php
/**
 * Seo Theme Functions.
 *
 * @package lptheme
 * @subpackage Template
 */

// Remove WP embed script
function infophilic_stop_loading_wp_embed() {
	if (!is_admin()) { wp_deregister_script('wp-embed');}
}
add_action('init', 'infophilic_stop_loading_wp_embed');

//чистка ------------------------------------------------------------------------------- 
add_action('init', 'remheadlink');
function remheadlink()
{
	remove_action('wp_head','feed_links_extra', 3); // ссылки на дополнительные rss
	remove_action('wp_head','feed_links', 2); //ссылки на основной rss и комментарии
	remove_action('wp_head','rsd_link'); // для сервиса Really Simple Discovery
	remove_action('wp_head','wlwmanifest_link'); // для Windows Live Writer
	remove_action('wp_head','wp_generator'); // убирает версию wordpress
	remove_action('wp_head','start_post_rel_link',10,0);
	remove_action('wp_head','index_rel_link');
	remove_action('wp_head','rel_canonical');
	remove_action( 'wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head','wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	// Отключаем фильтры REST API
	remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
	remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
	remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

	// Отключаем Embeds связанные с REST API
	remove_action( 'rest_api_init', 'wp_oembed_register_route');
	remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
}

//отключаем heartbeat api
add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
	wp_deregister_script('heartbeat');
}

function _remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

//replace jquery version ------------------------------------------------------------------------------- 
if(animo_get_opt('enable-jquery')) { 

	add_action('wp_enqueue_scripts', 'lptheme_load_scripts');
	function lptheme_load_scripts(){
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
	}
	
	//Remove JQuery migrate
	add_action( 'wp_default_scripts', 'remove_jquery_migrate');
	function remove_jquery_migrate( $scripts ) {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) { 
				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}

}

//отключаем стили ------------------------------------------------------------------------------- 
add_action( 'wp_enqueue_scripts', 'remove_styles', 20 );
function remove_styles() {
	wp_dequeue_style('wp-block-library-theme' );
	wp_dequeue_style('wordfenceAJAXcss' );
	wp_dequeue_style('bodhi-svgs-attachment');
	wp_dequeue_style('contact-form-7');
	//wp_dequeue_style('main-style');
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme' );
	wp_dequeue_style('wordfenceAJAXcss' );
	wp_dequeue_style('cf7cf-style');
}

// перенос js в подвал ------------------------------------------------------------------------------- 
function remove_head_scripts() {
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scripts', 9);
	remove_action('wp_head', 'wp_enqueue_scripts', 1);
	
	add_action('wp_footer', 'wp_print_scripts', 5);
	add_action('wp_footer', 'wp_enqueue_scripts', 5);
	add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

//Remove type tag from script and style ------------------------------------------------------------------------------- 
add_action( 'template_redirect', function(){
	ob_start( function( $buffer ){
			$buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
			$buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );
			return $buffer;
	});
});

//compress html ------------------------------------------------------------------------------- 
function teckel_init_minify_html() {

	$minify_html_active = get_option( 'minify_html_active' );
	if ( $minify_html_active != 'no' ) {
		ob_start('teckel_minify_html_output');
	}
		
}

if ( !is_admin() ) {

	if ( !( defined( 'WP_CLI' ) && WP_CLI ) ) {
		add_action( 'init', 'teckel_init_minify_html', 1 );
	}
	
}
	

function teckel_minify_html_output($buffer) {
	if ( substr( ltrim( $buffer ), 0, 5) == '<?xml' )
		return ( $buffer );
	$minify_javascript = get_option( 'minify_javascript' );
	$minify_html_comments = get_option( 'minify_html_comments' );
	$minify_html_utf8 = get_option( 'minify_html_utf8' );
	if ( $minify_html_utf8 == 'yes' && mb_detect_encoding($buffer, 'UTF-8', true) )
		$mod = '/u';
	else
		$mod = '/s';
	$buffer = str_replace(array (chr(13) . chr(10), chr(9)), array (chr(10), ''), $buffer);
	$buffer = str_ireplace(array ('<script', '/script>', '<pre', '/pre>', '<textarea', '/textarea>', '<style', '/style>'), array ('M1N1FY-ST4RT<script', '/script>M1N1FY-3ND', 'M1N1FY-ST4RT<pre', '/pre>M1N1FY-3ND', 'M1N1FY-ST4RT<textarea', '/textarea>M1N1FY-3ND', 'M1N1FY-ST4RT<style', '/style>M1N1FY-3ND'), $buffer);
	$split = explode('M1N1FY-3ND', $buffer);
	$buffer = ''; 
	for ($i=0; $i<count($split); $i++) {
		$ii = strpos($split[$i], 'M1N1FY-ST4RT');
		if ($ii !== false) {
			$process = substr($split[$i], 0, $ii);
			$asis = substr($split[$i], $ii + 12);
			if (substr($asis, 0, 7) == '<script') {
				$split2 = explode(chr(10), $asis);
				$asis = '';
				for ($iii = 0; $iii < count($split2); $iii ++) {
					if ($split2[$iii])
						$asis .= trim($split2[$iii]) . chr(10);
					if ( $minify_javascript != 'no' )
						if (strpos($split2[$iii], '//') !== false && substr(trim($split2[$iii]), -1) == ';' )
							$asis .= chr(10);
				}
				if ($asis)
					$asis = substr($asis, 0, -1);
				if ( $minify_html_comments != 'no' )
					$asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
				if ( $minify_javascript != 'no' )
					$asis = str_replace(array (';' . chr(10), '>' . chr(10), '{' . chr(10), '}' . chr(10), ',' . chr(10)), array(';', '>', '{', '}', ','), $asis);
			} else if (substr($asis, 0, 6) == '<style') {
				$asis = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $asis);
				if ( $minify_html_comments != 'no' )
					$asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
				$asis = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}'), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ',', '}'), $asis);
			}
		} else {
			$process = $split[$i];
			$asis = '';
		}
		$process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $process);
		if ( $minify_html_comments != 'no' )
			$process = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->' . $mod, '', $process);
		$buffer .= $process.$asis;
	}
	$buffer = str_replace(array (chr(10) . '<script', chr(10) . '<style', '*/' . chr(10), 'M1N1FY-ST4RT'), array('<script', '<style', '*/', ''), $buffer);
	$minify_html_xhtml = get_option( 'minify_html_xhtml' );
	$minify_html_relative = get_option( 'minify_html_relative' );
	$minify_html_scheme = get_option( 'minify_html_scheme' );
	if ( $minify_html_xhtml == 'yes' && strtolower( substr( ltrim( $buffer ), 0, 15 ) ) == '<!doctype html>' )
		$buffer = str_replace( ' />', '>', $buffer );
	if ( $minify_html_relative == 'yes' )
		$buffer = str_replace( array ( 'https://' . $_SERVER['HTTP_HOST'] . '/', 'http://' . $_SERVER['HTTP_HOST'] . '/', '//' . $_SERVER['HTTP_HOST'] . '/' ), array( '/', '/', '/' ), $buffer );
	if ( $minify_html_scheme == 'yes' )
		$buffer = str_replace( array( 'http://', 'https://' ), '//', $buffer );
	return ($buffer);
}

