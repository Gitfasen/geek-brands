<?php
/**
 * Header Template file
 *
 * @package lptheme
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

$sticky_class      = ( animo_get_opt('header-fixed'));
$sticky_class      = (!class_exists('ReduxFramework')) ? 'disfixed':$sticky_class;
$phone1 = get_field('phone_1', 'option');
$phone2 = get_field('phone_2', 'option');
$phone3 = get_field('phone_3', 'option');
$phone4 = get_field('phone_4', 'option');
$phone1_r = preg_replace('![^0-9]+!', '', $phone1);
$phone2_r = preg_replace('![^0-9]+!', '', $phone2);
$phone3_r = preg_replace('![^0-9]+!', '', $phone3);
$phone4_r = preg_replace('![^0-9]+!', '', $phone4);
?>
<header id="main-header" class="gfx-header" itemtype="https://schema.org/WPHeader" itemscope="itemscope">
    <div class="container">
      <div class="row menu-boxes align-items-center justify-content-between">
        <div class="col-6 col-md-4 col-lg-6">
          <?php animo_logo('logo', get_template_directory_uri().'/img/logo/logo.png'); ?>
        </div><!-- /col-md-3 -->
        <div class="col-6 col-md-6 col-lg-3 mobile-menu_area">
          <a href="#" class="mobile-nav-trigger">
            <span class="bars">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </a>
        </div><!-- mobile menu btn -->
        <div class="col-6 col-md-4 col-lg-3"><div class="btn-block"><a href="#callback" class="btn primary">Перезвоните мне</a></div></div>
        <div class="col-6 col-md-4 col-lg-3">
        <div class="contacts_block">
        <?php if(($phone1)):?><a href="tel:+<?php echo $phone1_r;?>" class="tel"><span class="icon-telephone"></span> <?php echo $phone1;?></a><?php endif; ?>
        <?php if(($phone2)):?><a href="tel:+<?php echo $phone2_r;?>" class="tel"><span class="icon-telephone"></span> <?php echo $phone2;?></a><?php endif; ?>
         </div>	
        </div>
      </div><!-- /row -->
    </div><!-- /container -->
  
<nav class="main-nav <?php echo sanitize_html_class($sticky_class);?>" itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="menu-container">
          <div class="menu">
          <?php animo_main_menu(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

</header>

