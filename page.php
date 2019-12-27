<?php
/**
 * Page ( part of layout )
 *
 * @package lptheme
 * @since 1.0
 */
get_header();
$title_wrapper = ( animo_get_opt('title-wrapper')) ? animo_get_opt('title-wrapper-template'):'default';
get_template_part('templates/title-wrapper/'.$title_wrapper);
?>

<div class="page-content-wrapper">
	<div class="seotext-area section">
		<div class="container">
			<?php get_template_part('templates/content/content-page'); ?>
		</div>
	</div>
</div>

<?php
get_footer();
