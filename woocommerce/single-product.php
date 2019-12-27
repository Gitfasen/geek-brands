<?php
/**
 * Single.php
 *
 * @package lptheme
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<div class="page-content-wrapper">
    <div class="container">      
       
<?php get_template_part('templates/global/product-before-content'); ?>
   
<?php while ( have_posts() ) : the_post(); ?>

<?php wc_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>
 
<?php get_template_part('templates/global/shop-after-content'); ?>

   </div><!-- /container -->
</div>

<?php get_footer( 'shop' );