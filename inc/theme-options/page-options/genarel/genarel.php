<?php
/*-----------------------------------
PAGE MENU SECTION
------------------------------------*/
CSF::createSection(
    $prefix,
    array(
        'title'  => esc_html__('Header', 'adking-core'),
        'parent' => 'page_meta_option',
        'fields' => array(
            //Page Header Options
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Header Options', 'adking-core'),
            ),
            array(
                'id'      => 'page_main_header_enable',
                'type'    => 'select',
                'title'   => esc_html__('Main Header', 'adking-core'),
                'desc'    => wp_kses(__('you can enable/disable <mark>Main Header </mark> for header section', 'adking-core'), wp_kses_allowed_html('post')),
                'options' => array(
                    'enable'  => esc_html('Enable'),
                    'disable' => esc_html('Disable'),
                ),
                'default' => 1
            ),
            array(
                'id'      => 'page_header_menu_style',
                'title'   => esc_html__('Select Style', 'adking-core'),
                'type'    => 'image_select',
                'class'   => 'egns_header_select',
                'options' => array(
                    'default'      => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/default.png'),
                    'header_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/header-one.png'),
                ),
                'desc'       => wp_kses(__('you can select <mark>Header Style </mark> for header section', 'adking-core'), wp_kses_allowed_html('post')),
                'default'    => 'default',
                'dependency' => array('page_main_header_enable', '==', 'enable'),
            ),


        ),
    )
);

// Footer Options

CSF::createSection(
    $prefix,
    array(
        'title'  => esc_html__('Footer', 'adking-core'),
        'parent' => 'page_meta_option',
        'fields' => array(
            //Page Footer Options
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Footer Options', 'adking-core'),
            ),

            array(
                'id'      => 'page_main_footer_enable',
                'type'    => 'select',
                'title'   => esc_html__('Main footer', 'adking-core'),
                'desc'    => wp_kses(__('You can enable/disable <mark>Main Footer </mark> for this page', 'adking-core'), wp_kses_allowed_html('post')),
                'options' => array(
                    'enable'  => esc_html('Enable'),
                    'disable' => esc_html('Disable'),
                ),
                'default' => 1
            ),
            array(
                'id'      => 'page_footer_layout',
                'title'   => esc_html__('Select Style', 'adking-core'),
                'type'    => 'image_select',
                'class'   => 'egns_header_select',
                'options' => array(
                    'default'      => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/default.png'),
                    'footer_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/footer/footer-one.png'),
                ),
                'desc'       => wp_kses(__('You can select <mark>Footer Style </mark> for this page', 'adking-core'), wp_kses_allowed_html('post')),
                'default'    => 'default',
                'dependency' => array('page_main_footer_enable', '==', 'enable'),
            ),

        ),
    )
);
