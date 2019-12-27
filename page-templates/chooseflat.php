<?php
/**
 * Template Name: Подобрать квартиру
 *
 * @package animo
*/
get_header();
$title_wrapper = ( animo_get_opt('title-wrapper')) ? animo_get_opt('title-wrapper-template'):'default';
get_template_part('templates/title-wrapper/'.$title_wrapper);

$arrGK = get_gk();

$floors = get_terms(array(
	'taxonomy'      => array( 'floors' ),
	'hide_empty'    => true, 
));

$rooms = get_terms(array(
	'taxonomy'      => array( 'kvartiry' ),
	'hide_empty'    => true, 
));

// Гет запрос с формы
$get_gk         = $_GET['gk'];
$get_floor      = $_GET['floor'];
$get_room       = $_GET['room'];
$get_price_from = $_GET['price-from'] ? str_replace('.','',$_GET['price-from']) : 0;
$get_price_to   = $_GET['price-to'] ? str_replace('.','',$_GET['price-to']) : get_max_price_apartments();

$query = new WP_Query( args_query_apartments() );
$max_num_pages = $query -> max_num_pages;
?>
<div class="chooseflat-page s-form">
	<div class="container">

		<div class="chooseflat-s-1">
			<div class="freasons__block freasons__block-bg-3">

				<form action="">
					<div class="row">
						<div class="col-md-4 col-lg-4">
							<div class="s-form-title-2">Выбрать ЖК</div>
							<select name="gk" class="custom-select">
								<option value="">Все ЖК</option>
								<?php if (isset($arrGK)) : foreach( $arrGK as $gk ) : ?>
									<?php if (isset($get_gk) && $get_gk == $gk['id']) : ?>
										<option selected value="<?= $gk['id']; ?>"><?= $gk['title']; ?></option>
									<?php else : ?>
										<option value="<?= $gk['id']; ?>"><?= $gk['title']; ?></option>
									<?php endif;?>
								<?php endforeach; endif; ?>
							</select>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="s-form-title-2">Выбрать этаж</div>
							<select name="floor" class="custom-select">
								<option value="">Все этажи</option>
								<?php if (isset($floors)) : foreach( $floors as $floor ) : ?>
									<?php if (isset($get_floor) && $get_floor == $floor->term_id) : ?>
										<option selected value="<?= $floor->term_id; ?>"><?= $floor->name; ?></option>
									<?php else : ?>
										<option value="<?= $floor->term_id; ?>"><?= $floor->name; ?></option>
									<?php endif;?>
								<?php endforeach; endif; ?>
							</select>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="s-form-title-2">Количество комнат</div>
							<select name="room" class="custom-select">
								<option value="">Все типы</option>
								<?php if (isset($rooms)) : foreach( $rooms as $room ) : ?>
									<?php 
										if ($room->name == 'Купить студию') {
											$room->name = 'Квартира студия';
										}	
										if (isset($get_room) && $get_room == $room->term_id) : ?>
										<option selected value="<?= $room->term_id; ?>"><?= $room->name; ?></option>
									<?php else : ?>
										<option value="<?= $room->term_id; ?>"><?= $room->name; ?></option>
									<?php endif;?>
								<?php endforeach; endif; ?>
							</select>
						</div>
					</div>
					<div class="mb30"></div>
					<div class="row">
						<div class="col-md-8 col-lg-8">
							<div class="s-form-title-2">Стоимость квартиры</div>
							<input type="text" class="js-range-slider" data-from="0" data-to="<?php echo get_max_price_apartments() ?>" data-max="<?php echo get_max_price_apartments() ?>" data-min="0"/>
						</div>
						<div class="col-md-4 col-lg-4 d-flex align-items-end">
							<div class="range-inputs">
								<span>от</span><input class="input-price" data-type="from" type="text" name="price-from" value="0" >
								<span>до</span><input class="input-price" data-type="to" type="text" name="price-to" value="<?php echo get_max_price_apartments() ?>" >
							</div>						
						</div>
						<?php if ( (int) $get_price_from > 0 || (int) $get_price_to < get_max_price_apartments()) :?>
							<script>
								whenAvailable('changeRange', function() {
									window.changeRange(<?php echo $get_price_from ?>,<?php echo $get_price_to ?>);
								}) 
							</script>
						<?php endif; ?>
					</div>
					<button type="submit" class="freasons__btn btn-blue">подобрать</button>
				</form>
						
			</div>
			<div class="freasons_block-shadow"></div>
		</div>

		<div class="section chooseflat-s-2">
		<div class="apartments-wr-row">
			<?php get_template_part('templates/apartment/header'); ?>

			<?php if($query -> have_posts()): while ($query -> have_posts()) : $query -> the_post(); 
				get_template_part('templates/apartment/item');
			endwhile; wp_reset_postdata(); else:
				get_template_part('templates/content', 'none');
			endif; ?>

			<?php get_template_part('templates/apartment/popup-template');?>

			</div><!-- /blog-container -->
			<?php animo_paging_nav($max_num_pages, 'default'); ?>
		</div>

	</div>
</div>


<?php
get_footer();