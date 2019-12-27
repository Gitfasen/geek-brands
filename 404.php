<?php
/**
 * 404
 *
 * @package lptheme
 * @since 1.0
 */

get_header();
?>

<div class="error-page">
  <div class="container">
    <div class="row align-content-center justify-content-center">
      <div class="col-12 col-md-6 col-lg-4 col-xs-3">
        <div class="page-404-content">
          <h1>404</h1>
          <p>Страница не найдена</p>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="btn primary"><?php echo esc_html__('Back to Home', 'animo'); ?></a>
        </div><!-- /page-404-content -->
      </div><!-- /col-md-12 -->
    </div><!-- /row -->
  </div><!-- /container -->
</div>

<?php
get_footer();
