<?php
/*
 * General Section
*/
$this->sections[] = array(
  'title' => esc_html__('General', 'animo'),
  'desc' => esc_html__('Общие настройки сайта', 'animo'),
  'subsection' => true,
  'icon' => 'el-icon-home',
  'fields'  => array(
  
    array(
      'id'        => 'main-layout',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Главная разметка', 'animo'),
      'subtitle'  => esc_html__('Выберите разметку сайта, на всю ширину или с колонкой', 'animo'),
      'options'   => array(
        'default'       => esc_html__('На всю ширину', 'animo'),
        'left_sidebar'  => esc_html__('Сайдбар слева', 'animo'),
        'right_sidebar' => esc_html__('Сайдбар справа', 'animo'),
      ),
      'default'   => 'default',
    ),
    array(
      'id' => 'enable-post-types',
      'type'   => 'switch',
      'title' => esc_html__('Включить типы записей', 'animo'),
      'subtitle'=> esc_html__('Будут добавлены 2 типа записей (/framework/includes/custom-posts.php).', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id'=>'post-type-one',
      'type' => 'text',
      'title' => esc_html__('Название типа записи №1', 'animo'),
      'required' => array('enable-post-types', '=', '1')
    ),
    array(
      'id'=>'post-type-two',
      'type' => 'text',
      'title' => esc_html__('Название типа записи №2', 'animo'),
      'required' => array('enable-post-types', '=', '1')
    ),


    array(
      'id'        => 'sidebar',
      'type'      => 'select',
      'title'     => esc_html__('Сайдбар', 'animo'),
      'subtitle'  => esc_html__('Выберите сайдбар', 'animo'),
      'options'   => animo_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('main-layout', 'equals', array('left_sidebar', 'right_sidebar')),
    ),
    array(
      'id'       => 'custom-sidebars',
      'type'     => 'multi_text',
      'title'    => esc_html__( 'Добавить сайдбар', 'animo' ),
      'subtitle' => esc_html__( 'Сайдбар потом можно привязать к отдельной странице или ко всем', 'animo' ),
      'desc'     => esc_html__( 'Можно добавить несколько новых сайдбаров', 'animo' )
    ),
  
    array(
      'title' => esc_html__('Favicon 16x16', 'animo'),
      'id' => 'favicon-16',
      'type' => 'media',
      'readonly' => false,
      'url'=> true,
    ),

    array(
      'title' => esc_html__('Favicon 32x32', 'animo'),
      'id' => 'favicon-32',
      'type' => 'media',
      'readonly' => false,
      'url'=> true,
    ),
    array(
      'title' => esc_html__('Apple touch icon', 'animo'),
      'id' => 'appleicon',
      'type' => 'media',
      'readonly' => false,
      'url'=> true,
      'subtitle' => esc_html__( 'Размер 180х180', 'animo' ),
    ),

  ),
);



