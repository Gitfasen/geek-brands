<?php
/**
 * Template Name: Портфолио
 *
 * @package lptheme
*/
get_header();
$title_wrapper = ( animo_get_opt('title-wrapper')) ? animo_get_opt('title-wrapper-template'):'default';
get_template_part('templates/title-wrapper/'.$title_wrapper);
?>

<div class="page-content-wrapper">
  <div class="container">
   <?php get_template_part('templates/global/page-before-content');?>

    <div class="gallery row">
      <?php $images = get_field('gallery'); if( $images ):?>
      <?php foreach( $images as $image ): ?>
      <div class="col-6 col-md-4 col-lg-4 col-xl-3">
        <div class="single_gal_item">
        <a href="<?php echo $image['url']; ?>" data-fancybox="gallery-1">
          <img src="<?php echo $image['sizes']['portfolio-medium']; ?>" alt="<?php echo $image['alt']; ?>" />
        </a>
        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <?php if (have_posts()): the_post();  the_content(); endif;  ?> 
  <?php get_template_part('templates/global/page-after-content');?>
  </div>
</div>

<?php get_footer();
