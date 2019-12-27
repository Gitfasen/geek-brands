<?php
/**
 * Require.
 *
 * @package lptheme
 * @since 1.0
 */
add_action( 'after_setup_theme', 'animo_after_setup' );
define ('REDUX_OPT_NAME', 'animo_theme_options');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
define ('LPTHEME_THEME_VERSION','1.0');

require get_template_directory() . '/framework/includes/theme-argument-class.php';
require get_template_directory() . '/framework/includes/helper-functions.php';
require get_template_directory() . '/framework/includes/frontend-functions.php';
require get_template_directory() . '/framework/includes/filters-config.php';
require get_template_directory() . '/framework/admin/admin-init.php';
require get_template_directory() . '/framework/includes/customization.php';

if(animo_get_opt('enable-post-types')) { require get_template_directory() .  '/framework/includes/custom-posts.php';}
if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) { require get_template_directory() . '/framework/includes/woocommerce.php';}
if(animo_get_opt('enable-seo')) { require get_template_directory() . '/framework/includes/seo-functions.php';}