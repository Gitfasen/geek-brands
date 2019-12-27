<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'post-gallery',
      'type'      => 'slides',
      'title'     => esc_html__('Gallery Slider', 'animo'),
      'subtitle'  => esc_html__('Upload images or add from media library.', 'animo'),
      'placeholder'   => array(
        'title'         => esc_html__('Title', 'animo'),
      ),
      'show' => array(
        'title' => true,
        'description' => false,
        'url' => false,
      )
    ),
  )
);
