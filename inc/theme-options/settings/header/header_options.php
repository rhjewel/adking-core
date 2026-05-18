<?php

CSF::createSection($prefix, array(
    'parent' => 'header_options',
    'title'  => esc_html__('Header Options', 'adking-core'),
    'id'     => 'theme_header_style_options',
    'icon'   => 'fab fa-algolia',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__('Look Header', 'adking-core') . '</h3>'
        ),
        array(
            'id'      => 'header_menu_style',
            'type'    => 'image_select',
            'class'   => 'egns_header_select',
            'options' => array(
                'header_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/header-one.png'),
            ),
            'default' => 'header_one',
        ),
        // *************** Header content ***************
        array(
            'id'      => 'header_logo',
            'title'   => esc_html__('Header Logo', 'adking-core'),
            'type'    => 'media',
            'desc'    => wp_kses(__('you can upload <mark>Logo</mark> for header', 'adking-core'), wp_kses_allowed_html('post')),
            'default' => array(
                'url'       => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/logo/logo.svg'),
                'id'        => 'logo_dark',
                'thumbnail' => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/logo/logo.svg'),
                'alt'       => esc_attr('logo'),
                'title'     => esc_html('Logo'),
            ),
        ),
        array(
            'id'      => 'header_mobile_logo',
            'title'   => esc_html__('Header Mobile Logo', 'gofly-core'),
            'type'    => 'media',
            'desc'    => wp_kses(__('you can upload <mark>Mobile Logo</mark> for header', 'gofly-core'), wp_kses_allowed_html('post')),
            'default' => array(
                'url'       => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/logo/logo.svg'),
                'id'        => 'mobile_logo_dark',
                'thumbnail' => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/logo/logo.svg'),
                'alt'       => esc_attr('Dark Mobile-logo'),
                'title'     => esc_html('Logo'),
            ),
        ),
        array(
            'id'               => 'header_logo_dimensions',
            'type'             => 'dimensions',
            'title'            => esc_html__('Set Header Logo Dimensions', 'gofly-core'),
            'output_important' => true,
            'default'          => array(
                'width'  => '160',
                'height' => '',
                'unit'   => 'px',
            ),
            'output' => array(
                'header.style-2 .company-logo img',
                'header .mobile-logo-area .mobile-logo-wrap img',
            ),
        ),

    )
));
