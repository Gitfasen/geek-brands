<?php

add_action( 'init', 'services_init', 0 );
function services_init() {
	$post_type_one = wp_kses_data(animo_get_opt('post-type-one'));

	$labels = array(
		'name' => esc_html__( $post_type_one, 'lpthemes' ),
		'singular_name' => esc_html__( $post_type_one, 'lpthemes' ),
		'add_new' => esc_html__( 'Добавить', 'lpthemes' ),
		'add_new_item' => esc_html__( 'Добавить', 'vlthemes' ),
		'edit_item' => esc_html__( 'Редактировать', 'lpthemes' ),
		'new_item' => esc_html__( 'Добавить новую', 'lpthemes' ),
		'view_item' => esc_html__( 'Смотреть', 'lpthemes' ),
		'search_items' => esc_html__( 'Поиск', 'lpthemes' ),
		'not_found' => esc_html__( $post_type_one, 'lpthemes' ),
		'not_found_in_trash' => esc_html__( 'Корзина пуста', 'lpthemes' )
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'revisions' ),
		'capability_type' => 'post',
		'menu_position' => 4,
		'has_archive' => false,
		'hierarchical'  => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-layout',
	);

	$args = apply_filters('vlthemes_args', $args);
	register_post_type('objects', $args);
	flush_rewrite_rules();
}

function types_init() {
	$post_type_two = wp_kses_data(animo_get_opt('post-type-two'));

	$labels = array(
		'name' => esc_html__( $post_type_two, 'lpthemes' ),
		'singular_name' => esc_html__( $post_type_two, 'lpthemes' ),
		'add_new' => esc_html__( 'Добавить', 'lpthemes' ),
		'add_new_item' => esc_html__( 'Добавить', 'vlthemes' ),
		'edit_item' => esc_html__( 'Редактировать', 'lpthemes' ),
		'new_item' => esc_html__( 'Добавить', 'lpthemes' ),
		'view_item' => esc_html__( 'Смотреть', 'lpthemes' ),
		'search_items' => esc_html__( 'Поиск', 'lpthemes' ),
		'not_found' => esc_html__( $post_type_two, 'lpthemes' ),
		'not_found_in_trash' => esc_html__( 'Корзина пуста', 'l;pthemes' )
	);

	$args = array(
		'labels'          => $labels,
		'public'          => true,
		'supports'        => array( 'title', 'editor', 'thumbnail', 'author', 'revisions' ),
		'capability_type' => 'post',
		'menu_position'   => 4,
		'has_archive'     => false,
		'hierarchical'    => true,
		'show_ui'         => true,
		'show_in_rest'    => false,
		'taxonomies'      => array('kvartiry', 'floors'),
		'menu_icon'       => 'dashicons-align-left',
	);

	$args = apply_filters('vlthemes_args', $args);

	register_post_type('kvartira', $args);
	flush_rewrite_rules();
}
add_action( 'init', 'types_init', 2 );

function add_tax_apartments() {	
	register_taxonomy('kvartiry',	array('kvartira'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Тип квартиры',
				'singular_name' => 'Платформа',
				'search_items' =>  'Найти',
				'popular_items' => 'Популярные типы квартир',
				'all_items' => 'Все типы',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать', 
				'update_item' => 'Обновить',
				'add_new_item' => 'Добавить новый',
				'new_item_name' => 'Название нового типа',
				'separate_items_with_commas' => 'Разделяйте название запятыми',
				'add_or_remove_items' => 'Добавить или удалить тип',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых типов',
				'menu_name' => 'Тип квартиры'
			),
			'show_admin_column'     => true,
			'public'                => true, 
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'show_admin_column'     => true,
			'show_in_rest'          => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array(
				'slug' => 'kvartiry', // ярлык
				'hierarchical' => true // разрешить вложенность
			),
		)
	);
}
add_action( 'init', 'add_tax_apartments', 0 );

function add_tax_floors() {	
	register_taxonomy('floors',	array('kvartira'),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Этаж',
				'singular_name' => 'Платформа',
				'search_items' =>  'Найти',
				'popular_items' => 'Популярные этажы',
				'all_items' => 'Все этажы',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать', 
				'update_item' => 'Обновить',
				'add_new_item' => 'Добавить новый',
				'new_item_name' => 'Название нового этажа',
				'separate_items_with_commas' => 'Разделяйте название запятыми',
				'add_or_remove_items' => 'Добавить или удалить этаж',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых этажов',
				'menu_name' => 'Этажы'
			),
			'show_admin_column'     => true,
			'public'                => true, 
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'show_admin_column'     => true,
			'show_in_rest'          => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array(
				'slug' => 'floors', // ярлык
				'hierarchical' => true // разрешить вложенность
			),
		)
	);
}
add_action( 'init', 'add_tax_floors', 0 );