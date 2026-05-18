<?php
CSF::createSection($prefix, array(
    'parent' => 'theme_general_options',
    'title'  => __('Basic', 'adking-core'),
    'id'     => 'basic_options',
    'icon'   => 'fab fa-pied-piper-alt fa-fw',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => '<h3>' . __('Basic ', 'adking-core') . '</h3>',
        ),
        array(
            'id'      => 'scrolltop_enable',
            'title'   => __('Scroll Top', 'adking-core'),
            'type'    => 'switcher',
            'desc'    => wp_kses(__('You can set <mark>ON/OFF</mark> to scroll top button', 'adking-core'), wp_kses_allowed_html('post')),
            'default' => true,
        ),
        array(
            'id'      => 'header_sticky_enable',
            'title'   => __('Sticky Header', 'adking-core'),
            'type'    => 'switcher',
            'desc'    => wp_kses(__('You can set <mark>ON/OFF</mark> to sticky Header One & Four', 'adking-core'), wp_kses_allowed_html('post')),
            'default' => true,
        ),
        array(
            'id'      => 'rtl_enable',
            'title'   => __('LRT to RTL Convert', 'adking-core'),
            'type'    => 'switcher',
            'desc'    => wp_kses_post('You can set <mark>ON / OFF</mark> to enable-disable LRT to RTL'),
            'default' => false,
        ),

    ),

));
