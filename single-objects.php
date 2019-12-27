<?php
/**
 * Single.php
 *
 * @package lptheme
 * @since 1.0
 */
get_header();
?>

<div class="page-content-wrapper">
    <?php get_template_part('templates/global/blog-before-content'); ?>
      <div class="blog-container">
        <?php get_template_part('templates/single/content', get_post_type());?>
      </div>
    <?php get_template_part('templates/global/blog-after-content'); ?>
 </div>

<?php
get_template_part('templates/blog/blog-single/next','post');
get_footer();

