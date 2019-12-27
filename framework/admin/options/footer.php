<?php
/*
 * Footer Section
*/
$this->sections[] = array(
  'title' => esc_html__('Footer', 'animo'),
  'icon' => 'el-icon-photo',
  'fields' => array(

    array(
      'id'       =>'footer-logo',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Логотиип в футере', 'animo'),
      'subtitle' => esc_html__('Показать логотип в футере', 'animo'),
    ),

    array(
      'id' => 'footer-enable-switch',
      'type'   => 'switch',
      'title' => esc_html__('Показать Footer', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('Если вкл - футер будет показываться', 'animo'),
    ),

    array(
      'id'       => 'footer-template',
      'type'     => 'select',
      'title'    => esc_html__('Шаблон футера', 'animo'),
      'subtitle' => esc_html__('Выберите шаблон для футера', 'animo'),
      'options'  => array(
        'default'     => esc_html__('4 колонки','animo'),
        'alternative' => esc_html__('Alternative','animo'),
      ),
      'default' => 'default',
      'validate' => 'not_empty',
    ),
  
    array(
      'id'        => 'footer-sidebar-1',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 1', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
    array(
      'id'        => 'footer-sidebar-2',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 2', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
    array(
      'id'        => 'footer-sidebar-3',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 3', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
    array(
      'id'        => 'footer-sidebar-4',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 4', 'animo'),
      'subtitle'  => esc_html__('Select custom sidebar', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
    ),
  
    array(
      'id' => 'scroll-to-top',
      'type'   => 'switch',
      'title' => esc_html__('Кнопка вернуться наверх', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
  
  ), // #fields
);

























