<?php
/**
 * Blog next post navigation
 *
 * @package animo
 * @since 1.0
 */
?>
<?php
  $nextPost = get_next_post();
  if($nextPost):
    $args = array(
      'posts_per_page' => 1,
      'include'        => $nextPost->ID
    );
    $nextPost = get_posts($args);
    foreach ($nextPost as $post):
      setup_postdata($post);
?>
<section>
  <article class="blog-new-post">
    <?php if(has_post_thumbnail()): ?>
    <figure>
      <?php the_post_thumbnail(); ?>
    </figure>
    <?php endif; ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="content">
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F d, Y'); ?></time>
            <h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
            <p class="author">by <strong><a href="<?php echo  get_the_author_link(); ?>"><?php echo get_the_author(); ?></a></strong></p>
          </div><!-- /content -->
        </div><!-- /col-md-12 -->
      </div><!-- /row -->
    </div><!-- /container -->
  </article><!-- /blog-new-post -->
</section>
<?php
wp_reset_postdata(); endforeach; endif;
