<?php


add_theme_support( 'post-thumbnails' );

/*add_action( 'init', 'stels48_create_reviews_posttype' );
function stels48_create_reviews_posttype() {
    register_post_type( 'Reviews',
        array(
            'labels' => array(
                'name' => __( 'Отзывы' ),
                'singular_name' => __( 'Отзыв' ),
                'add_new_item'       => 'Добавить новый отзыв',
                'edit_item'          => 'Редактировать отзыв'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'reviews'),
            'supports' => ['title']
        )
    );
}*/

add_action( 'wp_enqueue_scripts', 'stels48_media' );
function stels48_media() {
    wp_enqueue_style( 'style1', get_template_directory_uri() . '/css/normalize.css' );
    wp_enqueue_style( 'style2', get_stylesheet_uri() );
    wp_enqueue_style( 'style3', get_template_directory_uri() . '/css/media.css' );
    wp_enqueue_style( 'style4', get_template_directory_uri() . '/libs/flex_css/flex.css' );
    wp_enqueue_style( 'style5', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.css' );
    wp_enqueue_style( 'style6', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.css' );
    wp_enqueue_style( 'style7', '//use.fontawesome.com/releases/v5.10.2/css/all.css' );
    wp_enqueue_style( 'style8', '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap' );
    wp_enqueue_script( 'script1', '//code.jquery.com/jquery-3.3.1.min.js');
    wp_enqueue_script( 'script2', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.js');
    wp_enqueue_script( 'script3', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.js');
    wp_enqueue_script( 'script4', '//api-maps.yandex.ru/2.1/?apikey=<2044817c-a630-48b1-acf8-5e08fd4884d3>&lang=ru_RU');
    wp_enqueue_script( 'script6', get_template_directory_uri() . '/js/common.js');
}

add_action( 'after_setup_theme', 'stels48_after_setup' );
function stels48_after_setup() {
    register_nav_menu('top-menu', 'Верхнее меню');
    register_nav_menu('footer-menu', 'Меню футера');
}

add_action( 'widgets_init', 'stels48_register_widgets' );
function stels48_register_widgets() {
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

add_filter( 'wp_nav_menu_items', 'stels48_call_back_item', 10, 2 );
function stels48_call_back_item ( $items, $args ) {
    if ( $args->theme_location == 'top-menu' || $args->theme_location == 'footer-menu' ) {
        $items .= '<li><a data-fancybox data-src="#hidden_call_back" href="javascript:;">Обратный звонок</a></li>';
    }
    return $items;
}

add_filter( 'wpcf7_autop_or_not', '__return_false' );
add_filter('wpcf7_form_elements', function($content) {

    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;

});
