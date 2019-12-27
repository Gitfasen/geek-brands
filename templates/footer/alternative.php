<?php
/**
 * Footer ( default style )
 *
 * @package lptheme
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}
$email = get_field('email', 'option');
$address = get_field('address', 'option');
$phone1 = get_field('phone_1', 'option');
$phone2 = get_field('phone_2', 'option');
$phone3 = get_field('phone_3', 'option');
$phone4 = get_field('phone_4', 'option');
$phone1_r = preg_replace('![^0-9]+!', '', $phone1);
$phone2_r = preg_replace('![^0-9]+!', '', $phone2);
$phone3_r = preg_replace('![^0-9]+!', '', $phone3);
$phone4_r = preg_replace('![^0-9]+!', '', $phone4);
?>
<footer id="main-footer" itemtype="https://schema.org/WPFooter" itemscope="itemscope">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <?php if (is_active_sidebar( animo_get_custom_sidebar('footer-1', 'footer-sidebar-1') )): ?>
          <?php dynamic_sidebar( animo_get_custom_sidebar('footer-1', 'footer-sidebar-1') ); ?>
          <?php else: ?>
          <div class="widget footer_widget contacts"><div class="footer-widget-title">О компании</div>	
          <div class="company_block">
          <?php animo_logo('footer-logo', get_template_directory_uri().'/img/logo/white-logo.png'); ?>
            </div>
            </div>
        <?php endif; ?>
      </div><!-- /col-md-3 -->
      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <?php if (is_active_sidebar( animo_get_custom_sidebar('footer-2', 'footer-sidebar-2') )): ?>
          <?php dynamic_sidebar( animo_get_custom_sidebar('footer-2', 'footer-sidebar-2') ); ?>
        <?php endif; ?>
      </div><!-- /.col-md-3 -->
      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <?php if (is_active_sidebar( animo_get_custom_sidebar('footer-3', 'footer-sidebar-3') )): ?>
          <?php dynamic_sidebar( animo_get_custom_sidebar('footer-3', 'footer-sidebar-3') ); ?>
        <?php endif; ?>
      </div><!-- /.col-md-3 -->
      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <?php if (is_active_sidebar( animo_get_custom_sidebar('footer-4', 'footer-sidebar-4') )): ?>
          <?php dynamic_sidebar( animo_get_custom_sidebar('footer-4', 'footer-sidebar-4') ); ?>
          <?php else: ?>
          <div class="widget footer_widget contacts"><div class="footer-widget-title">Контакты</div>	
          <div class="contacts_block">
        <?php if(($phone1)):?><a href="tel:+<?php echo $phone1_r;?>" class="tel"><span class="icon-telephone"></span> <?php echo $phone1;?></a><?php endif; ?>
        <?php if(($phone2)):?><a href="tel:+<?php echo $phone2_r;?>" class="tel"><span class="icon-telephone"></span> <?php echo $phone2;?></a><?php endif; ?>
        <?php if(($phone3)):?><a href="tel:+<?php echo $phone3_r;?>" class="tel"><span class="icon-telephone"></span> <?php echo $phone3; ?></a><?php endif; ?>
        <?php if(($phone4)):?><a href="tel:+<?php echo $phone4_r;?>" class="tel"><span class="icon-telephone"></span> <?php echo $phone4; ?></a><?php endif; ?>
        <div class="email_item"><?php echo $email;?></div>
        <div class="address_item"><?php echo $address;?></div>
         </div>		
      </div>
        <?php endif; ?>
      </div><!-- /.col-md-3 -->
    </div><!-- /row -->
  </div><!-- /container -->
</footer>
