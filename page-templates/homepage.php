<?php
/**
 * Template Name: Главная
 *
 * @package animo
*/
get_header();

?>
<div class="section">

	<div class="container">
		<div class="reasons__slider-title page-title-1">Наши жилые комплексы</div>
	</div>

	<div class="reasons__slider">

		<?php 
		$post_args = array(
			'posts_per_page' => 10,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'post_type'      => 'objects',
			'post_status'    => 'publish'
		);

		$query = new WP_Query( $post_args );
		?>

		<?php if($query -> have_posts()): while ($query -> have_posts()) : $query -> the_post(); ?>
			<?php
				$img = get_the_post_thumbnail_url(get_the_ID(), "full");
				$img_style = '';
				if (!$img) {
					$img = get_template_directory_uri() . '/img/object-img.png';
					$img_style = 'background-size: contain;';
				}
			?>
			<div class="reasons__slider-block" style="background-image: url(<?= $img; ?>); <?= $img_style; ?>">
				<div class="reasons__slider-text">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p>Адрес: <?php echo get_field('gk-address')['address']; ?></p>
					<a href="<?php the_permalink(); ?>" >Подробнее</a>
				</div>
			</div>
		<?php endwhile; wp_reset_postdata(); endif;?>

	</div>
</div>

<?php if( have_rows('home-advantage') ): ?>
	<div class="section s-advantage">
		<div class="container">
			<div class="page-title-1">Преимущества</div>
			<div class="row">
				
				<?php while( have_rows('home-advantage') ): the_row();?>
					<div class="col-12 col-md-4 col-lg-4">
						<div class="s-advantage-item">
							<div class="s-advantage-item-icon">
								<div class="icon-img" style="background-image: url(<?php the_sub_field('img'); ?>); "></div>
							</div>
							<div class="s-advantage-item-desc"><?php the_sub_field('desc'); ?></div>
						</div>
					</div>
				<?php endwhile; ?>

			</div>
		</div>
	</div>
<?php endif; ?>

<div class="section s-form">
	<div class="container">
		<div class="freasons__block freasons__block-bg-3">
			
				<div class="s-form-title-1">Подобрать квартиры</div>
				<form action="<?= get_home_url() ?>/chooseflat">
					<div class="row">
						<div class="col-md-4 col-lg-4">
							<div class="s-form-title-2">Выбрать ЖК</div>
							<select name="gk" class="custom-select">
								<option value="">Все ЖК</option>
								<?php if (get_gk()) : foreach( get_gk() as $gk ) : ?>
									<option value="<?= $gk['id']; ?>"><?= $gk['title']; ?></option>
								<?php endforeach; endif; ?>
							</select>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="s-form-title-2">Выбрать этаж</div>
							<select name="floor" class="custom-select">
								<option value="">Все этажи</option>
								<?php 
									$floors = get_terms(array(
										'taxonomy'      => array( 'floors' ),
										'hide_empty'    => true, 
									));
								?>						
								<?php if ($floors) : foreach( $floors as $floor ) : ?>
									<option value="<?= $floor->term_id; ?>"><?= $floor->name; ?></option>
								<?php endforeach; endif; ?>
							</select>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="s-form-title-2">Количество комнат</div>
							<select name="room" class="custom-select">
								<option value="">Все типы</option>
								<?php 
									$rooms = get_terms(array(
										'taxonomy'      => array( 'kvartiry' ),
										'hide_empty'    => true, 
									));
								?>
								<?php if ($rooms) : foreach( $rooms as $room ) : 
									if ($room->name == 'Купить студию') {
										$room->name = 'Квартира студия';
									}	
									?>
									<option value="<?= $room->term_id; ?>"><?= $room->name; ?></option>
								<?php endforeach; endif; ?>
							</select>
						</div>
					</div>
					<div class="mb30"></div>
					<div class="row">
						<div class="col-md-8 col-lg-8">
							<div class="s-form-title-2">Стоимость квартиры</div>
							<input type="text" class="js-range-slider" data-from="0" data-to="<?= get_max_price_apartments(); ?>" data-max="<?= get_max_price_apartments(); ?>" data-min="0"/>
						</div>
						<div class="col-md-4 col-lg-4 d-flex align-items-end">
							<div class="range-inputs">
								<span>от</span><input class="input-price" data-type="from" type="text" name="price-from" value="0" >
								<span>до</span><input class="input-price" data-type="to" type="text" name="price-to" value="<?= get_max_price_apartments(); ?>" >
							</div>						
						</div>
					</div>
					<button type="submit" class="freasons__btn btn-blue">подобрать</button>
				</form>
						
		</div>
		<div class="freasons_block-shadow"></div>

	</div>
</div>

<?php if( have_rows('home-banks') ): ?>
	<div class="section s-banks">
		<div class="container">
			<div class="page-title-1">Банки-партнеры</div>
			<div class="s-banks-row">
				<div class="row align-items-center justify-content-center">
					
					<?php while( have_rows('home-banks') ): the_row();?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3"><div class="s-banks-row-item" style="background-image: url(<?php the_sub_field('img');?>);"></div></div>
					<?php endwhile; ?>

				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="seotext-area section">
  <div class="container">
    <?php get_template_part('templates/content/content-page'); ?>
  </div>
</div>

<?php

$address = get_field('address','option');
$phone = get_field('phone_1','option');
$location = get_field('acf_map', 'option');

if ( $address ||  $phone || $location) :
?>

<section class="map" id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="map__block">
					<div class="map__block-content">
						<div class="page-title-1">Контакты</div>
						<?php if ($address) :?>
						<b>Адрес:</b>
						<p><?= $address; ?></p>
						<?php endif;?>
						<?php if ($phone) :?>
						<b>Телефон:</b>
						<p><?= $phone; ?></p>
						<?php endif;?>
						<a href="javascript:;" data-fancybox="" data-src="#callback" class="map__btn btn-blue">Заказать звонок</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 	
	if( $location ): ?>
		<div id="map" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
	<?php endif; ?>
</section>

<?php endif;?>

<?php
get_footer();
