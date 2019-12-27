<?php
/**
 * Header file
 *
 * @package lptheme
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) { die( 'Direct script access denied.' );}
$appleicon = animo_get_opt('appleicon');
$fave32 = animo_get_opt('favicon-32');
$fave16 = animo_get_opt('favicon-16');
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="MobileOptimized" content="320">
<meta name="HandheldFriendly" content="True">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if($appleicon['url']): ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url($appleicon['url']); ?>">
<?php endif;?>
<?php if($fave32['url']): ?>
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url($fave32['url']); ?>">
<?php endif;?>
<?php if($fave16['url']): ?>
<link rel="icon" type="image/x-icon" sizes="16x16" href="<?php echo esc_url($fave16['url']); ?>">
<?php endif;?>
<?php lptheme_metadata();?>
<?php wp_head(); ?>
<script>
	function whenAvailable(name, callback) {
		var interval = 10; // ms
    window.setTimeout(function() {
        if (window[name]) {
            callback();
        } else {
            window.setTimeout(arguments.callee, interval);
        }
    }, interval);
	}
</script>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

  <div id="callback" class="modal callback-form form-style-1">
    <?php echo do_shortcode('[contact-form-7 id="108" title="Заказать звонок"]');?>
	</div>
	
	<div id="vopros" class="modal form-style-1">
    <?php echo do_shortcode('[contact-form-7 id="40" title="Контактная форма 1"]');?>
  </div>

  <div id="wrapper">

    <?php if(animo_get_opt('enable-topbar')): ?>
    <div class="top_bar">
      <div class="container">
        <div class="row align-content-center justify-content-between">
          <div class="col-12 col-md-6">
          <?php if(animo_get_opt('enable-topbar-menu')): ?>
          <?php animo_top_menu('menu-top-items'); ?>
          <?php endif;?>
          </div>
          <div class="col-12 col-md-6"><div class="text_topbar align-right"><?php echo wp_kses_data(animo_get_opt('topbar-text')); ?></div></div>
        </div>
      </div>
    </div>
    <?php endif;?>

    <?php animo_header_template(animo_get_opt('header-template')); ?>
