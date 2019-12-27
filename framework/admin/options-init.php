<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('animo_Redux_Framework_config')) {

    class animo_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css) {}

        function dynamic_section($sections) {
            $sections[] = array(
							'title' => esc_html__('Section via hook', 'animo'),
							'desc' => esc_html__('This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'animo'),
							'icon' => 'el-icon-paper-clip',
							'fields' => array()
            );

            return $sections;
        }

        function change_arguments($args) {
					return $args;
        }

        function change_defaults($defaults) {
					$defaults['str_replace'] = 'Testing filter hook!';
					return $defaults;
        }

        function remove_demo() {

					if (class_exists('ReduxFrameworkPlugin')) {
						remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);
						remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
					}

        }

        public function setSections() {

            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'animo'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
							<?php if ($screenshot) : ?>
									<?php if (current_user_can('edit_theme_options')) : ?>
													<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
															<img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'animo'); ?>" />
													</a>
									<?php endif; ?>
											<img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'animo'); ?>" />
									<?php endif; ?>

									<h4><?php echo esc_html($this->theme->display('Name')); ?></h4>

									<div>
											<ul class="theme-info">
													<li><?php printf(esc_html__('By %s', 'animo'), $this->theme->display('Author')); ?></li>
													<li><?php printf(esc_html__('Version %s', 'animo'), $this->theme->display('Version')); ?></li>
													<li><?php echo '<strong>' . esc_html__('Tags', 'animo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
											</ul>
											<p class="theme-description"><?php echo esc_html($this->theme->display('Description')); ?></p>
							<?php
							if ($this->theme->parent()) {
									printf(' <p class="howto">' . wp_kses_data(__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'animo')) . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'animo'), $this->theme->parent()->display('Name'));
							}
							?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(get_template_directory() . '/admin/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(get_template_directory() . '/admin/info-html.html');
            }

            /**
             * Loading different option tabs
             */
            require get_template_directory() . '/framework/admin/options/general.php';
            require get_template_directory() . '/framework/admin/options/header.php';
            require get_template_directory() . '/framework/admin/options/title-wrapper.php';
            require get_template_directory() . '/framework/admin/options/footer.php';
            require get_template_directory() . '/framework/admin/options/admin-panel.php';
            require get_template_directory() . '/framework/admin/options/seo.php';
        }

        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => REDUX_OPT_NAME,
                'dev_mode' => false,
                'page_slug' => 'lptheme_options',
                'page_title' => 'LPtheme options',
                'update_notice' => true,
                'intro_text' => '<h1>Настройки LPtheme</h1>',
                'footer_text' => '<p>Разработано в <a href="https://lpunity.com" target="_blank">LPunity</a></p>',
                'admin_bar' => false,
                'admin_bar_icon' => 'dashicons-dashboard',
                'menu_type' => 'submenu',
                'menu_title' => 'LPtheme',
                'allow_sub_menu' => true,      
                //'page_parent_post_type' => 'your_post_type',
                'customizer' => true,
                'default_mark' => '*',
                'hints' =>
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' =>
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' =>
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' =>
                  array(
                    'show' =>
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' =>
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => false,
                'transient_time' => '3600',
                'network_sites' => true,
              );

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");

        }

    }

    global $reduxConfig;
    $reduxConfig = new animo_Redux_Framework_config();
}


function animo_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}
add_action( 'admin_menu', 'animo_remove_redux_menu',12 );
