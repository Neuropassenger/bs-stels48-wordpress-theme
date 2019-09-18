<?php

add_action( 'wp_enqueue_scripts', 'bs_stels_48_media' );
add_action( 'after_setup_theme', 'bs_stels_48_after_setup' );
add_action( 'widgets_init', 'test_register_my_widgets' );
add_theme_support( 'post-thumbnails' );



function bs_stels_48_media()
{
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/normalize.css' );
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/media.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/libs/flex_css/flex.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.css' );
    wp_enqueue_style( 'style', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap' );
    wp_enqueue_script( 'script', '//code.jquery.com/jquery-3.3.1.min.js');
    wp_enqueue_script( 'script', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.js');
    wp_enqueue_script( 'script', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.js');
    wp_enqueue_script( 'script', 'https://api-maps.yandex.ru/2.1/?apikey=<2044817c-a630-48b1-acf8-5e08fd4884d3>&lang=ru_RU');
    wp_enqueue_script( 'script', 'https://kit.fontawesome.com/d65132e2be.js');
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/common.js');
}

function bs_stels_48_after_setup()
{
    register_nav_menu('top-menu', 'Верхнее меню');
    register_nav_menu('footer-menu', 'Меню футера');
}

/*function test_register_my_widgets()
{
    register_sidebar([
        'name' => "Правая боковая панель сайта",
        'id' => 'right-sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'description' => 'Эти виджеты будут показаны в правой колонке сайта',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ]);

    register_sidebar([
        'name' => "Верхняя панель сайта",
        'id' => 'top-sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'description' => 'Эти виджеты будут в верхней части сатйта',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    ]);
}*/