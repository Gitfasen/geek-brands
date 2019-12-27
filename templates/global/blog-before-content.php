<?php
/**
 * Before Blog Loop ( page.php )
 *
 * @package lptheme
 */
$layout = animo_get_opt('main-layout');

if ($layout == 'left_sidebar'): ?>
  <div class="row">
    <?php get_sidebar(); ?>
    <div class="col-md-9">
    <?php if(animo_get_opt('content-breadcrumb')):?>
    <div class="title-area">   
    <?php echo animo_breadcrumbs(); ?>
    <h1><?php echo animo_get_the_title()?></h1>
    </div>
    <?php endif; ?>

<?php elseif ($layout == 'right_sidebar'): ?>

    <div class="col-md-9">
    <?php if(animo_get_opt('content-breadcrumb')):?>
    <div class="title-area">
    <?php echo animo_breadcrumbs(); ?>
    <h1><?php echo animo_get_the_title()?></h1>
    </div> 
    <?php endif; ?>

<?php endif; ?>

