<?php
/**
 * Filter Hooks
 *
 * @package make
 * @since 1.0
 */


/**
 * Avatar img class
 *
 * @package make
 * @since 1.0
 */
if( !function_exists('animo_add_gravatar_class')) {
  function animo_add_gravatar_class( $class ) {
    $class = str_replace("class='avatar", "class='media-object img-responsive img-circle", $class);
    return $class;
  }
  add_filter('get_avatar','animo_add_gravatar_class');
}

/**
 * Body Filter Hook
 *
 * @package make
 * @since 1.0
 */
if( !function_exists('animo_body_class')) {
  function animo_body_class($classes) {
    $classes[]  = '';
    $classes[]  = animo_get_opt('header-template');
    return $classes;
  }
  add_filter('body_class', 'animo_body_class');
}



