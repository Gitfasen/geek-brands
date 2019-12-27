<?php
/**
 * Before Loop ( page.php )
 *
 * @package lptheme
 */
$layout = animo_get_opt('main-layout');
if ($layout == 'left_sidebar'): ?>
  <div class="row">
    <?php get_sidebar(); ?>
    <div class="col-md-9">
    <?php if(animo_get_opt('content-breadcrumb')):?>
    <?php echo animo_breadcrumbs(); ?>
    <?php endif; ?>
     

<?php elseif ($layout == 'right_sidebar'): ?>

    <div class="col-md-9">
    <?php if(animo_get_opt('content-breadcrumb')):?>
    <?php echo animo_breadcrumbs(); ?>
    <?php endif; ?>
    
<?php else: ?>
<?php if(animo_get_opt('content-breadcrumb')):?>
    <?php echo animo_breadcrumbs(); ?>
    <?php endif; ?>

<?php endif; ?>
