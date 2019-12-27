<?php
/**
 * Gallery Post Format
 *
 * @package animo
 * @since 1.0
 */
?>
<?php
  wp_enqueue_style( 'owl');
  $gallery = animo_get_post_opt('post-gallery');
  if (is_array($gallery)): ?>
    <div class="carousel">
      <?php
        foreach ($gallery as $item):
        $image_src  = wp_get_attachment_image_src( $item['attachment_id'], 'animo-big' );
      ?>
        <figure style="background-image:url(<?php echo esc_url($image_src[0]); ?>);">
          <?php if (isset($item['attachment_id'])):
            echo wp_get_attachment_image( $item['attachment_id'], 'animo-big', array('alt' => esc_attr($item['title'])) );
          endif; ?>
        </figure>
      <?php endforeach; ?>
  </div>
  <?php else: ?>
  <a href="<?php echo get_the_permalink(); ?>">
    <figure>
      <?php if(has_post_thumbnail()) { the_post_thumbnail('animo-big'); } ?>
    </figure>
  </a>
<?php endif; ?>
