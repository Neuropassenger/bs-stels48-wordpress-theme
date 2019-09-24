<?php get_header(); ?>
    <main>
        <section class="a_first_section flex_main flex_wrap flex_jcontent-around" id="a_first_section">
            <div>
                <h1>Велосипеды STELS</h1>
                <p>По самым выгодным ценам на рынке</p>
                <?php echo do_shortcode( '[contact-form-7 id="189" html_id="main_form" html_class="flex_main flex_column"]') ; ?>
            </div>
            <div class="owl-carousel" id="a_main_slider">
                <?php
                $query_for_products = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'nopaging' => true
                );
                $products = new WP_Query( $query_for_products );
                if( $products->have_posts() ) {
                    while( $products->have_posts() ) {
                        $products->the_post(); ?>
                        <div class="a_slide">
                            <p><?php the_title(); ?></p>
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                        <?php
                    } wp_reset_postdata(); // сбрасываем переменную $post
                } else echo 'Адмиминистратор, добавьте товары';
                ?>
            </div>
        </section>
        <section class="a_catalog" id="catalog">
            <div>
                <h2>Каталог</h2>
            </div>
            <div class="a_goods flex_main flex_wrap flex_jcontent-around">
                <?php
                $query_for_products = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    /*'meta_key' => '_custom_post_order',
                    'orderby' => 'meta_value',*/
                    'order' => 'ASC',
                    'nopaging' => true
                );
                $products = new WP_Query( $query_for_products );
                if( $products->have_posts() ) {
                    while( $products->have_posts() ) {
                    $products->the_post();?>
                    <div class="a_position flex_main flex_column flex_jcontent-between">
                        <div>
                            <h4><?php the_title(); ?></h4>
                            <h5><?php
                                $product_id = get_the_ID();
                                $product = wc_get_product( $product_id );
                                echo number_format($product->get_regular_price(), 0, ".", " ");
                                ?> руб.
                            </h5>
                            <div class="img_position"><?php the_post_thumbnail( 'large' ); ?></div>
                            <table>
                                <tr>
                                    <td>Тип рамы</td>
                                    <td><?php echo getAttr( 'frame-type' );?></td>
                                </tr>
                                <tr>
                                    <td>Размер рамы</td>
                                    <td><?php echo getAttr( 'frame-size' );?></td>
                                </tr>
                                <tr>
                                    <td>Размер колес</td>
                                    <td><?php echo getAttr( 'wheel-size' );?></td>
                                </tr>
                                <tr>
                                    <td>Cкоростей</td>
                                    <td><?php echo getAttr( 'count-speed' );?></td>
                                </tr>
                                <tr>
                                    <td>Тип тормозов</td>
                                    <td><?php echo getAttr( 'break-type' );?></td>
                                </tr>
                                <tr>
                                    <td>Цвет</td>
                                    <td><?php echo getAttr( 'colour' );?></td>
                                </tr>
                                <tr>
                                    <td>Обвес</td>
                                    <td><?php echo getAttr( 'attachments' );?></td>
                                </tr>
                                <tr>
                                    <td>Дополнтельно</td>
                                    <td><?php echo getAttr( 'extra' );?></td>
                                </tr>
                            </table>
                        </div>
                        <button class="a_catalog_button" id="navigator_630">заказать</button>
                    </div>
                    <?php
                    } wp_reset_postdata(); // сбрасываем переменную $post
                } else echo 'Адмиминистратор, добавьте товары';
                ?>
            </div>
        </section>
        <section class="a_about" id="aboutus">
            <div>
                <h2><?php echo get_post( 301 )->post_title; ?></h2>
            </div>
            <div class="a_wrap flex_main flex_wrap flex_jcontent-around">
                <?php echo get_the_post_thumbnail( 303 ); ?>
                <div class="a_descrip flex_main flex_column flex_jcontent-around">
                    <h4><?php echo get_post( 303 )->post_title; ?></h4>
                    <?php echo get_post( 303 )->post_content; ?>
                </div>
            </div>
            <div class="a_wrap flex_main flex_wrap flex_row-revers flex_jcontent-around">
                <?php echo get_the_post_thumbnail( 314 ); ?>
                <div class="a_descrip flex_main flex_column flex_jcontent-around">
                    <h4><?php echo get_post( 314 )->post_title; ?></h4>
                    <?php echo get_post( 314 )->post_content; ?>
                </div>
            </div>
            <div class="a_wrap flex_main flex_wrap flex_jcontent-around">
                <?php echo get_the_post_thumbnail( 319 ); ?>
                <div class="a_descrip flex_main flex_column flex_jcontent-around">
                    <h4><?php echo get_post( 319 )->post_title; ?></h4>
                    <?php echo get_post( 319 )->post_content; ?>
                </div>
            </div>
        </section>

        <section class="a_conditions" id="conditions">
            <div  class="flex_main flex_wrap flex_jcontent-between">
                <div class="a_payment">
                    <h2><?php echo get_post( 336 )->post_title; ?></h2>
                    <?php echo get_post( 336 )->post_content; ?>
                </div>
                <div class="a_delivery">
                    <h2><?php echo get_post( 338 )->post_title; ?></h2>
                    <?php echo get_post( 338 )->post_content; ?>
                </div>
            </div>
            <div class="center a_order_wrap">
                <a href="#a_first_section" class="a_order">заказать</a>
            </div>
        </section>
        <section class="a_about_bikes" id="aboutbikes">
            <div>
                <h2><?php echo get_post( 322 )->post_title; ?></h2>
            </div>
            <div class="a_wrap flex_main flex_wrap flex_jcontent-around">
                <?php echo get_the_post_thumbnail( 324 ); ?>
                <div class="a_descrip flex_main flex_column flex_jcontent-around">
                    <h4><?php echo get_post( 324 )->post_title; ?></h4>
                    <?php echo get_post( 324 )->post_content; ?>
                </div>
            </div>
            <div class="a_wrap flex_main flex_wrap flex_row-revers flex_jcontent-around">
                <?php echo get_the_post_thumbnail( 328 ); ?>
                <div class="a_descrip flex_main flex_column flex_jcontent-around">
                    <h4><?php echo get_post( 328 )->post_title; ?></h4>
                    <?php echo get_post( 328 )->post_content; ?>
                </div>
            </div>
            <div class="a_wrap flex_main flex_wrap flex_jcontent-around">
                <?php echo get_the_post_thumbnail( 331 ); ?>
                <div class="a_descrip flex_main flex_column flex_jcontent-around">
                    <h4><?php echo get_post( 331 )->post_title; ?></h4>
                    <?php echo get_post( 331 )->post_content; ?>
                </div>
            </div>
            <div class="center a_order_wrap">
                <a href="#a_first_section" class="a_order">заказать</a>
            </div>
        </section>
        <section class="a_comments" id="comments">
            <h2>Отзывы</h2>
            <div class="owl-carousel" id="a_comments">
                <?php
                $query = new WP_Query( 'post_type=reviews' );
                if( $query->have_posts() ) {
                    while( $query->have_posts() ) {
                        $query->the_post(); ?>
                        <div class="a_one_comment">
                            <?php the_post_thumbnail( array( 115, 115 ) ); ?>
                            <div class="rating">
                                <span style="display: none"><?php echo get_post_meta( get_the_ID(), 'rating' )[0]; ?></span>
                            </div>
                            <p><?php the_content(); ?></p>
                            <b><?php the_title(); ?></b>
                        </div>
                    <?php
                    }
                    wp_reset_postdata(); // сбрасываем переменную $post
                } else echo 'Адмиминистратор добавьте отзывы';
                ?>
            </div>
            <div class="center a_order_wrap">
                <a href="#a_first_section" class="a_order">заказать</a>
            </div>
        </section>
        <section class="a_contacts" id="contacts">
            <h2>Контакты</h2>
            <div class="flex_main flex_wrap flex_jcontent-around">
                <div id="map"></div>
                <div class="a_contacts_info">
                    <?php echo get_post( 306 )->post_content; ?>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>