<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'post-video-url-m4v',
      'type'      => 'text',
      'title'     => esc_html__('Video URL (m4v)', 'animo'),
      'subtitle'  => esc_html__('m4v Video URL', 'animo'),
      'default'   => '',
    ),
    array(
      'id'        => 'post-video-url-webm',
      'type'      => 'text',
      'title'     => esc_html__('Video URL (webm)', 'animo'),
      'subtitle'  => esc_html__('webm Video URL', 'animo'),
      'default'   => '',
    ),
  )
);
