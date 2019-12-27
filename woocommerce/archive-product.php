<?php
/**
 *
 * @package lptheme
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header('shop');
$title_wrapper = ( animo_get_opt('title-wrapper')) ? animo_get_opt('title-wrapper-template'):'default';
get_template_part('templates/title-wrapper/'.$title_wrapper);

if (get_query_var('paged')) {
    $paged = get_query_var('paged');
  }  else {
    $paged = 1;
  }
  $post_per_page = 8;
  
  
  $post_args = array(
    'posts_per_page' => $post_per_page,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_type'      => 'product',
  );

  $query = new WP_Query( $post_args );
  if(is_page() ) {
    $max_num_pages = $query -> max_num_pages;
  } else {
    global $wp_query;
    $query = $wp_query;
    $max_num_pages = false;
  }
  ?>


<div class="page-content-wrapper">
    <div class="container">
<?php get_template_part('templates/global/shop-before-content'); ?>
<?php woocommerce_product_loop_start(); ?>
<?php if($query -> have_posts()): while ($query -> have_posts()) : $query -> the_post(); ?>

<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
    <div class="product_item">
        <a href="<?php echo get_permalink()?>">
            <div class="product_image">
                <?php echo woocommerce_get_product_thumbnail('animo-medium')?>
            </div>
            <div class="product_title">
                <?php echo get_the_title()?>
            </div>
            <div class="woocommerce-product-details__short-description">
                <?php echo animo_auto_post_excerpt(30); ?>
            </div>
        </a>
    </div>
</div>

<?php endwhile; wp_reset_postdata(); else: get_template_part('templates/content/content-none'); endif; ?>

<?php woocommerce_product_loop_end(); ?>
<?php animo_paging_nav($max_num_pages, 'default'); ?>
<?php do_action( 'woocommerce_archive_description' ); ?>

        <?php get_template_part('templates/global/shop-after-content'); ?>
    </div><!-- /container -->
</div>

<?php get_footer('shop');