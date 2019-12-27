<?php
/**
 * Video Post Format
 *
 * @package animo
 * @since 1.0
 */
?>
<?php
  wp_enqueue_style( 'mediaelement' );
  global $post;
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
<?php endif; ?>
