<?php
/**
 * Template Name: Квартиры
 *
 * @package LPtheme
*/
get_header();
$title_wrapper = ( animo_get_opt('title-wrapper')) ? animo_get_opt('title-wrapper-template'):'default';
get_template_part('templates/title-wrapper/'.$title_wrapper);

$query = new WP_Query( args_query_apartments() );
$max_num_pages = $query -> max_num_pages;
?>

<div class="archive-content">
  <div class="container">

    <div class="apartments-wr">
			<div class="row flex-lg-row flex-md-column-reverse">

				<div class="col-lg-9">
					<div class="apartments-wr-row">

						<?php get_template_part('templates/apartment/header'); ?>

						<?php if($query -> have_posts()): while ($query -> have_posts()) : $query -> the_post(); 
							get_template_part('templates/apartment/item');
						endwhile; wp_reset_postdata(); else: ?>
							<h5>Квартир не найдено...</h5>
						<?php endif; ?>

						<?php get_template_part('templates/apartment/popup-template');?>

					</div><!-- /blog-container -->
					<?php animo_paging_nav($max_num_pages, 'default'); ?>
				</div>

				<div class="col-lg-3">
					<?php get_template_part('templates/apartment/archive-form'); ?>
				</div>

			</div>
		</div>

  </div><!-- /container -->
</div>

<?php
get_footer();
