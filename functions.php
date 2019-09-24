<?php

add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', 'stels48_media' );// подключение стилей и скриптов
function stels48_media() {
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
    wp_enqueue_style( 'main', get_stylesheet_uri() );
    wp_enqueue_style( 'adaptiv', get_template_directory_uri() . '/css/media.css' );
    wp_enqueue_style( 'flex', get_template_directory_uri() . '/libs/flex_css/flex.css' );
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.css' );
    wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.css' );
    wp_enqueue_style( 'fontawesome', '//use.fontawesome.com/releases/v5.10.2/css/all.css' );
    wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap' );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/libs/owlcarousel/owl.carousel.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'yandex_map', '//api-maps.yandex.ru/2.1/?apikey=<2044817c-a630-48b1-acf8-5e08fd4884d3>&lang=ru_RU',  array( 'jquery' ) );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/common.js', array( 'jquery' ) );
}

add_action( 'after_setup_theme', 'stels48_after_setup' );//создание меню
function stels48_after_setup() {
    register_nav_menu( 'top-menu', 'Верхнее меню' );
    register_nav_menu( 'footer-menu', 'Меню футера' );
}

add_action( 'widgets_init', 'stels48_register_widgets' );//создание сайдбаров
function stels48_register_widgets() {
    register_sidebar(
        array(
            'name' => "Телефон для Header",
            'id' => 'phone-sidebar',
            'before_widget' => '',
            'after_widget' => '',
            'description' => '',
            'before_title' => '',
            'after_title' => ''
        )
    );

    register_sidebar(
        array(
            'name' => "Текст для footer",
            'id' => 'footer-sidebar',
            'before_widget' => '',
            'after_widget' => '',
            'description' => '',
            'before_title' => '',
            'after_title' => ''
        )
    );
}

add_filter( 'wp_nav_menu_items', 'stels48_call_back_item', 10, 2 );//добавление в меню обратного звонка
function stels48_call_back_item ( $items, $args ) {
    if ( $args->theme_location == 'top-menu' || $args->theme_location == 'footer-menu' )
        $items .= '<li><a data-fancybox data-src="#hidden_call_back" href="javascript:;">Обратный звонок</a></li>';
    return $items;
}

add_filter( 'wpcf7_autop_or_not', '__return_false' );//убираем теги p span br
add_filter('wpcf7_form_elements', function( $content ) {
    $content = preg_replace( '/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content );
    return $content;
});

add_action( 'init', 'stels48_create_reviews_posttype' );//создаем тип стрнаицы "Отзывы"
function stels48_create_reviews_posttype() {
    register_post_type( 'reviews',
        array(
            'labels' => array(
                'name' => __( 'Отзывы' ),
                'singular_name' => __( 'Отзыв' ),
                'add_new_item' => 'Добавить новый отзыв',
                'edit_item' => 'Редактировать отзыв',
                'new_item' => 'Новый отзыв',
                'all_items' => 'Все отзывы'
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'reviews' ),
            'supports' => array( 'title', 'editor', 'thumbnail')
        )
    );
}

add_action( 'add_meta_boxes', 'review_fields', 1 );//добавляем метабокс для отзывов
function review_fields() {
    add_meta_box( 'review_fields', 'Отзыв', 'review_fields_box_func', 'reviews', 'normal', 'high' );
}
function review_fields_box_func( $review ) {
    ?>
    <p>Рейтинг:<select name="rating">
            <?php $sel_v = get_post_meta( $review->ID, 'rating', 1 ); ?>
            <option value="0">----</option>
            <option value="1" <?php selected( $sel_v, '1' )?> >1</option>
            <option value="2" <?php selected( $sel_v, '2' )?> >2</option>
            <option value="3" <?php selected( $sel_v, '3' )?> >3</option>
            <option value="4" <?php selected( $sel_v, '4' )?> >4</option>
            <option value="5" <?php selected( $sel_v, '5' )?> >5</option>
        </select></p>
    <p>Имя автора отзыва введите в поле title</p>
    <input type="hidden" name="review_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

add_action( 'save_post', 'review_fields_update', 0 );//сохраняем метаполе отзывов
function review_fields_update( $post_id ) {
    if (
        empty( $_POST['rating'] )
        || !wp_verify_nonce( $_POST['review_fields_nonce'], __FILE__ )
        || wp_is_post_autosave( $post_id )
        || wp_is_post_revision( $post_id )
    )
        return false;

    update_post_meta( $post_id, 'rating', sanitize_text_field( $_POST['rating'] ) ); // add_post_meta() работает автоматически
    return $post_id;
}

add_action( 'admin_footer-post.php', 'wph_require_post_elements' );//проверка заполнения блоков в отзывах
add_action( 'admin_footer-post-new.php', 'wph_require_post_elements' );
function wph_require_post_elements( $post ) {
    if (get_post_type( $post->ID ) == 'reviews' ) {?>
    <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            $('#submitpost :submit').on('click.edit-post', function( event ) {
                if ( !$( '#title' ).val().length ) {
                    alert( 'Необходимо указать имя автора отзыва в заголовке.');
                    $('#title').focus();
                } else if ( $( 'span.word-count' ).text() == 0 ) {
                    alert( 'Заполните поле текст отзыва' );
                    $( '#review_fields textarea' ).focus();
                } else if ( $( '#review_fields select' ).val() == 0 ) {
                    alert( 'Укажите рейтинг' );
                    $( '#review_fields select' ).focus();
                } else if ( $( '#postimagediv #set-post-thumbnail' ).text() == 'Set featured image' ) {
                    alert( 'Установите изображение' );
                    $( '#postimagediv #set-post-thumbnail' ).focus();
                } else {
                    return true;
                }
                return false;
            });
        });
    </script>
    <?php
}}

function getAttr( $slugField ) {

    global $product;
    $attrs = get_the_terms( $product->id, "pa_{$slugField}" );
    if ( $attrs ) {
        foreach ( $attrs as $value ) {
            if ( $value ) {
                $attrs_arr = $value->to_array();
                if ($slugField == 'colour')
                    $arr_result[] = $attrs_arr[ 'description' ];
                else $arr_result[] = $attrs_arr[ 'name' ];
            }
        }
        return implode( ", ", $arr_result );
    }
    return '';
}//получаем атрибут товара

wpcf7_add_form_tag( 'dynamic_select', 'cf7_select' );//динамический селект для contact form 7
function cf7_select() {
    $for_options = array(
        'post_type'              => array( 'product' ),
        'post_status'            => array( 'publish' ),
        'nopaging'               => true
    );

    $optionsQuery = new WP_Query( $for_options );
    $options = '<option value="" disabled="" selected="" style="display:none;">Модель</option>';
    if( $optionsQuery->have_posts() ) {
        $i = 1;
        while ($optionsQuery->have_posts()) {
            $optionsQuery->the_post();
            $title = trim(get_the_title());
            $options .= '<option model-id="' . $i . '">' . $title . '</option>';
            $i++;
        }
    }
    return '<div class="form_select">
                <select name="model" class="wpcf7-form-control wpcf7-select" aria-invalid="false">' . $options . '</select>
            </div>';
}

add_action( 'add_meta_boxes', 'custom_post_sort' );//произвольная сортировка для продуктов
function custom_post_sort( $post ) {
    add_meta_box( 'custom_post_sort_box', 'Позиция в выдаче', 'custom_post_order', 'product', 'side' );
}
function custom_post_order ( $product ) {
    wp_nonce_field( basename( __FILE__ ), 'custom_post_order_nonce' );
    $current_pos = get_post_meta( $product->ID, '_custom_post_order', true); ?>
    <p>Введите позицию вывода для продукта.</p>
    <p><input type="number" name="pos" value="<?php echo $current_pos; ?>" /></p>
    <?php
}

add_action( 'save_post', 'save_custom_post_order' );//сохраняем метаданные продукта
function save_custom_post_order( $product_id ){
    if ( !isset( $_POST['custom_post_order_nonce'] )
        || !wp_verify_nonce( $_POST['custom_post_order_nonce'], basename( __FILE__ ) ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return;
    }
    if ( ! current_user_can( 'edit_post', $product_id ) ){
        return;
    }
    if ( isset( $_REQUEST['pos'] ) ) {
        update_post_meta( $product_id, '_custom_post_order', sanitize_text_field( $_POST['pos'] ) );
    }
}

add_filter('manage_product_posts_columns' , 'add_pos_product_column', 0);//добавляем колонку позиции в админ панели
function add_pos_product_column( $columns ) {
    $positionForColumn = 2;
    $newColumn = array( 'pos' => 'Position', );
    $arr1 = array_slice( $columns, 0, $positionForColumn );
    $arr2 = array_slice( $columns, $positionForColumn );
    return array_merge($arr1, $newColumn, $arr2);
}

add_action( 'manage_posts_custom_column' , 'custom_post_order_value' , 10 , 2 );//вывод данных в новой колонке
function custom_post_order_value( $column, $post_id ){
    if ($column == 'pos' ){
        echo '<p>' . get_post_meta( $post_id, '_custom_post_order', true) . '</p>';
    }
}

add_action( 'pre_get_posts' , 'custom_post_order_sort' );//вывод постов согласно position
function custom_post_order_sort( $query ) {
    if ( $query->is_main_query() && is_home() ){
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_custom_post_order' );
        $query->set( 'order' , 'ASC' );
    }
}


/*add_filter( 'manage_'.'edit-post'.'_sortable_columns', 'add_views_sortable_column' );//добавляем сортировку новой колонке
function add_views_sortable_column( $sortable_columns ){
    $sortable_columns['views'] = [ 'views_views', false ];
    // false = asc (по умолчанию)
    // true  = desc
    return $sortable_columns;
}

add_action('admin_head', 'add_views_column_css');//добавляем ширину
function add_views_column_css(){
    echo '<style type="text/css">.column-views{ width:10%; }</style>';
}*/