<?php
/**
 * Single template file
 *
 * @package lptheme
 * @since 1.0
 */
?>

<?php 

//var

$s1 = get_field('gk-slider');
$s3 = get_field('gk-gallery');
$s4 = get_field('gk-want-s');
$map = get_field('gk-address');
$doc = get_field('gk-doc');

?>

<div class="object-page">
	
	<?php if ($s1) : ?>
		<div class="object-s object-s-slider">

			<?php $i = 1; foreach($s1 as $img) :?>
				<?php if ($i == 1) : ?>
					<div class="object-s-slider-item" style="background-image: url(<?php echo $img ?>);">
						<div class="object-s-slider-item-content"><?php the_title(); ?></div>
					</div>
				<?php else :?>
					<div class="object-s-slider-item" style="background-image: url(<?php echo $img ?>);"></div>
				<?php endif; ?>
			<?php $i++; endforeach; ?>

		</div>
	<?php endif; ?>

	<?php if( have_rows('gk-s-2') ): ?>
		<?php while( have_rows('gk-s-2') ): the_row();?>
			<?php if( have_rows('s-list') ): ?>
				<div class="object-s object-s-prefer section" style="background-image: url(<?php echo get_template_directory_uri() ?>/img/351413556d94328461360882485efb00.png);">
					<div class="container">
						<h3>Вам понравится жилой комплекс, <br />потому что здесь:</h3>
						<div class="row justify-content-center">
							
							<?php while( have_rows('s-list') ): the_row();?>

								<div class="col-12 col-sm-6 col-md-4 col-lg-4">
									<div class="object-s-prefer-item" style="background-image: url(<?php the_sub_field('img'); ?>)">
										<span><?php the_sub_field('desc'); ?></span>
									</div>
								</div>

							<?php endwhile; ?>
										
						</div>
						<div class="object-s-prefer-b-title"><?php echo get_field('gk-s-2')['title']; ?></div>
						<div class="object-s-prefer-b-desc">Развитая инфраструктура всегда рядом</div>
					</div>

				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>	

	<?php if ($s3) : ?>
		<div class="object-s object-s-gallery section">
			<div class="container">
				<h3>Галерея объекта</h3>
				<div class="object-s-gallery-slider">

					<?php foreach($s3 as $g_img) :?>
						<div class="object-s-gallery-slider-item">
							<a href="<?php echo $g_img ?>" data-fancybox="object-s-gallery" style="background-image: url(<?php echo $g_img ?>);"></a>
						</div>
					<?php endforeach; ?>					

				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($s4) : ?>
		<div class="object-s object-s-want section" style="background-image: url(<?php echo get_template_directory_uri() ?>/img/0d738ad401f7f83b9d07ba1acba9596a.jpg)">
			<div class="container">
				<h3>ХОЧУ КВАРТИРУ</h3>
				<div class="row">

					<?php while( have_rows('gk-want-s') ): the_row();?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-4">
							<div class="object-s-want-item" style="background-image: url(<?php the_sub_field('img');?>);">
								<span><?php the_sub_field('desc');?></span>
							</div>
						</div>
					<?php endwhile; ?>

				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="object-s object-s-form section">
		<div class="container">

			<div class="object-s-form-item form-style-1 freasons__block">
				<?php echo do_shortcode('[contact-form-7 id="192" title="Записаться на просмотр"]')?>
			</div>
			<div class="freasons_block-shadow"></div>

		</div>
	</div>

	<?php if ($doc) : ?>
		<div class="object-s object-s-doc" >
			<div class="container">
				<h3>Документы</h3>
				<div class="row justify-content-center">
					<?php while( have_rows('gk-doc') ): the_row();?>
						<div class="col-lg-2"><a href="<?php echo get_sub_field('doc')['url']; ?>" class="btn object-s-doc-item" target="_blank"><?php echo get_sub_field('title'); ?></a></div>
					<?php endwhile; ?>					
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if (have_posts()) : ?>
		<div class="object-s object-s-seo section seotext-area">
			<div class="container">
				<?php while ( have_posts() ) : the_post(); the_content(); endwhile;?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ($map) : ?>
		<div class="object-s object-s-map">
			<h3>ЖИЛОЙ КОМПЛЕКС НА КАРТЕ</h3>
				<div id="map" style="min-height: 500px;" data-lat="<?php echo esc_attr($map['lat']); ?>" data-lng="<?php echo esc_attr($map['lng']); ?>"></div>
		</div>
	<?php endif; ?>

</div>


