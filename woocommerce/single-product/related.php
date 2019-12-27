<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( $related_products ) : ?>
<section class="related products">
    
<?php if(has_term( 'kuhni', 'product_cat' )): ?>
 <h2>Похожие кухни</h2>
<?php elseif(has_term( 'shkafy', 'product_cat' )):?>
<h2>Похожие шкафы</h2>
<?php else:?>
<h2>Похожая мебель</h2>
<?php endif;?>

		<div id="home-carousel" class="carousel_container">
      <div class="owl-carousel owl-theme">

		<?php
		$args = array('post_type' => 'product','posts_per_page' => '7','orderby' => 'date', 'post__not_in' => array(get_the_ID()) );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post(); ?>

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
		
		<?php endwhile; // end of the loop. ?>

		</div>
</div>

	</section>
<?php endif;
wp_reset_postdata();