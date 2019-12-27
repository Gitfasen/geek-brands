<?php
/**
 * Backend Theme Functions.
 *
 * @package make
 * @subpackage Template
 */

/**
 * Get theme option value
 * @param string $option
 * @return mix|boolean
 */
function animo_get_opt($option) {
  global $animo_theme_options;
  $local = false;

  //get local from main shop page
  if (class_exists( 'WooCommerce' ) && (is_shop() || is_product_category() || is_product_tag())) {

    $shop_page = wc_get_page_id( 'shop' );

    if (!empty($shop_page)) {
      $value = animo_get_post_opt( $option.'-local', (int)$shop_page);
      $local = true;
    }

    //echo $option.'from singular';

  //get local from metaboxes for the post value and override if not empty
  } else if (is_singular()) {
    $value = animo_get_post_opt( $option.'-local' );
    //print_r($value);
    $local = true;
  }

  //return local value if exists
  if ($local === true) {
    //if $value is an array we need to check if first element is not empty before we return $value
    $first_element = null;
    if (is_array($value)) {
      $first_element = reset($value);
    }
    if (is_string($value) && (strlen($value) > 0 || !empty($value)) || is_array($value) && !empty($first_element)) {
      return $value;
    }
  }
  if (isset($animo_theme_options[$option])) {
    return $animo_theme_options[$option];
  }
  return false;
}

/**
 * Get next page URL
 * @param int $max_num_pages
 * @return string/boolean
 */
if(!function_exists('animo_next_page_url')) {
  function animo_next_page_url($max_num_pages = 0) {
    if ($max_num_pages === false) {
      global $wp_query;
      $max_num_pages = $wp_query->max_num_pages;
    }
    if ($max_num_pages > max(1, get_query_var('paged'))) {
      return get_pagenum_link(max(1, get_query_var('paged')) + 1);
    }
    return false;
  }
}

/**
 * Get single post option value
 * @param unknown $option
 * @param string $id
 * @return NULL|mixed
 */
function animo_get_post_opt( $option, $id = '' ) {
  global $post;
  if (!empty($id)) {
    $local_id = $id;
  } else {
    if(!isset($post->ID)) {
      return null;
    }
    $local_id = get_the_ID();

  }

  //echo $option;
  if(function_exists('redux_post_meta')) {
    $options = redux_post_meta(REDUX_OPT_NAME, $local_id);
  } else {
    $options = get_post_meta( $local_id, REDUX_OPT_NAME, true );
  }

  if( isset( $options[$option] ) ) {
    return $options[$option];
  } else {
    return null;
  }
}


/**
 * Get custom sidebars list
 * @return array
 */
function animo_get_custom_sidebars_list($add_default = true) {

  $sidebars = array();
  if ($add_default) {
    $sidebars['default'] = esc_html__('Default', 'animo');
  }

  $options = get_option('animo_theme_options');

  if (!isset($options['custom-sidebars']) || !is_array($options['custom-sidebars'])) {
    return $sidebars;
  }

  if (is_array($options['custom-sidebars'])) {
    foreach ($options['custom-sidebars'] as $sidebar) {
      $sidebars[sanitize_title ( $sidebar )] = $sidebar;
    }
  }

  return $sidebars;
}

/**
 * Get custom sidebar, returns $default if custom sidebar is not defined
 * @param string $default
 * @param string $sidebar_option_field
 * @return string
 */
if( !function_exists('animo_get_custom_sidebar')) {
  function animo_get_custom_sidebar($default = '', $sidebar_option_field = 'sidebar') {

    $sidebar = animo_get_opt($sidebar_option_field);

    if ($sidebar != 'default' && !empty($sidebar)) {
      return $sidebar;
    }
    return $default;
  }
}

/**
 *
 * Blog Excerpt Read More
 * @since 1.7.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'animo_auto_post_excerpt' ) ) {
  function animo_auto_post_excerpt( $limit = '' ) {
    $limit   = ( empty($limit)) ? 20:$limit;
    $content = get_the_excerpt();
    $content = strip_shortcodes( $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    $content = strip_tags( $content );
    $words   = explode( ' ', $content, $limit + 1 );

    if( count( $words ) > $limit ) {

      array_pop( $words );
      $content  = implode( ' ', $words );
      $content .= ' &hellip;';

    }
    return $content;
  }
}

/**
*
* @return none
* @param  class
* multiple class sanitization
*
**/
if ( ! function_exists( 'sanitize_html_classes' ) && function_exists( 'sanitize_html_class' ) ) {
  function sanitize_html_classes( $class, $fallback = null ) {

    // Explode it, if it's a string
    if ( is_string( $class ) ) {
      $class = explode(" ", $class);
    }

    if ( is_array( $class ) && count( $class ) > 0 ) {
      $class = array_map("sanitize_html_class", $class);
      return implode(" ", $class);
    }
    else {
      return sanitize_html_class( $class, $fallback );
    }
  }
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'animo_element_values_page' ) ) {
  function animo_element_values_page(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {
      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;
      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );
      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->post_title);
        }
      }
      break;

      case 'tags':
      case 'tag':

      $tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
        if ( !empty($tags) ) {
          foreach ( $tags as $tag ) {
            $options[$tag->term_id] = $tag->name;
        }
      }
      break;

      case 'categories':
      case 'category':

      $categories = get_categories( $query_args );
      if ( !empty($categories) ) {
        foreach ( $categories as $category ) {
          $options[$category->term_id] = $category->name;
        }
      }
      break;

      case 'custom':
      case 'callback':

      if( is_callable( $query_args['function'] ) ) {
        $options = call_user_func( $query_args['function'], $query_args['args'] );
      }

      break;

    }

    return $options;

  }
}

if ( ! function_exists( 'animo_comment' ) ) :
/**
 * Comments and pingbacks. Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since make 1.0
 */
function animo_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
      ?>
      <li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="media-body"><?php _e( 'Pingback:', 'animo' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'animo' ), ' ' ); ?></div>
      </li>
      <?php
    break;

    default :
      $class = array('comment_wrap');
      if ($depth > 1) {
        $class[] = 'chaild';
      }
      ?>
      <!-- Comment Item -->
      <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">

        <div class="comment-body">
          <figure class="comment-avatar">
            <?php echo get_avatar( $comment, 45 ); ?>
          </figure>

          <div class="comment-content">
            <div class="comment-meta">
              <h6><?php comment_author_link();?></h6>
              <time><?php echo comment_date(get_option('date_format')) ?>, <?php echo comment_date(get_option('time_format')) ?></time>
            </div>
            <?php if ( $comment->comment_approved == '0' ) : ?>
              <em><?php _e( 'Your comment is awaiting moderation.', 'animo' ); ?></em>
            <?php endif; ?>
            <?php comment_text(); ?>

            <div class="comment-rate">
              <a href="#" class="up"><i class="fa fa-angle-up"></i></a>
              <a href="#" class="down"><i class="fa fa-angle-down"></i></a>
            </div>
            <?php $reply = get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 2 ) ) );
              if (!empty($reply)): ?>
                <?php echo wp_kses_post($reply); ?>
              <?php endif;
              edit_comment_link( __( 'Edit', 'animo' ), '', '' );
            ?>

            <!--share comment-->

          </div>
        </div>
      <?php
      break;
  endswitch;
}

endif; // ends check for make_comment()

if (!function_exists('animo_close_comment')):
/**
 * Close comment
 *
 * @since make 1.0
 */
function animo_close_comment() { ?>
    </li>
    <!-- End Comment Item -->
<?php }

endif; // ends check for make_close_comment()


/**
 * getPost View
 *
 * @since make 1.0
 */
if(!function_exists('animo_getPostViews')) {
  function animo_getPostViews($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if($count == '' || $count == 0 ){
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
      return wp_kses_post('0 View', 'animo');
    }
    return $count.' '.esc_html__('Views', 'animo');
  }
}

/**
 * Set Post View
 *
 * @since make 1.0
 */
if(!function_exists('animo_setPostViews')) {
  function animo_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if($count == ''){
      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
    } else {
      $count++;
      update_post_meta($postID, $count_key, $count);
    }
  }
}

/**
 * Select header style
 * @since lptheme 1.0
 */
if(!function_exists('animo_header_template')) {
  function animo_header_template($layout) {
    if(!animo_get_opt('header-enable-switch') && class_exists('ReduxFramework')) { return; }
    switch ($layout) {
      case 'alternative': get_template_part('templates/header/alternative');
        break;
      default: get_template_part('templates/header/default');
        break;
    }
  }
}


/**
 * Select footer style
 * @since lptheme 1.0
 */
if(!function_exists('animo_footer_template')) {
  function animo_footer_template($layout) {
    if(!animo_get_opt('footer-enable-switch') && class_exists('ReduxFramework')) { return; }
    switch ($layout) {
      case 'alternative':
      default: get_template_part('templates/footer/alternative');
        break;
      case 'default': get_template_part('templates/footer/default');
        break;
    }
  }
}

/**
 * Get associative terms array
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('animo_get_terms_assoc')) {
  function animo_get_terms_assoc($terms) {
    $terms = get_terms( $terms , array('fields' => 'all' ) );

    if (is_array($terms) && !is_wp_error($terms)) {
      $terms_assoc = array();

      foreach ($terms as $term) {
        $terms_assoc[$term -> term_id] = $term -> name;
      }
      return $terms_assoc;
    }
    return false;
  }
}


function get_taxonomy_archive_link( $taxonomy ) {
  $tax = get_taxonomy( $taxonomy ) ;
  return get_bloginfo( 'url' ) . '/' . $tax->rewrite['slug'];
}