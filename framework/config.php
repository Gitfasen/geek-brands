<?php 
/**
 * Action Hooks.
 *
 * @package lptheme
 * @since 1.0
 */

if( !function_exists('animo_after_setup')) {
  function animo_after_setup() {

    add_image_size('animo-medium', 555, 555, true );
    add_image_size('portfolio-medium', 500, 400, true );
    add_theme_support('post-thumbnails');
    add_theme_support('custom-background' );
    add_theme_support('post-formats', array('video', 'gallery') );

		// Register Menus -------------------------------------------------------------------------------------
		register_nav_menus (array(
			'primary-menu' => esc_html__('Main Menu', 'animo'),
			'mega-menu'  => esc_html__('Mega Menu', 'animo'),
			// 'footer-menu'  => esc_html__('Footer Menu', 'animo'),
			// 'mobile-menu'  => esc_html__('Mobile Menu', 'animo'),
		));

  }
}

if( !function_exists('lptheme_enqueue_scripts')) {
  function lptheme_enqueue_scripts() {

    if (is_admin()) {return;}
		if (is_singular()) {wp_enqueue_script( 'comment-reply' );} 
		
    wp_register_script('lp-js', get_template_directory_uri() .'/js/all.js', array('jquery'), LPTHEME_THEME_VERSION, true);
    wp_register_script('lp-common-js', get_template_directory_uri() .'/js/common.js', array('lp-js'), LPTHEME_THEME_VERSION, true);
    wp_register_style('lp-css', get_template_directory_uri(). '/css/main.min.css', null, LPTHEME_THEME_VERSION);
    wp_register_style('main-css', get_template_directory_uri(). '/style.css', null, LPTHEME_THEME_VERSION);
    wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css', null, LPTHEME_THEME_VERSION);
		
		wp_enqueue_script('lp-js');
		wp_enqueue_script('lp-common-js');
		wp_enqueue_style('lp-css');
		wp_enqueue_style('main-css');
		wp_enqueue_style('font-awesome');

		wp_enqueue_script('google-js', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU', null );

    // if( is_page_template('page-templates/contacts.php') ) { 
		// 	wp_enqueue_script('google-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBBU_zpkBrGVM46XQG3dUTz87S2Ig8wNvk', null );
		// 	wp_enqueue_script( 'map-inline', get_template_directory_uri() .'/js/map.js', array('jquery'), LPTHEME_THEME_VERSION, true);
    // }
  }
  add_action( 'wp_enqueue_scripts', 'lptheme_enqueue_scripts' );
}

// register sidebars ==================================================
if( !function_exists('animo_register_sidebar') ) {
  function animo_register_sidebar() {
    register_sidebar(array(
      'id'            => 'main',
      'name'          => 'Сайдбар',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="widget-title">',
      'after_title'   => '</div>',
      'description'   => 'Перетащите виджеты в сайдбар'
    ));

    for($i = 1; $i < 5; $i++) {
      register_sidebar(array(
        'id'            => 'footer-'.$i,
        'name'          => 'Footer сайдбар '.$i,
        'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="footer-widget-title">',
        'after_title'   => '</div>',
        'description'   => 'Перетащите виджеты в сайдбар'
      ));
    }

    $custom_sidebars = animo_get_opt('custom-sidebars');
    if (is_array($custom_sidebars)) {
      foreach ($custom_sidebars as $sidebar) {
        if (empty($sidebar)) {
          continue;
        }
        register_sidebar ( array (
          'name'          => $sidebar,
          'id'            => sanitize_title ( $sidebar ),
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<div class="widget-title">',
          'after_title'   => '</div>',
        ) );
      }
    }
  }
  add_action( 'widgets_init', 'animo_register_sidebar' );
}

// custom widgets ==================================================
include_once( get_stylesheet_directory() . '/widgets/megamenu/megam-widget.php');

if(! function_exists('lptheme_include_required_plugins')) {
  function lptheme_include_required_plugins() {
    $plugins = array(

      array(
        'name'    => 'Redux Framework',
        'slug'    => 'redux-framework',
        'required'  => true,
        'force_activation'   => true,
      ),

      array(
        'name'               => 'Contact Form 7', // The plugin name
        'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
        'required'           => true, // If false, the plugin is only 'recommended' instead of required
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),
    
      array(
        'name'               => 'ACF', // The plugin name
        'slug'               => 'advanced-custom-fields', // The plugin slug (typically the folder name)
        'required'           => true, // If false, the plugin is only 'recommended' instead of required
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
       	'source'             => get_template_directory_uri() . '/plugins/advanced-custom-fields-pro.zip',
      ),

      array(
        'name'               => 'Google XML Sitemaps', // The plugin name
        'slug'               => 'google-sitemap-generator', // The plugin slug (typically the folder name)
        'required'           => false, // If false, the plugin is only 'recommended' instead of required
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),

      array(
        'name'               => 'Safe SVG', // The plugin name
        'slug'               => 'safe-svg', // The plugin slug (typically the folder name)
        'required'           => true, // If false, the plugin is only 'recommended' instead of required
        'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
        'external_url'       => '', // If set, overrides default API URL and points to an external URL
      ),

    );

    $config = array(
      'id'           => 'lptheme',                   // Unique ID for hashing notices for multiple instances of TGMPA.
      'default_path' => '',                      // Default absolute path to bundled plugins.
      'menu'         => 'tgmpa-install-plugins', // Menu slug.
      'parent_slug'  => 'themes.php',            // Parent menu slug.
      'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
      'has_notices'  => true,                    // Show admin notices or not.
      'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
      'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
      'is_automatic' => false,                   // Automatically activate plugins after installation or not.
      'message'      => '',                      // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
  }
  add_action( 'tgmpa_register', 'lptheme_include_required_plugins' );
}

//speed up admin panel ==================================================
if( ( is_admin() ) ) {
  add_filter( 'wpcf7_load_js', '__return_false' );
  add_filter( 'wpcf7_load_css', '__return_false' );
  if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {wpcf7_enqueue_scripts();}
  if ( function_exists( 'wpcf7_enqueue_styles' ) ) {wpcf7_enqueue_styles();}
}

//disable revisions
function deactivate_revisions( $count ) {return 0;}
add_filter( 'wp_revisions_to_keep', 'deactivate_revisions' );

//settings page ---------------------------------------------------------------------------------------
if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Настройки сайта',
		'menu_title' 	=> 'Настройки сайта',
		'menu_slug' 	=> 'settings',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false
	));
}

//google maps acf ---------------------------------------------------------------------------------------
add_action('acf/init', 'map_acf_init');
function map_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyDsNtN8UCZ3NB8lJ1u65kfOVXBgqQhjFK8');
}