<?php
/*
 * Footer Section
*/
$sections[] = array(
  'title' => esc_html__('Footer', 'animo'),
  'icon' => 'el-icon-photo',
  'fields' => array(

    array(
      'id' => 'footer-enable-switch-local',
      'type' => 'button_set',
      'title' => esc_html__('Отображение Футера', 'animo'),
      'options' => array(
        '1' => 'Вкл',
        '' => 'По умолчанию',
        '0' => 'Выкл',
      ),
      'default' => '',
    ),
  
    array(
      'id'       => 'footer-template-local',
      'type'     => 'select',
      'title'    => esc_html__('Шаблон', 'animo'),
      'subtitle' => esc_html__('Выберите шаблон для футера.', 'animo'),
      'options'  => array(
        'default'     => esc_html__('Default','animo'),
        'alternative' => esc_html__('Alternative','animo'),
      ),
      'default' => '',
      'validate' => '',
    ),
  
    array(
      'id'        => 'footer-sidebar-1-local',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 1', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
    array(
      'id'        => 'footer-sidebar-2-local',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 2', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
    array(
      'id'        => 'footer-sidebar-3-local',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 3', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
    array(
      'id'        => 'footer-sidebar-4-local',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 4', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
   
    array(
      'id'       =>'footer-logo-local',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Логотип', 'animo'),
      'subtitle' => esc_html__('Отображается в подвале.', 'animo'),
    ),
   
  ), // #fields
);

























