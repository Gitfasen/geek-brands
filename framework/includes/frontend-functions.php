<?php
/**
 * Frontend Theme Functions.
 *
 * @package lptheme
 * @subpackage Template
 */

//header logo ------------------------------------------------------------------------------- 
 if( !function_exists('animo_logo')) {
  function animo_logo($logo_field = '', $default_url = '', $class = '') {

    if (empty($logo_field)) {
      $logo_field = 'logo';
    }
    $logo = '';
    if( animo_get_opt( $logo_field ) != null ) {
      $logo_array = animo_get_opt( $logo_field );
    }
    if( (!isset( $logo_array['url'] ) || empty($logo_array['url'])) && empty($default_url)) {
      return;
    }
    if( !isset( $logo_array['url'] ) || empty($logo_array['url']) ) {
      $logo_url = $default_url;
      $class .= ' default-logo';
    } else {
      $logo_url = $logo_array['url'];
    }
    ?>
    <div class="logo-container">
      <a href="<?php echo esc_url(home_url('/')); ?>" itemscope="itemscope" itemtype="https://schema.org/Organization"><img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"></a>
    </div><!-- /logo-container -->
    <?php }
}

//footer logo ------------------------------------------------------------------------------- 
if( !function_exists('footer_logo')) {
  function footer_logo($logo_field = '', $default_url = '', $class = '') {

    if (empty($logo_field)) {
      $logo_field = 'footer-logo';
    }

    $logo = '';
    if( footer_get_opt( $logo_field ) != null ) {
      $logo_array = footer_get_opt( $logo_field );
    }
    if( (!isset( $logo_array['url'] ) || empty($logo_array['url'])) && empty($default_url)) {
      return;
    }
    if( !isset( $logo_array['url'] ) || empty($logo_array['url']) ) {
      $logo_url = $default_url;
      $class .= ' default-logo';
    } else {
      $logo_url = $logo_array['url'];
    }
    ?>
		<a href="<?php echo esc_url(home_url('/')); ?>" itemscope="itemscope" itemtype="https://schema.org/Organization"><img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"></a>
    <?php }
}

// Main Menu ------------------------------------------------------------------------------- 
if( !function_exists('animo_main_menu')) {
  function animo_main_menu($class = '') {
    if ( function_exists('wp_nav_menu') && has_nav_menu( 'primary-menu' ) ) {
      $menu = '';
      if(is_singular()) {
        $menu = animo_get_post_opt('header-primary-menu');
      }
      wp_nav_menu(array(
        'theme_location' => 'primary-menu',
        'container'      => false,
        'menu'           => $menu,
        'menu_id'        => false,
        'menu_class'     => $class,
      ));
    } else {
      echo '<a target="_blank" href="'. admin_url('nav-menus.php') .'" class="no-menu">'. __( 'Создайте меню в разделе Внешний вид/меню', 'animo' ) .'</a>';
    }
  }
}

//Mega Menu ------------------------------------------------------------------------------- 
if( !function_exists('mega_menu')) {
  function animo_mega_menu($class = '') {
    if ( function_exists('wp_nav_menu') && has_nav_menu( 'mega-menu' ) ) {
      wp_nav_menu(array(
        'theme_location' => 'mega-menu',
        'container'      => false,
        'menu_id'        => 'nav',
        'menu_class'     => $class,
      ));
    } else {
      echo '<a target="_blank" href="'. admin_url('nav-menus.php') .'" class="no-menu">'. __( 'Создайте меню в разделе Внешний вид/меню', 'animo' ) .'</a>';
    }
  }
}

//Top Bar Menu ------------------------------------------------------------------------------- 
if( !function_exists('animo_top_menu')) {
  function animo_top_menu($class = '') {
    if ( function_exists('wp_nav_menu') && has_nav_menu( 'topbar-menu' ) ) {
      wp_nav_menu(array(
        'theme_location' => 'topbar-menu',
        'container'      => false,
        'menu_id'        => 'nav',
        'menu_class'     => $class,
      ));
    } else {
      echo '<a target="_blank" href="'. admin_url('nav-menus.php') .'" class="no-menu">'. __( 'Создайте меню в разделе Внешний вид/меню', 'animo' ) .'</a>';
    }
  }
}

// Pagination ------------------------------------------------------------------------------- 
if ( ! function_exists( 'animo_paging_nav' ) ) {
  function animo_paging_nav( $max_num_pages = false, $blog_style = 'default' ) {

    $next_page_url = animo_next_page_url($max_num_pages);

    if(animo_get_post_opt('blog-pagination-style') == 'default' || $blog_style == 'default'):

      $prev_icon = 'fa-chevron-left';
      $next_icon = 'fa-chevron-right';

      if( true == is_rtl() ) {
        $prev_icon = 'fa-chevron-right';
        $next_icon = 'fa-chevron-left';
      }

      if ($max_num_pages === false) {
        global $wp_query;
        $max_num_pages = $wp_query -> max_num_pages;
      }

      $big = 999999999; 

      $links = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $max_num_pages,
        'prev_next' => true,
        'prev_text' => '<i class="fas '.$prev_icon.'"></i>',
        'next_text' => '<i class="fas '.$next_icon.'"></i>',
        'end_size'  => 1,
        'mid_size'  => 2,
        'type'      => 'plain',
      ) );


      if (!empty($links)): ?>
        <div class="blog-nav">
          <?php echo wp_kses_post($links); ?>
        </div>
      <?php endif;

     elseif(!empty($next_page_url)): ?>

      <div class="blog-nav">
        <a id="blog-load-more" href="<?php echo esc_url($next_page_url); ?>" data-loading-text="spinner" class="ajax-load-more"><span>Загрузить еще</span></a>
      </div><!-- /blog-nav -->
    <?php
    endif;

  }
}

// Show breadcrumbs ------------------------------------------------------------------------------- 
if(!function_exists('animo_breadcrumbs')) {
  function animo_breadcrumbs($class = '') {
    $before      = '<li>';
    $after       = '</li>';
    $before_last = '';
    $after_last  = '';
    $separator   = '<span class="delim">/</span>';
    if(animo_get_opt('title-breadcrumb')):
  ?>
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs">
      <?php
      $output = '';
      if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()) {
        $args = array(
          'delimiter'   => '&nbsp;/&nbsp;',
          'wrap_before' => '',
          'wrap_after'  => '',
          'before'      => '<li>',
          'after'       => '</li>',
          'home'        => esc_html_x( 'Home', 'breadcrumb', 'animo' )
        );

        woocommerce_breadcrumb($args);

      } else if (!is_home()) {

        $output .= $before.'<a href="';
        $output .= esc_url(home_url('/'));
        $output .= '">';
        $output .= esc_html__('Home', 'animo');
        $output .= '</a>'.$after. $separator .'';

        if (is_single()) {

          $cats = get_the_category();

          if( isset($cats[0]) ) :
						$output .= $before.'<a href="'. esc_url(get_category_link( $cats[0]->term_id )) .'">'. $cats[0]->cat_name.'</a>' . $after . $separator;
					elseif ( get_post_type() == 'objects') :
						$page = get_page_by_path( get_post_type() );
						$archive_title = get_the_title( $page );   
						$output .= $before.'<a href="'. esc_url(get_page_link($page->ID)) .'">'. $archive_title .'</a>' . $after . $separator;	
					elseif ( get_post_type() == 'kvartira' ) :
						$page = get_page_by_path( 'kvartiry' );
						$archive_title = get_the_title( $page );   
						$output .= $before.'<a href="'. esc_url(get_page_link($page->ID)) .'">'. $archive_title .'</a>' . $after . $separator;
					else :
						//Get post type    
						$post_type_obj = get_post_type_object( get_post_type() );
						//Get post type's label
						$title = apply_filters('post_type_archive_title', $post_type_obj->labels->name );        
						$archive_title = apply_filters('post_type_archive_title', $post_type_obj->labels->all_items);
						$output .= $before.'<a href="'. esc_url(get_post_type_archive_link(get_post_type())) .'">'. $archive_title .'</a>' . $after . $separator;						
          endif;

          if (is_single()) {
            $output .= $before.$before_last;
            $output .= get_the_title();
            $output .= $after_last.$after;
          }
        } elseif (is_tax('kvartiry')) {

					$term = get_term(get_queried_object_id(), 'kvartiry');
					if ($term->parent == 0) {
						$page = get_page_by_path( 'kvartiry' );
						$archive_title = get_the_title( $page );   
						$output .= $before.'<a href="'. esc_url(get_page_link($page->ID)) .'">'. $archive_title .'</a>' . $after . $separator . $before . single_term_title( '', false ) . $after;
					} 

				} elseif (is_archive()) {
					$output .= $before.$before_last.get_the_archive_title().$after_last.$after;
				} elseif (is_category()) {

          $cats = get_the_category();

          if( isset($cats[0]) ) :
            $output .= $before.$before_last.single_cat_title('', false).$after_last.$after;
          endif;

        } elseif (is_page()) {
          global $post;

          if($post->post_parent){
            $anc = get_post_ancestors( $post->ID );
            $title = get_the_title();
            foreach ( $anc as $ancestor ) {
              $output_ancestor = $before.'<a href="'.esc_url(get_permalink($ancestor)).'" title="'.esc_attr(get_the_title($ancestor)).'"  rel="v:url" property="v:title">'.get_the_title($ancestor).'</a>'.$after.' ' . $separator;
            }
            $output .= $output_ancestor;
            $output .= $before.$before_last.$title.$after_last.$after;
          } else {
            $output .= $before.$before_last.get_the_title().$after_last.$after;
          }
        } elseif (is_tag()) {
          $output .= $before.$before_last.single_cat_title('', false).$after_last.$after;

        } elseif (is_day()) {
          $output .= $before.$before_last. esc_html__('Archive for', 'animo').' ';
          $output .= get_the_time('F jS, Y');
          $output .= $after_last.$after;

        } elseif (is_month()) {
          $output .= $before.$before_last.esc_html__('Archive for', 'animo').' ';
          $output .= get_the_time('F, Y');
          $output .= $after_last.$after;

        } elseif (is_year()) {
          $output .= $before.$before_last. esc_html__('Archive for', 'animo').' ';
          $output .=get_the_time('Y');
          $output .= $after_last.$after;

        } elseif (is_author()) {
          $output .= $before.$before_last. esc_html__('Author Archive', 'animo');
          $output .= $after_last.$after;

        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
          $output .= $before.$before_last.esc_html__('Blog Archives', 'animo').$after_last.$after;

        } elseif (is_search()) {
          $output .= $before.$before_last. esc_html__('Search results', 'animo').$after_last.$after;

        } elseif (is_404()) {
          $output .= $before.$before_last. esc_html__('Page not Found', 'animo').$after_last.$after;

        }

      } elseif (is_home()) {
        $output .= $before.$before_last. esc_html__('Home', 'animo') .$after_last.$after;
      }

      echo wp_kses_post($output);
      ?>
    </ul>
    <!-- End Breadcrumbs -->
  <?php endif; }

}

// Get the Page Title ------------------------------------------------------------------------------- 
if( !function_exists('animo_get_the_title')) {
  function animo_get_the_title() {

    $title = '';

    //woocoomerce page
    if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()):
      if (apply_filters( 'woocommerce_show_page_title', true )):
        $title = woocommerce_page_title(false);
      endif;
    // Default Latest Posts page
    elseif( is_home() && !is_singular('page') ) :
      $title = esc_html__('Blog','animo');

    // Singular
    elseif( is_singular() ) :
      $title = get_the_title();

    // Search
    elseif( is_search() ) :
      global $wp_query;
      $total_results = $wp_query->found_posts;
      $prefix = '';

      if( $total_results == 1 ){
        $prefix = esc_html__('1 search result for', 'animo');
      }
      else if( $total_results > 1 ) {
        $prefix = $total_results . ' ' . esc_html__('search results for', '');
      }
      else {
        $prefix = esc_html__('Search results for', 'animo');
      }
      //$title = $prefix . ': ' . get_search_query();
      $title = get_search_query();

    // Category and other Taxonomies
    elseif ( is_category() ) :
      $title = single_cat_title('', false);

    elseif ( is_tag() ) :
      $title = single_tag_title('', false);

    elseif ( is_author() ) :
      $title = wp_kses_post(sprintf( __( 'Author: %s', 'animo' ), '<span class="vcard">' . get_the_author() . '</span>' ));

    elseif ( is_day() ) :
      $title = wp_kses_post(sprintf( __( 'Day: %s', 'animo' ), '<span>' . get_the_date() . '</span>' ));

    elseif ( is_month() ) :
      $title = wp_kses_post(sprintf( __( 'Month: %s', 'animo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'animo' ) ) . '</span>' ));

    elseif ( is_year() ) :
      $title = wp_kses_post(sprintf( __( 'Year: %s', 'animo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'animo' ) ) . '</span>' ));

    elseif( is_tax() ) :
      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      $title = $term->name;

    elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
      $title = esc_html__( 'Asides', 'animo' );

    elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
      $title = esc_html__( 'Galleries', 'animo');

    elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
      $title = esc_html__( 'Images', 'animo');

    elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
      $title = esc_html__( 'Videos', 'animo' );

    elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
      $title = esc_html__( 'Quotes', 'animo' );

    elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
      $title = esc_html__( 'Links', 'animo' );

    elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
      $title = esc_html__( 'Statuses', 'animo' );

    elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
      $title = esc_html__( 'Audios', 'animo' );

    elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
      $title = esc_html__( 'Chats', 'animo' );

    elseif( is_404() ) :
      $title = esc_html__( '404', 'animo' );

    else :
      $title = esc_html__( 'Archives', 'animo' );
    endif;

    return $title;
  }
}

// Social Share ------------------------------------------------------------------------------- 
if(!function_exists('animo_social_share')) {
  function animo_social_share() {
    global $post;
    $pinterest_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'animo-big-alt' );
    if(animo_get_opt('author-fb-enable') == 1 || animo_get_opt('author-twitter-enable') == 1 || animo_get_opt('author-reddit-enable') == 1 || animo_get_opt('author-pinterset-enable') == 1 || animo_get_opt('author-linkedin-enable') == 1 || animo_get_opt('author-digg-enable') == 1):
  ?>

  <div class="article-share pull-right">
    <p><?php esc_html_e('Share:', 'animo'); ?></p>
    <ul>
      <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-facebook"></i></a></li>
      <li><a href="https://twitter.com/home?status=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-twitter"></i></a></li>
      <li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_the_permalink()); ?>&amp;title=&amp;summary=&amp;source="><i class="fa fa-linkedin"></i></a></li>
    </ul>
  </div>
  <?php
    endif;
  }
}

// Comments and pingbacks ------------------------------------------------------------------------------- 
if ( ! function_exists( 'animo_comment' ) ) {

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
				<li <?php comment_class('comment-list media'); ?> id="comment-<?php comment_ID(); ?>">

					<div class="comment-body">
						<figure>
							<?php echo get_avatar( $comment, 60 ); ?>
						</figure>

						<div class="comment-content media-body">
							<h4 class="comment-author">
								<?php comment_author_link();?>
							</h4>
							<div class="comment-meta">
								<time><?php echo comment_date(get_option('date_format')) ?> at <?php echo comment_date(get_option('time_format')) ?></time>
								<?php $reply = get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 2 ) ) );
								if (!empty($reply)): ?>
									<?php echo wp_kses_post($reply); ?>
								<?php endif;
								edit_comment_link( __( 'Edit', 'animo' ), '', '' );?>
							</div>

							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php _e( 'Your comment is awaiting moderation.', 'animo' ); ?></em>
							<?php endif; ?>
							<?php comment_text(); ?>
						</div>
					</div>
				<?php
				break;
		endswitch;
	}

} 

// Close comment -------------------------------------------------------------------------------
if (!function_exists('animo_close_comment')) {

	function animo_close_comment() { ?>
		</li>
		<!-- End Comment Item -->
	<?php }

}

/* ------------------------------------------------------------------------------- */
/*
Plugin Name: Cyr to Lat enhanced
Plugin URI: http://wordpress.org/plugins/cyr3lat/
Version: 3.5
*/ 

function ctl_sanitize_title($title) {
	global $wpdb;

	$iso9_table = array(
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
		'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
		'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
		'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
		'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
		'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
		'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
		'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
		'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
		'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
		'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
		'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
		'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
		'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
		'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
		'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
		'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
	);
	$geo2lat = array(
		'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v',
		'ზ' => 'z', 'თ' => 'th', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm',
		'ნ' => 'n', 'ო' => 'o', 'პ' => 'p','ჟ' => 'zh','რ' => 'r','ს' => 's',
		'ტ' => 't','უ' => 'u','ფ' => 'ph','ქ' => 'q','ღ' => 'gh','ყ' => 'qh',
		'შ' => 'sh','ჩ' => 'ch','ც' => 'ts','ძ' => 'dz','წ' => 'ts','ჭ' => 'tch',
		'ხ' => 'kh','ჯ' => 'j','ჰ' => 'h'
	);
	$iso9_table = array_merge($iso9_table, $geo2lat);

	$locale = get_locale();
	switch ( $locale ) {
		case 'bg_BG':
			$iso9_table['Щ'] = 'SHT';
			$iso9_table['щ'] = 'sht'; 
			$iso9_table['Ъ'] = 'A';
			$iso9_table['ъ'] = 'a';
			break;
		case 'uk':
		case 'uk_ua':
		case 'uk_UA':
			$iso9_table['И'] = 'Y';
			$iso9_table['и'] = 'y';
			break;
	}

	$is_term = false;
	$backtrace = debug_backtrace();
	foreach ( $backtrace as $backtrace_entry ) {
		if ( $backtrace_entry['function'] == 'wp_insert_term' ) {
			$is_term = true;
			break;
		}
	}

	$term = $is_term ? $wpdb->get_var("SELECT slug FROM {$wpdb->terms} WHERE name = '$title'") : '';
	if ( empty($term) ) {
		$title = strtr($title, apply_filters('ctl_table', $iso9_table));
		if (function_exists('iconv')){
			$title = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $title);
		}
		$title = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $title);
		$title = preg_replace('/\-+/', '-', $title);
		$title = preg_replace('/^-+/', '', $title);
		$title = preg_replace('/-+$/', '', $title);
	} else {
		$title = $term;
	}

	return $title;
}
add_filter('sanitize_title', 'ctl_sanitize_title', 9);
add_filter('sanitize_file_name', 'ctl_sanitize_title');

function ctl_convert_existing_slugs() {
	global $wpdb;

	$posts = $wpdb->get_results("SELECT ID, post_name FROM {$wpdb->posts} WHERE post_name REGEXP('[^A-Za-z0-9\-]+') AND post_status IN ('publish', 'future', 'private')");
	foreach ( (array) $posts as $post ) {
		$sanitized_name = ctl_sanitize_title(urldecode($post->post_name));
		if ( $post->post_name != $sanitized_name ) {
			add_post_meta($post->ID, '_wp_old_slug', $post->post_name);
			$wpdb->update($wpdb->posts, array( 'post_name' => $sanitized_name ), array( 'ID' => $post->ID ));
		}
	}

	$terms = $wpdb->get_results("SELECT term_id, slug FROM {$wpdb->terms} WHERE slug REGEXP('[^A-Za-z0-9\-]+') ");
	foreach ( (array) $terms as $term ) {
		$sanitized_slug = ctl_sanitize_title(urldecode($term->slug));
		if ( $term->slug != $sanitized_slug ) {
			$wpdb->update($wpdb->terms, array( 'slug' => $sanitized_slug ), array( 'term_id' => $term->term_id ));
		}
	}
}

function ctl_schedule_conversion() {
	add_action('shutdown', 'ctl_convert_existing_slugs');
}
register_activation_hook(__FILE__, 'ctl_schedule_conversion');
/*end cyr to lat*/

//правильные даты ------------------------------------------------------------------------------- 
function true_russian_date_forms($the_date = '') {
  if ( substr_count($the_date , '---') > 0 ) {
  return str_replace('---', '', $the_date);
  }
  $replacements = array(
  "Январь" => "января",
  "Февраль" => "февраля",
  "Март" => "марта",
  "Апрель" => "апреля",
  "Май" => "мая",
  "Июнь" => "июня",
  "Июль" => "июля",
  "Август" => "августа",
  "Сентябрь" => "сентября",
  "Октябрь" => "октября",
  "Ноябрь" => "ноября",
  "Декабрь" => "декабря"
  );
  return strtr($the_date, $replacements);
}
add_filter('the_time', 'true_russian_date_forms');
add_filter('get_the_time', 'true_russian_date_forms');
add_filter('the_date', 'true_russian_date_forms');
add_filter('get_the_date', 'true_russian_date_forms');
add_filter('the_modified_time', 'true_russian_date_forms');
add_filter('get_the_modified_date', 'true_russian_date_forms');
add_filter('get_post_time', 'true_russian_date_forms');
add_filter('get_comment_date', 'true_russian_date_forms');
add_filter('get_date', 'true_russian_date_forms');


//metadata functions ------------------------------------------------------------------------------- 
if(! function_exists('lptheme_metadata')) 
{
	function lptheme_metadata() 
	{

		if( animo_get_opt('meta-title') )
		{ 
			echo '<title>'. esc_html(animo_get_opt('meta-title')) .'</title>';
		} else { 
			echo '<title>'. lptheme_meta_title() .'</title>';
		} 

		if( animo_get_opt('meta-description') )
		{ 
			echo '<meta name="description" content="'.esc_html(animo_get_opt('meta-description')).'" />';
		} else { 
			echo lptheme_meta_description();
		}

		if( animo_get_opt('meta-keywords') )
		{ 
			echo'<meta name="keywords" content="'.esc_html(animo_get_opt('meta-keywords')).'" />';
		}
  }
}

//metatitle function 
function lptheme_meta_title( $sep = '—', $add_blog_name = true ){
	static $cache; if( $cache ) return $cache;
	global $post;
	global $product;
	global $paged;
	$l10n = apply_filters( 'lptheme_meta_title_l10n', array(
		'404'     => 'Ошибка 404: такой страницы не существует',
		'search'  => 'Результаты поиска по запросу: %s',
		'compage' => 'Комментарии %s',
		'author'  => 'Статьи автора: %s',
		'archive' => 'Архив за',
		'paged'   => '(страница %d)',
	) );
	$parts = array(
		'prev'  => '',
		'title' => '',
		'after' => '',
		'paged' => '',
	);
	$title = & $parts['title']; // упростим
	$after = & $parts['after']; // упростим

	if(0){}
	// 404
	elseif ( is_404() ){
		$title = $l10n['404'];
	}
	// поиск
	elseif ( is_search() ){
		$title = sprintf( $l10n['search'], get_query_var('s') );
	}
	// главная
	elseif( is_front_page() ){
		if( is_page() && $title = get_post_meta( $post->ID, 'title', 1 ) ){
		// $title определен
		} else {
			$title = get_bloginfo('name');
			$after = get_bloginfo('description');
		}
	}
	// отдельная страница
	elseif( is_singular() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) ){
		$title = get_post_meta( get_the_ID(), 'title', 1 ); // указанный title у записи в приоритете

		if( ! $title ) $title = apply_filters( 'lptheme_meta_title_singular', '', $post );
		if( ! $title ) $title = single_post_title( '', 0 );

		if( $cpage = get_query_var('cpage') )
			$parts['prev'] = sprintf( $l10n['compage'], $cpage );
	}
	// архив типа поста
	elseif ( is_post_type_archive() ){
		$title = post_type_archive_title('', 0 );
		$after = 'blog_name';
	}
	
	// категория товара
	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

		if (is_product_category()) {
			$page = get_query_var('page');
			if ($paged > $page)
			{
				$page = $paged;
			}
			$term = get_queried_object();
			$title = get_term_meta($term->term_id, 'wh_meta_title', true);
			$title = !empty($title) ? $title : $term->name;
			$page_part = (!empty($page) && ($page > 1)) ? ' | ' . 'Page ' . $page : '';
			$title .= ' | ' . get_bloginfo('name') . $page_part;
		}

	} elseif( is_category() || is_tag() || is_tax() ){
		// таксономии
		$term = get_queried_object();
		$title = get_term_meta( $term->term_id, 'title', 1 );

		if( ! $title ){
			$title = single_term_title('', 0 );
			if( is_tax() )
				$parts['prev'] = get_taxonomy($term->taxonomy)->labels->name;
		} 
		$after = 'blog_name';

	} elseif ( is_author() ){

		// архив автора
		$title = sprintf( $l10n['author'], get_queried_object()->display_name );
		$after = 'blog_name';

	}elseif ( ( get_locale() === 'ru_RU' ) && ( is_day() || is_month() || is_year() ) ){

		// архив даты
		$rus_month  = array('', 'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
		$rus_month2 = array('', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
		$year       = get_query_var('year');
		$monthnum   = get_query_var('monthnum');
		$day        = get_query_var('day');
		if( is_year() )      $dat = "$year год";
		elseif( is_month() ) $dat = "$rus_month[$monthnum] $year года";
		elseif( is_day() )   $dat = "$day $rus_month2[$monthnum] $year года";
		$title = sprintf( $l10n['archive'], $dat );
		$after = 'blog_name';

	} else {

		// остальные архивы
		$title = get_the_title();
		$after = 'blog_name';

	}
  
	// номера страниц для пагинации и деления записи
	$pagenum = get_query_var('paged') ?: get_query_var('page');
	if( $pagenum ) $parts['paged'] = sprintf( $l10n['paged'], $pagenum );
	// позволяет фильтровать title как угодно. Сам заголово
	// $parts содержит массив с элементами: prev - текст до, title - заголовок, after - текст после
	$parts = apply_filters_ref_array( 'kama_meta_title_parts', array($parts, $l10n) );
	if( $after == 'blog_name' ) $after = $add_blog_name ? get_bloginfo('name') : '';
	// добавим пагинацию в title
	if( $parts['paged'] ){
		$parts['title'] .=  " {$parts['paged']}";
		unset( $parts['paged'] );
	}
  
	$title = implode( ' '. trim($sep) .' ', array_filter($parts) );
	//$title = apply_filters( 'lptheme_meta_title', $title );
	$title = wptexturize( $title );
	$title = esc_html( $title );
	return $cache = $title;
}

//description_________________________________________
function lptheme_meta_description( $home_description = '', $maxchar = 160 ){
	static $cache; if( $cache ) return $cache;
	global $post;
	$cut   = true;
	$desc  = '';
	// front
	if( is_front_page() ){
		// когда для главной установлена страница
		if( is_page() && $desc = get_post_meta($post->ID, 'description', true )  ){
			$cut = false;
		}
		if( ! $desc )
			$desc = $home_description ?: get_bloginfo( 'description', 'display' );
	}
	// singular
	elseif( is_singular() ){
		if( $desc = get_post_meta($post->ID, 'description', true ) )
			$cut = false;
		if( ! $desc ) $desc = $post->post_excerpt ?: $post->post_content;
		$desc = trim( strip_tags( $desc ) );
	}
	// term
	elseif( is_category() || is_tag() || is_tax() ){

		$term = get_queried_object();
		$desc = get_term_meta( $term->term_id, 'meta_description', true );
		if( ! $desc )
			$desc = get_term_meta( $term->term_id, 'description', true );

		$cut = false;
		if( ! $desc && $term->description ){
			$desc = strip_tags( $term->description );
			$cut = true;
		}
		
	}
	//категория товара
  if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
    if (is_product_category()) {
			$term = get_queried_object();
			$desc = get_term_meta($term->term_id, 'wh_meta_desc', true);
			if (!$desc)
			$cut = false;
			$desc = get_term_meta($term->term_id, 'wh_meta_desc', true);
			if( ! $desc && $term->description ){
				$desc = strip_tags( $term->description );
				$cut = true;
			}
    }
	}
	// вывод
	$origin_desc = $desc;
	if( $desc = apply_filters( 'lptheme_meta_description_pre', $desc ) ){
		$desc = str_replace( array("\n", "\r"), ' ', $desc );
		$desc = preg_replace( '~\[[^\]]+\](?!\()~', '', $desc ); // удаляем шоткоды. Оставляем маркдаун [foo](URL)
		if( $cut ){
			$char = mb_strlen( $desc );
			if( $char > $maxchar ){
				$desc     = mb_substr( $desc, 0, $maxchar );
				$words    = explode(' ', $desc );
				$maxwords = count($words) - 1; // убираем последнее слово, оно в 90% случаев неполное
				$desc     = join(' ', array_slice($words, 0, $maxwords)).' ...';
			}
		}
		$desc = preg_replace( '/\s+/s', ' ', $desc );
	}
	if( $desc = apply_filters( 'lptheme_meta_description', $desc, $origin_desc, $cut, $maxchar ) )
	return $cache = '<meta name="description" content="'. esc_attr( trim($desc) ) .'" />'."\n";
	return $cache = '';
}
  