<?php
/*
 * Header Section
*/

$this->sections[] = array(
  'title' => esc_html__('Header', 'animo'),
  'icon' => 'el-icon-website',
  'fields' => array(

    array(
      'id'=>'logo',
      'type' => 'media',
      'url' => true,
      'title' => esc_html__('Логотип', 'animo'),
      'subtitle' => esc_html__('Загрузите лого для его отображения в шапке', 'animo'),
    ),
    array(
      'id' => 'enable-topbar',
      'type'   => 'switch',
      'title' => esc_html__('Включить Top Bar', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id'=>'topbar-text',
      'type' => 'text',
      'title' => esc_html__('Текст в Top Bar', 'animo'),
      'required' => array('enable-topbar', '=', '1')
    ),
    array(
      'id' => 'enable-topbar-menu',
      'type'   => 'switch',
      'title' => esc_html__('Показать Top Bar Menu', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
      'required' => array('enable-topbar', '=', '1')
    ),

    array(
      'id'       => 'header-template',
      'type'     => 'select',
      'title'    => esc_html__('Шаблон шапки', 'animo'),
      'subtitle' => esc_html__('Выберите структуру шапки сайта', 'animo'),
      'options'  => array(
        'default'         => esc_html__('По умолчанию','animo'),
        'alternative'     => esc_html__('Область меню на всю ширину','animo'),
      ),
      'default' => 'default',
    ),

    array(
      'id'       => 'header-fixed',
      'type'     => 'select',
      'title'    => esc_html__('Sticky or Fixed', 'animo'),
      'subtitle' => esc_html__('Select if header is fixed.', 'animo'),
      'options'  => array(
        'sticky-on' => esc_html__('Sticky','animo'),
        'stick-ontop' => esc_html__('Fixed (for default menu)','animo'),
        'disfixed' => esc_html__('Отключено','animo'),
      ),
      'default' => 'disfixed',
    ),

     
    array(
      'id' => 'header-enable-switch',
      'type'   => 'switch',
      'title' => esc_html__('Показывать шапку сайта', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'header-primary-menu',
      'type' => 'select',
      'title' => esc_html__('Главное меню', 'animo'),
      'subtitle' => esc_html__('Переопределение главного меню сайта', 'animo'),
      'data' => 'menus',
      'default' => '',
    ),

  ), // #fields
);
