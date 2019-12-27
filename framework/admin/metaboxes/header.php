<?php
/*
 * Header Section
*/
$sections[] = array(
  'title' => esc_html__('Шапка сайта', 'animo'),
  'icon' => 'el-icon-website',
  'fields' => array(

    array(
      'id' => 'header-enable-switch-local',
      'type' => 'button_set',
      'title' => esc_html__('Отображение шапки', 'animo'),
      'options' => array(
        '1' => 'Вкл',
        '' => 'По умолчанию',
        '0' => 'Выкл',
      ),
      'default' => '',
    ),
    array(
      'id'       => 'header-template-local',
      'type'     => 'select',
      'title'    => esc_html__('Шаблон шапки', 'animo'),
      'options'  => array(
        'default'         => esc_html__('По умолчанию','animo'),
        'alternative'     => esc_html__('Область меню на всю ширину','animo'),
      ),
      'default' => '',
      'validate' => '',
    ),
    array(
      'id'=>'header-primary-menu',
      'type' => 'select',
      'title' => esc_html__('Главное меню', 'animo'),
      'subtitle' => esc_html__('Переопределение главного меню сайта', 'animo'),
      'data' => 'menus',
      'default' => '',
    ),

    array(
      'id'       => 'header-fixed-local',
      'type'     => 'select',
      'title'    => esc_html__('Sticky or Fixed', 'animo'),
      'subtitle' => esc_html__('Фиксация меню.', 'animo'),
      'options'  => array(
        'sticky-on' => esc_html__('Sticky','animo'),
        'stick-ontop' => esc_html__('Fixed (for default menu)','animo'),
        'disfixed' => esc_html__('Отключено','animo'),
      ),
      'default' => '',
    ),

    array(
      'id'=>'logo-local',
      'type' => 'media',
      'url' => true,
      'title' => esc_html__('Логотип', 'animo'),
      'subtitle' => esc_html__('Отображается в шапке.', 'animo'),
    ), 

  ), // #fields
);

























