<?php
/*
 * Metadata Section
*/
$sections[] = array(
  'title' => esc_html__('Metadata', 'animo'),
  'desc' => esc_html__('Заполните метаданные страницы', 'animo'),
  'icon' => 'el-icon-graph',
  'fields' => array(

    array(
      'id'       => 'meta-title',
      'type'     => 'text',
      'title'    => esc_html__('Заголовок страницы (Title)', 'animo'),
      'subtitle' => esc_html__('Заголовок не больше 60 символов', 'animo'),
    ),

    array(
      'id'       => 'meta-description',
      'type'     => 'textarea',
      'title'    => esc_html__('Описание страницы (Description)', 'animo'),
      'subtitle' => esc_html__('Описание не больше 150 символов', 'animo'),
    ),
    array(
      'id'       => 'meta-keywords',
      'type'     => 'text',
      'title'    => esc_html__('Ключевые слова (Keywords)', 'animo'),
      'subtitle' => esc_html__('Перечень ключевых слов', 'animo'),
    ),
   
  ), // #fields
);