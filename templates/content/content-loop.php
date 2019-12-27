<?php
/**
 * Loop
 *
 * @package animo
 * @since 1.0
 */
?>

<?php
  switch (animo_get_opt('general-home-layout')) {
    case 'list':
      $layout = 'list';
      break;

    case 'grid':
      $layout = 'grid';
      break;

    default:
      $layout = 'list';
      break;
  }
?>
<section class="contents-container">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
          <div class="heading clearfix">
            <a href="#"><?php echo animo_get_the_title(); ?></a>
          </div><!-- /heading -->
          <?php get_template_part('templates/blog/blog-'.$layout.'/content', 'latest'); ?>
      </div><!-- /col-md-8 -->
      <div class="col-md-3">
        <div class="sidebar">
          <?php if (is_active_sidebar( animo_get_custom_sidebar('main') )): ?>
            <?php dynamic_sidebar( animo_get_custom_sidebar('main') ); ?>
          <?php endif; ?>
        </div><!-- /sidebar -->
      </div><!-- /col-md-4 -->
    </div><!-- /row -->
  </div><!-- /container -->
</section>
