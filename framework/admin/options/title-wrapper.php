<?php
/*
 * Title Wrapper Section
*/

$this->sections[] = array(
  'title' => esc_html__('Область заголовка', 'animo'),
  'icon' => 'el-icon-check',
  'fields' => array(

    array(
      'id' => 'title-wrapper-enable',
      'type'   => 'switch',
      'title' => esc_html__('Включить область заголовка', 'animo'),
      'subtitle'=> esc_html__('Область заголовка будет включена.', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id' => 'title-wrapper-template',
      'type'   => 'select',
      'title' => esc_html__('Шаблон заголовка', 'animo'),
      'subtitle'=> esc_html__('Выберите шаблон заголовка', 'animo'),
      'options' => array(
        'default'     => 'Default',
        'default-big' => 'Default Big',
        'alternative' => 'Alternative',
        'no-text'     => 'No Text',
      ),
      'default' => 'default',
    ),
    array(
      'id'=>'title-wrapper-background',
      'type' => 'background',
      'background-color' => false,
      'title' => esc_html__('Фон заголовка', 'animo'),
      'subtitle' => esc_html__('Установить фон заголовка', 'animo'),
      'output' => array(
        'background' => '.page-title-wrapper'
      )
    ),
    array(
      'id' => 'title-breadcrumb',
      'type'   => 'switch',
      'title' => esc_html__('Показать хлебные крошки', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id' => 'content-breadcrumb',
      'type'   => 'switch',
      'title' => esc_html__('Показать заголовок и хлебные крошки', 'animo'),
      'subtitle' => esc_html__('В области контента', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id' => 'title-subtitle-enable',
      'type'   => 'switch',
      'title' => esc_html__('Показать подзаголовок', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id'=>'title-wrapper-subtitle',
      'type' => 'text',
      'title' => esc_html__('Подзаголовок', 'animo'),
      'required' => array('title-subtitle-enable', '=', '1'),
      'subtitle' => esc_html__('Будет показываться на всех страницах', 'animo'),
    ),

  ), // #fields
);
