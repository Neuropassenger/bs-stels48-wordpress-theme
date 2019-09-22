<footer class="flex_main flex_wrap flex_jcontent-around">
    <?php echo do_shortcode( '[contact-form-7 id="189" html_class="flex_main flex_column" html_id="footer_form"]' ) ; ?>
    <?php wp_nav_menu(
        array(
            'theme_location' => 'footer-menu',
            'container' => 'nav',
            'container_class' => 'a_footer_menu flex_main flex_column smooth-scroll',
            'item-wrap' => '<ul>%3$s</ul>'
        )
    ); ?>
    <?php get_sidebar( 'footer' ); ?>
</footer>
<div style="display: none;" id="hidden_call_back">
    <?php echo do_shortcode( '[contact-form-7 id="514" html_id="call_back_form" html_class="flex_main flex_column"]' ) ; ?>
</div>
<div id="options" style="display: none">
    <option value="" disabled="" selected="" style="display:none;">Модель</option>
    <?php
    $for_options = array(
        'post_type'              => array( 'product' ),
        'post_status'            => array( 'publish' ),
        'nopaging'               => true
    );
    $options = new WP_Query( $for_options );
    if( $options->have_posts() ) {
    while( $options->have_posts() ) {
    $options->the_post(); ?>
    <option><?php trim(the_title()); }}?></option>
</div>
<?php wp_footer(); ?>
</body>
</html>