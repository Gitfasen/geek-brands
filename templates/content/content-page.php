<?php
/**
 * Content Page
 *
 * @package animo
 * @since 1.0
 */

while ( have_posts() ) : the_post();

  the_content();

  wp_link_pages( array(
    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'animo' ),
    'after'  => '</div>',
  ) );

endwhile;
get_template_part('templates/global/page-after-content');


