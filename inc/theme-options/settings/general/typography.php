<?php
CSF::createSection($prefix, array(
    'parent' => 'theme_general_options',
    'title'  => esc_html__('Typography', 'adking-core'),
    'id'     => 'typography_options',
    'icon'   => 'fas fa-pen-nib',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__('Typography ', 'adking-core') . '</h3>',
        ),
        // Start Fonts
        array(
            'id'             => 'font_intetight',
            'type'           => 'typography',
            'title'          => esc_html__('Custom Font "Inter Tight"', 'adking-core'),
            'color'          => false,
            'font_size'      => false,
            'text_align'     => false,
            'font_style'     => false,
            'line_height'    => false,
            'letter_spacing' => false,
            'text_transform' => false,
            'preview'        => 'always',
            'desc'           => wp_kses(__("Replace Font <mark>Inter Tight</mark>.", 'adking-core'), wp_kses_allowed_html('post')),
        ),
        array(
            'id'             => 'font_poppins',
            'type'           => 'typography',
            'title'          => esc_html__('Custom Font "Poppins"', 'adking-core'),
            'color'          => false,
            'font_size'      => false,
            'text_align'     => false,
            'font_style'     => false,
            'line_height'    => false,
            'letter_spacing' => false,
            'text_transform' => false,
            'preview'        => 'always',
            'desc'           => wp_kses(__("Replace Font <mark>Poppins</mark>.", 'adking-core'), wp_kses_allowed_html('post')),
        ),
        // End Fonts 

    ),
));
