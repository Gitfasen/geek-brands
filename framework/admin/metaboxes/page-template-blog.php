<?php
/**
 * Page Template Blog
 */
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'blog-posts-per-page',
      'type'      => 'text',
      'title'     => esc_html__('Posts per page', 'animo'),
      'subtitle'  => esc_html__('The number of items to show.', 'animo'),
      'default'   => '',
    ),
    array(
      'id'       => 'blog-enable-pagination',
      'type'     => 'button_set',
      'title'    => esc_html__('Enable pagination', 'animo'),
      'subtitle' => esc_html__('If on pagination will be enabled.', 'animo'),
      'options'  => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'        => 'blog-pagination-style',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Pagination Style', 'animo'),
      'subtitle'  => esc_html__('Select pagination style.', 'animo'),
      'options'   => array(
        'default'   => esc_html__('Default', 'animo'),
        'load_more' => esc_html__('Load More', 'animo'),
      ),
      'default'   => 'default',
    ),
    array(
      'id'        => 'blog-category',
      'type'      => 'select',
      'title'     => esc_html__('Categories', 'animo'),
      'subtitle'  => esc_html__('Select desired categories', 'animo'),
      'options'   => animo_element_values_page( 'categories', array(
        'sort_order'  => 'ASC',
        'hide_empty'  => false,
      ) ),
      'multi'     => true,
      'default' => '',
    ),
    array(
      'id'        => 'blog-exclude-posts',
      'type'      => 'text',
      'title'     => esc_html__('Excluded blog items', 'animo'),
      'subtitle'  => esc_html__('Post IDs you want to exclude, separated by commas eg. 120,123,1005', 'animo'),
      'default'   => '',
    ),
  )
);
