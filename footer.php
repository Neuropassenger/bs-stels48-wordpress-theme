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
<?php wp_footer(); ?>
</body>
</html>