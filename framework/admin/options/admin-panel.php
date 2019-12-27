<?php
/*
 * admin panel
*/
$this->sections[] = array(
  'title' => esc_html__('Редактор админки', 'animo'),
  'desc' => esc_html__('Внешний вид админки сайта', 'animo'),
  'icon' => 'el-icon-brush',
  'fields'  => array(

    array(
      'id' => 'menu-counters',
      'type'   => 'switch',
      'title' => esc_html__('Счетчики в меню', 'animo'),
      'subtitle' => esc_html__('Будет показано кол-во пунктов в разделе', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),

    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h2 style="color:#0073aa;font-weight:700;">'.esc_html__('Скрыть или показать пункты меню админпанели', 'animo').'</h2>'
    ),
    array(
      'id' => 'off-edit',
      'type'   => 'switch',
      'title' => esc_html__('Новости', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id' => 'off-comments',
      'type'   => 'switch',
      'title' => esc_html__('Комментарии', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id' => 'off-users',
      'type'   => 'switch',
      'title' => esc_html__('Пользователи', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),

    array(
      'id' => 'off-plugins',
      'type'   => 'switch',
      'title' => esc_html__('Плагины', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),

    array(
      'id' => 'off-tools',
      'type'   => 'switch',
      'title' => esc_html__('Инструменты', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),

    array(
      'id' => 'off-options-general',
      'type'   => 'switch',
      'title' => esc_html__('Настройки', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),

    array(
      'id' => 'off-acf',
      'type'   => 'switch',
      'title' => esc_html__('Группы полей (ACF)', 'animo'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),

  ),
);
