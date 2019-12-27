<?php
/**
 * Page Template Portfolio
 */
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'portfolio-layout',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Layout', 'animo'),
      'subtitle'  => esc_html__('Select portfolio style.', 'animo'),
      'options'   => array(
        'fullwidth'         => esc_html__('Full Width', 'animo'),
        'fullwidth-masonry' => esc_html__('Full Width Masonry', 'animo'),
        'grid'              => esc_html__('Grid', 'animo'),
        'grid-item'         => esc_html__('Grid Items', 'animo'),
        'grid-masonry'      => esc_html__('Grid Masonry', 'animo'),
        'grid-masonry-item' => esc_html__('Grid Masonry Items', 'animo'),
      ),
      'default'   => 'fullwidth',
    ),
    array(
      'id'        => 'portfolio-textarea',
      'type'      => 'textarea',
      'title'     => esc_html__('Content', 'animo'),
      'subtitle'  => esc_html__('Add content to show on top header.', 'animo'),
      'default'   => '',
    ),
    array(
      'id'        => 'portfolio-posts-per-page',
      'type'      => 'text',
      'title'     => esc_html__('Posts per page', 'animo'),
      'subtitle'  => esc_html__('The number of items to show.', 'animo'),
      'default'   => '',
    ),
    array(
      'id'       => 'portfolio-enable-filter',
      'type'     => 'button_set',
      'title'    => esc_html__('Enable Filter', 'animo'),
      'subtitle' => esc_html__('If on filter will be enabled.', 'animo'),
      'options'  => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'        => 'portfolio-category',
      'type'      => 'select',
      'title'     => esc_html__('Categories', 'animo'),
      'subtitle'  => esc_html__('Select desired categories', 'animo'),
      'options'   => animo_element_values_page( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'portfolio-category',
        'hide_empty'  => false,
      ) ),
      'multi'     => true,
      'default' => '',
    ),
    array(
      'id'        => 'portfolio-exclude-posts',
      'type'      => 'text',
      'title'     => esc_html__('Excluded blog items', 'animo'),
      'subtitle'  => esc_html__('Post IDs you want to exclude, separated by commas eg. 120,123,1005', 'animo'),
      'default'   => '',
    ),
  )
);
