<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
?>
<!DOCTYPE html>
<html <?php language_attributes();?>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name')?></title>
    <meta name="description" content="<?php bloginfo('description') ?>">
    <meta name="author" content="Breakout Studio">
    <?php wp_head(); ?>
</head>
<body>
<header class="flex_main flex_jcontent-between">
    <div class="logo flex_main flex_column flex_jcontent-center">
        <p>stels48</p>
    </div>
    <div class="menu_phone flex_main flex_jcontent-between">
        <?php wp_nav_menu([
            'theme_location' => 'top-menu',
            'container' => 'nav',
            'container_class' => 'smooth-scroll',
            'item-wrap' => '<ul>%3$s</ul>',
            'menu_class' => 'flex_main flex_wrap flex_jcontent-between'
        ]); ?>

        <?php get_sidebar('phone'); ?>
    </div>
    <div class="burger">
        <a class="menu_btn" href="#">
            <span></span>
        </a>
    </div>
</header>
<?php print_r(get_post( 448 )); ?>