<?php
/*
 * Sidebar Section
*/

$sections[] = array(
  'title' => esc_html__('Сайдбар', 'animo'),
  'desc' => esc_html__('Измените расположение сайдбара.', 'animo'),
  'icon' => 'el-icon-adjust-alt',
  'fields' => array(
    array(
      'id'        => 'main-layout-local',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Главная разметка', 'animo'),
      'subtitle'  => esc_html__('Выберите расположение сайдбара или отключите его', 'animo'),
      'options'   => array(
        'default'       => esc_html__('На всю ширину', 'animo'),
        'left_sidebar'  => esc_html__('Сайдбар слева', 'animo'),
        'right_sidebar' => esc_html__('Сайдбар справа', 'animo'),
      ),
      'default'   => '',
    ),
    array(
      'id'        => 'sidebar-local',
      'type'      => 'select',
      'title'     => esc_html__('Сайдбар', 'animo'),
      'subtitle'  => esc_html__('Выберите сайдбар', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('main-layout-local', 'equals', array('left_sidebar', 'right_sidebar')),
    ),

  ),
);
