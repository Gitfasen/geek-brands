<?php
/**
 *
 * @package LPtheme
*/

$img_default = get_template_directory_uri() . '/img/floor-plan.png';

$title  = get_field('apart_title') ? get_field('apart_title') : '--------';
$number = get_field('apart_number') ? get_field('apart_number') : '0';
$photo  = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : $img_default; 
$gk     = get_field('apart_gk') ? get_the_title(get_field('apart_gk')) : '---';
$floor  = wp_get_post_terms( get_the_ID(), 'floors', array('fields' => 'names') )[0];
$floor  = $floor ? $floor : '---';
$room   = get_field('apart_room') ? get_field('apart_room') : '---';
$m2     = get_field('apart_m2') ? get_field('apart_m2') : '---';

//price
if (get_field('apart_price')) {
	$price = get_field('apart_price') * $m2;
}elseif (get_field('gk-price', get_field('apart_gk'))) {
	$price = get_field('gk-price', get_field('apart_gk')) * $m2;
}else {
	$price = 'Необходимо уточнить у менеджера';
}

?>
<div class="apartments-wr-item" 
	data-title="<?php echo $title; ?>" 
	data-number="<?php echo $number; ?>" 
	data-price="<?php echo $price; ?>" 
	data-img="<?php echo $photo; ?>" 
	data-m2="<?php echo $m2; ?>"
	data-gk="<?php echo $gk; ?>">
	<div class="apartment-photo">
		<div class="img" style="background-image: url(<?php echo $photo; ?>)"></div>
	</div>
	<div class="apartment-gk"><?php echo $gk; ?></div>
	<div class="apartment-floor"><?php echo $floor; ?></div>
	<div class="apartment-room"><?php echo $room; ?></div>
	<div class="apartment-m2"><?php echo $m2; ?></div>
</div>