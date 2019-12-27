<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package animo
 */
$layout = animo_get_opt('main-layout');
switch ($layout):
  case 'left_sidebar': ?>
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="sidebar pulled-right">
        <div class="sidebar-inner">
          <?php if (is_active_sidebar( animo_get_custom_sidebar('main') )): ?>
            <?php dynamic_sidebar( animo_get_custom_sidebar('main') ); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->
    <?php break;

  case 'right_sidebar': ?>
    <!-- Sidebar -->
    <div class="col-md-3 col-md-offset-1">
      <div class="sidebar pulled-left">
        <div class="sidebar-inner">
          <?php if (is_active_sidebar( animo_get_custom_sidebar('main') )): ?>
            <?php dynamic_sidebar( animo_get_custom_sidebar('main') ); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->
    <?php break;
endswitch;
?>
