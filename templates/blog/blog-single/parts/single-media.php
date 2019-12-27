<?php
/**
 * Single Meida File
 *
 * @package animo
 * @since 1.0
 */
?>
<?php
  global $post;
  $post_format = get_post_format();
  switch ($post_format) {
    case 'audio':
      # code...
      break;
    case 'video':
    wp_enqueue_style( 'mediaelement' );
    $img_src        = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'animo-big');
    $video_url_m4v  = animo_get_post_opt('post-video-url-m4v');
    $video_url_webm = animo_get_post_opt('post-video-url-webm');
    if(isset($img_src[0]) && !empty($video_url_m4v) && !empty($video_url_webm)):
    ?>
      <div class="video">
        <video height="490" poster="<?php echo esc_url($img_src[0]); ?>" preload="none">
          <source type="video/mp4" src="<?php echo esc_url($video_url_m4v); ?>" />
          <source type="video/webm" src="<?php echo esc_url($video_url_webm); ?>" />
        </video>
      </div><!-- /video -->
    <?php
      endif;
      break;
    case 'gallery':
      wp_enqueue_style( 'owl');
      $gallery = animo_get_post_opt('post-gallery');
      if (is_array($gallery)): ?>
        <div class="carousel">
          <?php foreach ($gallery as $item): ?>
            <figure>
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
      <?php
      endif;
      break;
    default: ?>
      <figure>
        <?php the_post_thumbnail('animo-big'); ?>
      </figure>
    <?php
      break;
  }

