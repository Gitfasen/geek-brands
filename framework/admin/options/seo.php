<?php
/*
 * SEO Section
*/
$this->sections[] = array(
  'title' => esc_html__('СЕО-оптимизация', 'animo'),
  'subsection' => false,
  'icon' => 'el-icon-graph',
  'fields'  => array(
  
    array(
      'id' => 'enable-seo',
      'type'   => 'switch',
      'title' => esc_html__('Включить SEO-оптимизацию', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
      'subtitle' => esc_html__('Сайт будет оптимизирован', 'animo'),
    ),
    array(
      'id' => 'enable-jquery',
      'type'   => 'switch',
      'title' => esc_html__('Переключить на новую версию Jquery (3.2.1)', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
      'subtitle' => esc_html__('Будет отключен Jquery Migrate', 'animo'),
    ),


  ),
);



