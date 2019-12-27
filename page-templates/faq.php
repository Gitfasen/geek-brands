<?php
/**
 * Template Name: FAQ
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


<?php if( have_rows('faq') ): ?>
  <div class="faqs accordeon row">
   <?php while( have_rows('faq') ): the_row(); 
  $question = get_sub_field('question');
  $answer = get_sub_field('answer');
  ?>
  
      <div class="col-12 col-md-6">
        <div class="single-faq single_acc">
          <div class="accordeon_title">
            <?php echo $question; ?>
          </div>
          <div class="accordeon_content">
            <?php echo $answer; ?>
          </div>
        </div>
      </div>

      <?php endwhile; ?>
    </div>
  <?php endif; ?>


   <?php if (have_posts()): the_post();  the_content(); endif;?> 
  <?php get_template_part('templates/global/page-after-content');?>
  </div>
</div>

<?php get_footer();
