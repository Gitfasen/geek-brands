<?php
/*
 * Title Wrapper Section
*/

$sections[] = array(
  'title' => esc_html__('Title Wrapper', 'animo'),
  'desc' => esc_html__('Change the title wrapper section configuration.', 'animo'),
  'icon' => 'el-icon-text-width',
  'fields' => array(

    array(
      'id' => 'title-wrapper-enable-local',
      'type'   => 'button_set',
      'title' => esc_html__('Включить заголовок', 'animo'),
      'options' => array(
        '1' => 'Вкл',
        '' => 'По умолчанию',
        '0' => 'Выкл',
      ),
      'default' => '',
    ),
    array(
      'id' => 'title-wrapper-template-local',
      'type'   => 'select',
      'title' => esc_html__('Шаблон заголовка', 'animo'),
      'subtitle'=> esc_html__('Выберите шаблон отображения заголовка.', 'animo'),
      'options' => array(
        'default'      => 'Default',
        'default-big'  => 'Default Big',
        'alternative'  => 'Alternative',
        'no-text'      => 'No Text',
      ),
      'default' => '',
    ),
    array(
      'id'=>'title-wrapper-background-local',
      'type' => 'background',
      'background-color' => false,
      'title' => esc_html__('Фон заголовка', 'animo'),
      'subtitle' => esc_html__('Фон области заголовка.', 'animo'),
      'output' => array(
        'background' => '.page-title-wrapper'
      )
    ),
    array(
      'id' => 'title-breadcrumb-local',
      'type'   => 'button_set',
      'title' => esc_html__('Показать хлебные крошки', 'animo'),
      'options' => array(
        '1' => 'Вкл',
        '' => 'По умолчанию',
        '0' => 'Выкл',
      ),
      'default' => '',
    ),
    array(
      'id' => 'content-breadcrumb-local',
      'type'   => 'button_set',
      'title' => esc_html__('Показать заголовок и хлебные крошки', 'animo'),
      'subtitle' => esc_html__('В области контента', 'animo'),
      'options' => array(
        '1' => 'Вкл',
        '' => 'По умолчанию',
        '0' => 'Выкл',
      ),
      'default' => '',
    ),
    array(
      'id' => 'title-subtitle-enable-local',
      'type'   => 'button_set',
      'title' => esc_html__('Показать подзаголовок', 'animo'),
      'options' => array(
        '1' => 'Вкл',
        '' => 'По умолчанию',
        '0' => 'Выкл',
      ),
      'default' => '',
    ),
    array(
      'id'=>'title-wrapper-subtitle-local',
      'type' => 'text',
      'title' => esc_html__('Подзаголовок', 'animo'),
      'required' => array('title-subtitle-enable-local', '=', '1')
    ),

  ), // #fields
);
