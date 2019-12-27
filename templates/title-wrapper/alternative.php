<?php
/**
 * Side Header file
 *
 * @package lptheme
 * @since 1.0
 */
?>

<?php if(animo_get_opt('title-wrapper-enable') == 1): ?>
<div class="page-title page-title-wrapper centered-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="content">
          <?php if(animo_get_opt('title-subtitle-enable')):?>
            <div class="subtitle"><?php echo esc_html(animo_get_opt('title-wrapper-subtitle')); ?></div>
          <?php endif; ?>
          <?php if(!is_single()): ?>
            <h1><?php echo animo_get_the_title(); ?></h1>
          <?php endif; ?>
        </div><!-- /content -->
      </div><!-- /col-md-12 -->
    </div><!-- /row -->
  </div><!-- /container -->
</div><!-- /page-title -->
<?php endif; ?>
</header>
