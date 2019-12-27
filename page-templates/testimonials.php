<?php
/**
 * Template Name: Отзывы
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

<?php if( have_rows('feeds') ): ?>
    <div class="feeds">
     
  <?php while( have_rows('feeds') ): the_row(); 
  $image = get_sub_field('photo');
  $name = get_sub_field('name');
  $text = get_sub_field('feed_text');
  ?>
          <div class="single-feed">
            <div class="feed_photo"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
            <div class="feed_name">
              <?php echo $name; ?>
            </div>
            <div class="feed_text">
              <?php echo $text; ?>
            </div>
          </div>

      <?php endwhile; ?>
    </div>
<?php endif; ?>


<?php if (have_posts()): the_post();  the_content(); endif;  ?> 
  <?php get_template_part('templates/global/page-after-content');?>
  </div>
</div>

<?php get_footer();
