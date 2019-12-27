<?php
/**
 * Blog Meta
 *
 * @package animo
 * @since 1.0
 */
?>
<?php if(has_post_thumbnail()): ?>
<aside>
  <figure>
    <?php the_post_thumbnail('animo-big'); ?>
  </figure>
</aside>
<?php endif; ?>
