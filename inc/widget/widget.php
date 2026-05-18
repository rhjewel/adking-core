<?php

function adking_core_register_sidebars()
{

    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'adking-core'),
        'id'            => 'shop_sidebar',
        'description'   => esc_html__('This sidebar will apply to your shop archive page', 'adking-core'),
        'before_widget' => '<div id="%1$s" class="single-widgets %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Blog Details', 'adking-core'),
        'id'            => 'blog_dt_sidebar',
        'description'   => esc_html__('This sidebar will apply to your blog single page', 'adking-core'),
        'before_widget' => '<div id="%1$s" class="single-widgets %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'adking_core_register_sidebars');
