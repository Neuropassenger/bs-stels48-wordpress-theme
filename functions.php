<?php


add_theme_support( 'post-thumbnails' );

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
    wp_deregister_script( 'jquery-core' );
    wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
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

add_action( 'init', 'stels48_create_reviews_posttype' );
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
            'rewrite' => array('slug' => 'reviews'),
            'supports' => ['title', 'thumbnail']
        )
    );
}

add_action('add_meta_boxes', 'review_fields', 1);
function review_fields() {
    add_meta_box( 'review_fields', 'Отзыв', 'review_fields_box_func', 'reviews', 'normal', 'high'  );
}

// код блока
function review_fields_box_func( $review ){
    ?>
    <p>Текст отзыва:
        <textarea type="text" name="review[text]" style="width:100%;height:100px;"><?php echo get_post_meta($review->ID, 'text', 1); ?></textarea>
    </p>

    <p>Рейтинг:<select name="review[rating]">
            <?php $sel_v = get_post_meta($review->ID, 'rating', 1); ?>
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

add_action( 'save_post', 'review_fields_update', 0 );

## Сохраняем данные, при сохранении поста
function review_fields_update( $post_id ) {
    // базовая проверка
    if (
        empty($_POST['review'])
        || !wp_verify_nonce($_POST['review_fields_nonce'], __FILE__)
        || wp_is_post_autosave($post_id)
        || wp_is_post_revision($post_id)
    )
        return false;

    // Все ОК! Теперь, нужно сохранить/удалить данные
    $_POST['review'] = array_map('sanitize_text_field', $_POST['review']); // чистим все данные от пробелов по краям
    foreach ($_POST['review'] as $key => $value) {
        if (empty($value)) {
            delete_post_meta($post_id, $key); // удаляем поле если значение пустое
            continue;
        }

        update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
    }

    return $post_id;
}
add_action('admin_footer-post.php', 'wph_require_post_elements');
add_action('admin_footer-post-new.php', 'wph_require_post_elements');

function wph_require_post_elements($post) {
    if (get_post_type($post->ID) == 'reviews') {?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#submitpost :submit').on('click.edit-post', function(event) {
                if ( !$('#title').val().length ) {
                    alert( 'Необходимо указать имя автора отзыва в заголовке.');
                    $('#title').focus();
                } else if ( !$('#review_fields textarea').val().length ) {
                    alert( 'Заполните поле текст отзыва');
                    $('#review_fields textarea').focus();
                } else if ( $('#review_fields select').val() == 0 ) {
                    alert( 'Укажите рейтинг');
                    $('#review_fields select').focus();
                } else if ( $('#postimagediv #set-post-thumbnail').text() == 'Set featured image' ) {
                    alert( 'Установите изображение');
                    $('#postimagediv #set-post-thumbnail').focus();
                } else {
                    return true;
                }
                return false;
            });
        });
    </script>
    <?php
}}