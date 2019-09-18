<!DOCTYPE html>
<html <?php language_attributes();?>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php get_bloginfo('name')?></title>
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
        <nav class="smooth-scroll">
            <?php wp_nav_menu([
                'theme-location' => 'top-menu',
                'container' => null,
                'item-wrap' => '<ul>%3$s</ul>'
            ]); ?>
        </nav>
        <span class="phone"><i class="fas fa-phone"></i><?php get_sidebar('phone'); ?></span>
    </div>
    <div class="burger">
        <a class="menu_btn" href="#">
            <span></span>
        </a>
    </div>
</header>