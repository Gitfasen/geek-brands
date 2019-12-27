<?php
/**
 *
 * @package LPtheme
*/
?>

<?php 

// Этажы
$floors = get_terms(array(
	'taxonomy'      => array( 'floors' ),
	'hide_empty'    => true, 
));

// Комнаты
$rooms = get_terms(array(
	'taxonomy'      => array( 'kvartiry' ),
	'hide_empty'    => true, 
));

// Страница категории
$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );

// Гет запрос с формы
$get_gk         = $_GET['gk'];
$get_floor      = $_GET['floor'];
$get_room       = $_GET['room'];
$get_price_from = $_GET['price-from'] ? str_replace('.','',$_GET['price-from']) : 0;
$get_price_to   = $_GET['price-to'] ? str_replace('.','',$_GET['price-to']) : get_max_price_apartments();
?>

<form action="" class="archive-from">
	<div class="archive-from-input">
		<select name="gk" class="custom-select">
			<option value="">Все ЖК</option>
			<?php if (get_gk()) : foreach( get_gk() as $gk ) : ?>
				<?php if ($get_gk && $get_gk == $gk['id']) : ?>
					<option selected value="<?= $gk['id']; ?>"><?= $gk['title']; ?></option>
				<?php else : ?>
					<option value="<?= $gk['id']; ?>"><?= $gk['title']; ?></option>
				<?php endif;?>
				

			<?php endforeach; endif; ?>
		</select>
	</div>
	<div class="archive-from-input">
		<select name="floor" class="custom-select">
			<option value="">Все этажи</option>
			<?php if ($floors) : foreach( $floors as $floor ) : ?>
				<?php if ($get_floor && $get_floor == $floor->term_id) : ?>
					<option selected value="<?= $floor->term_id; ?>"><?= $floor->name; ?></option>
				<?php else : ?>
					<option value="<?= $floor->term_id; ?>"><?= $floor->name; ?></option>
				<?php endif;?>

			<?php endforeach; endif; ?>
		</select>
	</div>
	<div class="archive-from-input">
		<select name="room" class="custom-select">
			<option value="">Все типы</option>
			<?php if ($rooms) : foreach( $rooms as $room ) : ?>
				<?php 
				
					if ($room->name == 'Купить студию') {
						$room->name = 'Квартира студия';
					}	
					
					if ($term && !isset($get_room) && $term->term_id == $room->term_id) : ?>
						<option selected value="<?= $room->term_id; ?>"><?= $room->name; ?></option>
					<?php elseif ($get_room && $get_room == $room->term_id) : ?>
						<option selected value="<?= $room->term_id; ?>"><?= $room->name; ?></option>
					<?php else : ?>
						<option value="<?= $room->term_id; ?>"><?= $room->name; ?></option>
					<?php endif;?>
				
			<?php endforeach; endif; ?>
		</select>
	</div>
	<div class="archive-from-label">Стоимость квартиры</div>
	<div class="archive-from-input">
		<div class="range-inputs">
			<div><span>от</span><input class="input-price" data-type="from" type="text" name="price-from" value="0" ></div>
			<div><span>до</span><input class="input-price" data-type="to" type="text" name="price-to" value="<?= get_max_price_apartments(); ?>" ></div>
		</div>
		<input type="text" class="js-range-slider" data-from="0" data-to="<?= get_max_price_apartments(); ?>" data-max="<?= get_max_price_apartments(); ?>" data-min="0"/>
	</div>
	<button type="submit" class="btn-blue">Подобрать квартиры</button>
</form>

<?php if ( (int) $get_price_from > 0 || (int) $get_price_to < get_max_price_apartments()) :?>
	<script>
		whenAvailable('changeRange', function() {
			window.changeRange(<?php echo $get_price_from ?>,<?php echo $get_price_to ?>);
		}) 
	</script>
<?php endif; ?>