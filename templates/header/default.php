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
		<div class="pre-header-line">
			<?php animo_logo('logo', get_template_directory_uri().'/img/logo/logo.png'); ?>

			<div class="phone-info-header">
				<a href="tel:+<?= $phone1_r; ?>" class="tel-header"><?= $phone1; ?></a>
				<a href="#callback" data-fancybox class="callback-btn">Заказать звонок</a>
			</div>
		</div>
	</div>

  <nav class="main-nav <?php echo sanitize_html_class($sticky_class); ?>" itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-12 d-flex align-items-center">
					<a href="#" class="mobile-nav-trigger"><span class="bars"><span></span><span></span><span></span></span></a>
					<div class="menu"><?php animo_main_menu('menu-items'); ?></div>
				</div><!-- /col-md-6 -->        
      </div><!-- /row -->
    </div><!-- /container -->
	</nav>

	<?php if ( is_front_page() ) :?>
	<div class="container">
		<div class="header-promo-block">
			<div class="row">
				<div class="col-12 col-md-6 col-lg-6">
					<div class="header-promo-block-info">
						<div class="header-promo-block-info-title">Акции</div>
						<p>На покупку и продажу квартир в Сочи</p>
						<a href="#callback" data-fancybox class="header__btn btn-blue">Узнать больше</a>
					</div>
				</div>
				<div class="col-md-6">
					<!-- <div class="header__slider">
						<div class="header__slider-shadow"></div>
						<div class="header__slider-block">
							<div class="header__slider-carousel">
								<div>
									<div class="header__slider-icon icon__header-1"></div>
									<div class="header__slider-text">Недвижемость <br> без посредников</div>
								</div>
								<div>
									<div class="header__slider-icon icon__header-2"></div>
									<div class="header__slider-text">Профессиональная<br> презентация <br> жилого комплекса</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="mega-mnu">
		<div class="close-btn">x</div>
		<!-- <div class="company-name"><?= get_bloginfo()?></div> -->
		<div class="company-desc"><?= get_bloginfo('description')?></div>
		<div class="mega-mnu-content">
			<?php animo_mega_menu('mega-menu-items'); ?>
		</div>	
	</div>
	
</header>

