<?php

add_action( 'wp_enqueue_scripts', 'stels48_media' );
add_action( 'after_setup_theme', 'stels48_after_setup' );
add_action( 'widgets_init', 'stels48_register_widgets' );
add_filter( 'wp_nav_menu_items', 'stels48_call_back_item', 10, 2 );



function stels48_media()
{
    wp_enqueue_style( 'style1', get_template_directory_uri() . '/css/normalize.css' );
    wp_enqueue_style( 'style2', get_stylesheet_uri() );
    wp_enqueue_style( 'style3', get_template_directory_uri() . '/css/media.css' );
    wp_enqueue_style( 'style4', get_template_directory_uri() . '/libs/flex_css/flex.css' );
    wp_enqueue_style( 'style5', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.css' );
    wp_enqueue_style( 'style6', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.css' );
    wp_enqueue_style( 'style7', '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap' );
    wp_enqueue_script( 'script1', '//code.jquery.com/jquery-3.3.1.min.js');
    wp_enqueue_script( 'script2', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.js');
    wp_enqueue_script( 'script3', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.js');
    wp_enqueue_script( 'script4', '//api-maps.yandex.ru/2.1/?apikey=<2044817c-a630-48b1-acf8-5e08fd4884d3>&lang=ru_RU');
    wp_enqueue_script( 'script5', '//kit.fontawesome.com/d65132e2be.js');
    wp_enqueue_script( 'script6', get_template_directory_uri() . '/js/common.js');
}

function stels48_after_setup()
{
    register_nav_menu('top-menu', 'Верхнее меню');
    register_nav_menu('footer-menu', 'Меню футера');
}

function stels48_register_widgets()
{
    register_sidebar([
        'name' => "Телефон для Header",
        'id' => 'phone-sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'description' => '',
        'before_title' => '',
        'after_title' => ''
    ]);

    register_sidebar([
        'name' => "Текст для footer",
        'id' => 'footer-sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'description' => '',
        'before_title' => '',
        'after_title' => ''
    ]);
}

function stels48_call_back_item ( $items, $args ) {
    if ( $args->theme_location == 'top-menu' || $args->theme_location == 'footer-menu' ) {
        $items .= '<li><a data-fancybox data-src="#hidden_call_back" href="javascript:;">Обратный звонок</a></li>';
    }
    return $items;
}