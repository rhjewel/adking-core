<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Product_Slider_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_product_slider';
    }

    public function get_title()
    {
        return esc_html__('EG Product Slider', 'adking-core');
    }

    public function get_icon()
    {
        return 'egns-widget-icon';
    }

    public function get_categories()
    {
        return ['adking_widgets'];
    }

    public function get_script_depends()
    {
        return ['jquery', 'swiper'];
    }

    public function get_style_depends()
    {
        return ['swiper'];
    }

    protected function register_controls()
    {
        $this->register_content_controls();
        $this->register_style_controls();
    }

    private function register_content_controls()
    {
        $this->register_header_controls();
        $this->register_query_controls();
        $this->register_slider_controls();
        $this->register_card_controls();
    }

    private function register_header_controls()
    {
        $this->start_controls_section(
            'adking_product_slider_content_header',
            [
                'label' => esc_html__('Header', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_product_slider_show_header',
            [
                'label'        => esc_html__('Show Header', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_product_slider_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Newest Product', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_product_slider_show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_show_navigation',
            [
                'label'        => esc_html__('Show Slider Navigation', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_product_slider_show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_prev_icon',
            [
                'label'   => esc_html__('Previous Icon', 'adking-core'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'bi bi-arrow-left',
                    'library' => 'bootstrap',
                ],
                'condition' => [
                    'adking_product_slider_show_header'     => 'yes',
                    'adking_product_slider_show_navigation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_next_icon',
            [
                'label'   => esc_html__('Next Icon', 'adking-core'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'bi bi-arrow-right',
                    'library' => 'bootstrap',
                ],
                'condition' => [
                    'adking_product_slider_show_header'     => 'yes',
                    'adking_product_slider_show_navigation' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_query_controls()
    {
        $this->start_controls_section(
            'adking_product_slider_content_query',
            [
                'label' => esc_html__('Product Query', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_product_slider_posts_per_page',
            [
                'label'   => esc_html__('Products Per Page', 'adking-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 30,
                'step'    => 1,
                'default' => 8,
            ]
        );

        $this->add_control(
            'adking_product_slider_categories',
            [
                'label'       => esc_html__('Select Categories', 'adking-core'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_product_category_options(),
                'multiple'    => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'adking_product_slider_products',
            [
                'label'       => esc_html__('Select Products', 'adking-core'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_product_options(),
                'multiple'    => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'adking_product_slider_orderby',
            [
                'label'   => esc_html__('Order By', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'ID'         => esc_html__('ID', 'adking-core'),
                    'author'     => esc_html__('Author', 'adking-core'),
                    'title'      => esc_html__('Title', 'adking-core'),
                    'date'       => esc_html__('Date', 'adking-core'),
                    'rand'       => esc_html__('Random', 'adking-core'),
                    'menu_order' => esc_html__('Menu Order', 'adking-core'),
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_order',
            [
                'label'   => esc_html__('Order', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC'  => esc_html__('ASC', 'adking-core'),
                    'DESC' => esc_html__('DESC', 'adking-core'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_slider_controls()
    {
        $this->start_controls_section(
            'adking_product_slider_content_slider',
            [
                'label' => esc_html__('Slider Settings', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_product_slider_slides_desktop',
            [
                'label'   => esc_html__('Desktop Slides', 'adking-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 6,
                'default' => 4,
            ]
        );

        $this->add_control(
            'adking_product_slider_slides_tablet',
            [
                'label'   => esc_html__('Tablet Slides', 'adking-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 4,
                'default' => 2,
            ]
        );

        $this->add_control(
            'adking_product_slider_slides_mobile',
            [
                'label'   => esc_html__('Mobile Slides', 'adking-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 2,
                'default' => 1,
            ]
        );

        $this->add_control(
            'adking_product_slider_space_between',
            [
                'label'   => esc_html__('Space Between', 'adking-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 80,
                'default' => 24,
            ]
        );

        $this->add_control(
            'adking_product_slider_autoplay',
            [
                'label'        => esc_html__('Autoplay', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'adking-core'),
                'label_off'    => esc_html__('No', 'adking-core'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'adking_product_slider_autoplay_delay',
            [
                'label'     => esc_html__('Autoplay Delay', 'adking-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 1000,
                'max'       => 10000,
                'step'      => 500,
                'default'   => 3000,
                'condition' => [
                    'adking_product_slider_autoplay' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_card_controls()
    {
        $this->start_controls_section(
            'adking_product_slider_content_card',
            [
                'label' => esc_html__('Product Card', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_product_slider_show_category',
            [
                'label'        => esc_html__('Show Category', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_product_slider_show_price_label',
            [
                'label'        => esc_html__('Show Price Label', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_product_slider_simple_price_label',
            [
                'label'     => esc_html__('Simple Product Price Label', 'adking-core'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Price :', 'adking-core'),
                'condition' => [
                    'adking_product_slider_show_price_label' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_variable_price_label',
            [
                'label'     => esc_html__('Variable Product Price Label', 'adking-core'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Starting From :', 'adking-core'),
                'condition' => [
                    'adking_product_slider_show_price_label' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_show_rating',
            [
                'label'        => esc_html__('Show Rating', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_product_slider_show_actions',
            [
                'label'        => esc_html__('Show Image Actions', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_product_slider_show_wishlist',
            [
                'label'        => esc_html__('Show Wishlist', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_product_slider_show_actions' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_wishlist_icon',
            [
                'label'     => esc_html__('Wishlist Default Icon', 'adking-core'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'bi bi-heart',
                    'library' => 'bootstrap',
                ],
                'condition' => [
                    'adking_product_slider_show_actions'  => 'yes',
                    'adking_product_slider_show_wishlist' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_wishlist_added_icon',
            [
                'label'     => esc_html__('Wishlist Added Icon', 'adking-core'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'bi bi-heart-fill',
                    'library' => 'bootstrap',
                ],
                'condition' => [
                    'adking_product_slider_show_actions'  => 'yes',
                    'adking_product_slider_show_wishlist' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_show_quick_view',
            [
                'label'        => esc_html__('Show Quick View', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_product_slider_show_actions' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_quick_view_icon',
            [
                'label'     => esc_html__('Quick View Icon', 'adking-core'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'bi bi-eye',
                    'library' => 'bootstrap',
                ],
                'condition' => [
                    'adking_product_slider_show_actions'    => 'yes',
                    'adking_product_slider_show_quick_view' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_show_cart',
            [
                'label'        => esc_html__('Show Add To Cart', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_product_slider_cart_icon',
            [
                'label'     => esc_html__('Cart Icon', 'adking-core'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'bi bi-bag-check',
                    'library' => 'bootstrap',
                ],
                'condition' => [
                    'adking_product_slider_show_cart' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->start_controls_section(
            'adking_product_slider_style_section',
            [
                'label' => esc_html__('Section', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_product_slider_style_section_background',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget.newest-product-section',
            ]
        );

        $this->add_responsive_control(
            'adking_product_slider_style_section_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .adking-product-slider-widget.newest-product-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_product_slider_style_section_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .adking-product-slider-widget.newest-product-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_product_slider_style_header',
            [
                'label'     => esc_html__('Header', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_product_slider_show_header' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_product_slider_style_title_typography',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .section-title h3',
            ]
        );

        $this->add_control(
            'adking_product_slider_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .section-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_title_line_color',
            [
                'label'     => esc_html__('Title Line Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .section-title h3::after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_product_slider_style_navigation',
            [
                'label'     => esc_html__('Slider Navigation', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_product_slider_show_header'     => 'yes',
                    'adking_product_slider_show_navigation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_nav_color',
            [
                'label'     => esc_html__('Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .slider-btn i, {{WRAPPER}} .adking-product-slider-widget .slider-btn svg path' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_nav_background',
            [
                'label'     => esc_html__('Background', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .slider-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_product_slider_style_nav_border',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .slider-btn',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_product_slider_style_card',
            [
                'label' => esc_html__('Product Card', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_product_slider_style_card_background',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .product-card',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_product_slider_style_card_border',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .product-card',
            ]
        );

        $this->add_responsive_control(
            'adking_product_slider_style_image_height',
            [
                'label'      => esc_html__('Image Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 160,
                        'max' => 600,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .product-card-img img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_overlay_background',
            [
                'label'     => esc_html__('Overlay Background', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .overlay' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_product_slider_style_name_typography',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .product-card .product-card-content h6 a',
            ]
        );

        $this->add_control(
            'adking_product_slider_style_name_color',
            [
                'label'     => esc_html__('Product Name Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .product-card-content h6 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_category_color',
            [
                'label'     => esc_html__('Category Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .product-card-content p, {{WRAPPER}} .adking-product-slider-widget .product-card .product-card-content p a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'adking_product_slider_show_category' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_product_slider_style_price_typography',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .product-card .price-and-rating .price, {{WRAPPER}} .adking-product-slider-widget .product-card .price-and-rating .price ins, {{WRAPPER}} .adking-product-slider-widget .product-card .price-and-rating .price bdi',
            ]
        );

        $this->add_control(
            'adking_product_slider_style_price_color',
            [
                'label'     => esc_html__('Price Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .price-and-rating .price, {{WRAPPER}} .adking-product-slider-widget .product-card .price-and-rating .price ins, {{WRAPPER}} .adking-product-slider-widget .product-card .price-and-rating .price bdi' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_rating_color',
            [
                'label'     => esc_html__('Rating Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .rating ul li i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'adking_product_slider_show_rating' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_product_slider_style_actions',
            [
                'label'     => esc_html__('Actions', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_product_slider_show_actions' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_action_color',
            [
                'label'     => esc_html__('Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li a, {{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li a i, {{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li a svg path' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_action_hover_color',
            [
                'label'     => esc_html__('Hover/Added Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li:hover a, {{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li.exists a, {{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li:hover a i, {{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li.exists a i, {{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li:hover a svg path, {{WRAPPER}} .adking-product-slider-widget .view-and-favorite-area ul li.exists a svg path' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_product_slider_style_cart_button',
            [
                'label'     => esc_html__('Add To Cart Button', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_product_slider_show_cart' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_product_slider_style_cart_typography',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .product-card .overlay .cart-area .add-cart-btn',
            ]
        );

        $this->add_control(
            'adking_product_slider_style_cart_color',
            [
                'label'     => esc_html__('Text/Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .overlay .cart-area .add-cart-btn, {{WRAPPER}} .adking-product-slider-widget .product-card .overlay .cart-area .add-cart-btn i, {{WRAPPER}} .adking-product-slider-widget .product-card .overlay .cart-area .add-cart-btn svg path' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_product_slider_style_cart_background',
            [
                'label'     => esc_html__('Background', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .overlay .cart-area .add-cart-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_product_slider_style_cart_border',
                'selector' => '{{WRAPPER}} .adking-product-slider-widget .product-card .overlay .cart-area .add-cart-btn',
            ]
        );

        $this->add_responsive_control(
            'adking_product_slider_style_cart_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .adking-product-slider-widget .product-card .overlay .cart-area .add-cart-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        if (!class_exists('WooCommerce')) {
            return;
        }

        $settings = $this->get_settings_for_display();
        $query = new \WP_Query($this->get_query_args($settings));



        if (!$query->have_posts()) {
            return;
        }

        $this->enqueue_product_slider_assets();
        $widget_id = 'adking-product-slider-' . esc_attr($this->get_id());
        $slider_config = [
            'desktop' => !empty($settings['adking_product_slider_slides_desktop']) ? absint($settings['adking_product_slider_slides_desktop']) : 4,
            'tablet'  => !empty($settings['adking_product_slider_slides_tablet']) ? absint($settings['adking_product_slider_slides_tablet']) : 2,
            'mobile'  => !empty($settings['adking_product_slider_slides_mobile']) ? absint($settings['adking_product_slider_slides_mobile']) : 1,
            'space'   => isset($settings['adking_product_slider_space_between']) ? absint($settings['adking_product_slider_space_between']) : 24,
            'autoplay' => !empty($settings['adking_product_slider_autoplay']) && 'yes' === $settings['adking_product_slider_autoplay'] ? 1 : 0,
            'delay'   => !empty($settings['adking_product_slider_autoplay_delay']) ? absint($settings['adking_product_slider_autoplay_delay']) : 3000,
        ];
?>
        <div
            class="adking-product-slider-widget newest-product-section mb-110"
            id="<?php echo esc_attr($widget_id); ?>"
            data-slides-desktop="<?php echo esc_attr($slider_config['desktop']); ?>"
            data-slides-tablet="<?php echo esc_attr($slider_config['tablet']); ?>"
            data-slides-mobile="<?php echo esc_attr($slider_config['mobile']); ?>"
            data-space="<?php echo esc_attr($slider_config['space']); ?>"
            data-autoplay="<?php echo esc_attr($slider_config['autoplay']); ?>"
            data-delay="<?php echo esc_attr($slider_config['delay']); ?>">
            <div class="container">
                <?php $this->render_header($settings); ?>

                <div class="swiper adking-product-slider-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($query->posts as $post) : ?>
                            <?php
                            $product = wc_get_product($post->ID);
                            if (!$product) {
                                continue;
                            }
                            ?>
                            <div class="swiper-slide">
                                <?php $this->render_product_card($product, $settings); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->render_editor_init_script(); ?>

    <?php
        wp_reset_postdata();
    }

    private function render_header($settings)
    {
        if (empty($settings['adking_product_slider_show_header']) || 'yes' !== $settings['adking_product_slider_show_header']) {
            return;
        }
    ?>
        <div class="section-title style-2">
            <?php if (!empty($settings['adking_product_slider_title'])) : ?>
                <h3><?php echo esc_html($settings['adking_product_slider_title']); ?></h3>
            <?php endif; ?>

            <?php if (!empty($settings['adking_product_slider_show_navigation']) && 'yes' === $settings['adking_product_slider_show_navigation']) : ?>
                <div class="slider-btn-grp">
                    <div class="slider-btn adking-product-slider-prev" role="button" aria-label="<?php echo esc_attr__('Previous products', 'adking-core'); ?>">
                        <?php Icons_Manager::render_icon($settings['adking_product_slider_prev_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                    <div class="slider-btn adking-product-slider-next" role="button" aria-label="<?php echo esc_attr__('Next products', 'adking-core'); ?>">
                        <?php Icons_Manager::render_icon($settings['adking_product_slider_next_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }

    private function render_product_card($product, $settings)
    {
        $product_id = $product->get_id();
        $product_title = $product->get_name();
        $product_permalink = get_permalink($product_id);
        $primary_image = wp_get_attachment_image_url($product->get_image_id(), 'woocommerce_thumbnail');
        $gallery_ids = $product->get_gallery_image_ids();
        $secondary_image = !empty($gallery_ids) ? wp_get_attachment_image_url($gallery_ids[0], 'woocommerce_thumbnail') : '';
        $primary_image = $primary_image ? $primary_image : wc_placeholder_img_src('woocommerce_thumbnail');
        $secondary_image = $secondary_image ? $secondary_image : $primary_image;
        $image_alt = get_post_meta($product->get_image_id(), '_wp_attachment_image_alt', true);
        $image_alt = $image_alt ? $image_alt : $product_title;
        $has_second_image = $secondary_image && $secondary_image !== $primary_image;
    ?>
        <div class="product-card hover-btn">
            <div class="product-card-img<?php echo $has_second_image ? ' double-img' : ''; ?>">
                <a href="<?php echo esc_url($product_permalink); ?>">
                    <img src="<?php echo esc_url($primary_image); ?>" alt="<?php echo esc_attr($image_alt); ?>" <?php echo $has_second_image ? ' class="img1"' : ''; ?>>
                    <?php if ($has_second_image) : ?>
                        <img src="<?php echo esc_url($secondary_image); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="img2">
                    <?php endif; ?>
                </a>

                <?php if (!empty($settings['adking_product_slider_show_cart']) && 'yes' === $settings['adking_product_slider_show_cart']) : ?>
                    <div class="overlay">
                        <div class="cart-area">
                            <?php $this->render_add_to_cart($product, $settings); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php $this->render_actions($product, $settings); ?>
            </div>

            <div class="product-card-content">
                <h6><a href="<?php echo esc_url($product_permalink); ?>" class="hover-underline"><?php echo esc_html($product_title); ?></a></h6>
                <?php if (!empty($settings['adking_product_slider_show_category']) && 'yes' === $settings['adking_product_slider_show_category']) : ?>
                    <?php $categories = wc_get_product_category_list($product_id, ', '); ?>
                    <?php if (!empty($categories)) : ?>
                        <p><?php echo wp_kses_post($categories); ?></p>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (!empty($settings['adking_product_slider_show_price_label']) && 'yes' === $settings['adking_product_slider_show_price_label']) : ?>
                    <span><?php echo esc_html($this->get_price_label($product, $settings)); ?></span>
                <?php endif; ?>

                <div class="price-and-rating">
                    <p class="price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
                    <?php if (!empty($settings['adking_product_slider_show_rating']) && 'yes' === $settings['adking_product_slider_show_rating']) : ?>
                        <?php $this->render_rating($product); ?>
                    <?php endif; ?>
                </div>
            </div>
            <span class="for-border"></span>
        </div>
    <?php
    }

    private function render_add_to_cart($product, $settings)
    {
        $classes = [
            'hover-btn3',
            'add-cart-btn',
            'button',
            'product_type_' . $product->get_type(),
        ];

        if ($product->is_purchasable() && $product->is_in_stock()) {
            $classes[] = 'add_to_cart_button';
        }

        if ($product->supports('ajax_add_to_cart')) {
            $classes[] = 'ajax_add_to_cart';
        }
    ?>
        <a
            href="<?php echo esc_url($product->add_to_cart_url()); ?>"
            class="<?php echo esc_attr(implode(' ', array_filter($classes))); ?>"
            data-quantity="1"
            data-product_id="<?php echo esc_attr($product->get_id()); ?>"
            data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
            aria-label="<?php echo esc_attr($product->add_to_cart_description()); ?>"
            rel="nofollow">
            <?php Icons_Manager::render_icon($settings['adking_product_slider_cart_icon'], ['aria-hidden' => 'true']); ?>
            <?php echo esc_html($product->add_to_cart_text()); ?>
        </a>
    <?php
    }

    private function render_actions($product, $settings)
    {
        if (empty($settings['adking_product_slider_show_actions']) || 'yes' !== $settings['adking_product_slider_show_actions']) {
            return;
        }

        $show_wishlist = !empty($settings['adking_product_slider_show_wishlist']) && 'yes' === $settings['adking_product_slider_show_wishlist'];
        $show_quick_view = !empty($settings['adking_product_slider_show_quick_view']) && 'yes' === $settings['adking_product_slider_show_quick_view'];

        if (!$show_wishlist && !$show_quick_view) {
            return;
        }
    ?>
        <div class="view-and-favorite-area">
            <ul>
                <?php if ($show_wishlist) : ?>
                    <li class="wishlist<?php echo $this->is_product_in_wishlist($product->get_id()) ? ' exists' : ''; ?>"><?php $this->render_wishlist_button($product, $settings); ?></li>
                <?php endif; ?>

                <?php if ($show_quick_view) : ?>
                    <li class="quick-view"><?php $this->render_quick_view_button($product, $settings); ?></li>
                <?php endif; ?>
            </ul>
        </div>
    <?php
    }

    private function render_wishlist_button($product, $settings)
    {
        $product_id = $product->get_id();
        $exists = $this->is_product_in_wishlist($product_id);

        if (defined('YITH_WCWL') && function_exists('YITH_WCWL')) {
            $wishlist_url = YITH_WCWL()->get_wishlist_url();
            $button_url = $exists ? $wishlist_url : YITH_WCWL()->get_add_to_wishlist_url($product_id);
            $button_class = $exists ? 'yith-wcwl-wishlistaddedbrowse' : 'add_to_wishlist single_add_to_wishlist';
            $aria_label = $exists ? esc_attr__('Browse wishlist', 'adking-core') : esc_attr__('Add to wishlist', 'adking-core');
        } else {
            $button_url = add_query_arg('add-to-wishlist', $product_id, get_permalink($product_id));
            $button_class = '';
            $aria_label = esc_attr__('Add to wishlist', 'adking-core');
        }
    ?>
        <a
            href="<?php echo esc_url($button_url); ?>"
            class="<?php echo esc_attr($button_class); ?>"
            data-product-id="<?php echo esc_attr($product_id); ?>"
            data-product-type="<?php echo esc_attr($product->get_type()); ?>"
            data-original-product-id="<?php echo esc_attr($product->get_parent_id()); ?>"
            data-title="<?php echo esc_attr($aria_label); ?>"
            aria-label="<?php echo esc_attr($aria_label); ?>"
            rel="nofollow">
            <span class="heart-outline">
                <?php Icons_Manager::render_icon($settings['adking_product_slider_wishlist_icon'], ['aria-hidden' => 'true']); ?>
            </span>
            <span class="heart-filled">
                <?php Icons_Manager::render_icon($settings['adking_product_slider_wishlist_added_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        </a>
    <?php
    }

    private function render_quick_view_button($product, $settings)
    {
        $product_id = $product->get_id();
        $is_quick_view = defined('YITH_WCQV');
    ?>
        <a
            href="<?php echo esc_url($is_quick_view ? '#' : get_permalink($product_id)); ?>"
            class="<?php echo esc_attr($is_quick_view ? 'button yith-wcqv-button' : ''); ?>"
            data-product_id="<?php echo esc_attr($product_id); ?>"
            aria-label="<?php echo esc_attr__('Quick view', 'adking-core'); ?>">
            <?php Icons_Manager::render_icon($settings['adking_product_slider_quick_view_icon'], ['aria-hidden' => 'true']); ?>
        </a>
    <?php
    }

    private function render_rating($product)
    {
        $average = (float) $product->get_average_rating();
        $review_count = (int) $product->get_review_count();
    ?>
        <div class="rating">
            <ul>
                <?php for ($star = 1; $star <= 5; $star++) : ?>
                    <li><i class="bi <?php echo esc_attr($average >= $star ? 'bi-star-fill' : 'bi-star'); ?>"></i></li>
                <?php endfor; ?>
            </ul>
            <span>(<?php echo esc_html($review_count); ?>)</span>
        </div>
    <?php
    }

    private function get_query_args($settings)
    {
        $allowed_orderby = ['ID', 'author', 'title', 'date', 'rand', 'menu_order'];
        $allowed_order = ['ASC', 'DESC'];

        $posts_per_page = !empty($settings['adking_product_slider_posts_per_page']) ? absint($settings['adking_product_slider_posts_per_page']) : 8;
        $posts_per_page = max(1, min(30, $posts_per_page));
        $orderby = !empty($settings['adking_product_slider_orderby']) && in_array($settings['adking_product_slider_orderby'], $allowed_orderby, true) ? $settings['adking_product_slider_orderby'] : 'date';
        $order = !empty($settings['adking_product_slider_order']) && in_array(strtoupper($settings['adking_product_slider_order']), $allowed_order, true) ? strtoupper($settings['adking_product_slider_order']) : 'DESC';

        $args = [
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'posts_per_page'      => $posts_per_page,
            'orderby'             => $orderby,
            'order'               => $order,
            'ignore_sticky_posts' => true,
        ];

        $selected_products = $this->sanitize_id_list($settings['adking_product_slider_products'] ?? []);
        if (!empty($selected_products)) {
            $args['post__in'] = $selected_products;
        }

        $selected_categories = $this->sanitize_id_list($settings['adking_product_slider_categories'] ?? []);
        if (!empty($selected_categories)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $selected_categories,
                ],
            ];
        }

        return $args;
    }

    private function get_product_category_options()
    {
        $options = [];

        if (!taxonomy_exists('product_cat')) {
            return $options;
        }

        $categories = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        ]);

        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->term_id] = $category->name;
            }
        }

        return $options;
    }

    private function get_product_options()
    {
        $options = [];

        if (!post_type_exists('product')) {
            return $options;
        }

        $products = get_posts([
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 100,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        foreach ($products as $product) {
            $options[$product->ID] = $product->post_title;
        }

        return $options;
    }

    private function sanitize_id_list($ids)
    {
        if (empty($ids)) {
            return [];
        }

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $ids = array_map('absint', $ids);

        return array_values(array_filter($ids));
    }

    private function get_price_label($product, $settings)
    {
        if ($product->is_type('variable')) {
            return !empty($settings['adking_product_slider_variable_price_label']) ? $settings['adking_product_slider_variable_price_label'] : esc_html__('Starting From :', 'adking-core');
        }

        return !empty($settings['adking_product_slider_simple_price_label']) ? $settings['adking_product_slider_simple_price_label'] : esc_html__('Price :', 'adking-core');
    }

    private function is_product_in_wishlist($product_id)
    {
        if (function_exists('yith_wcwl_wishlists')) {
            return (bool) yith_wcwl_wishlists()->is_product_in_wishlist($product_id);
        }

        return false;
    }

    private function enqueue_product_slider_assets()
    {
        static $script_added = false;

        if ($script_added) {
            return;
        }

        $script_added = true;
        wp_enqueue_script('jquery');
        wp_enqueue_script('swiper');
        wp_enqueue_style('swiper');

        wp_add_inline_script('swiper', $this->get_product_slider_script());
    }

    private function render_editor_init_script()
    {
        if (!Plugin::$instance->editor->is_edit_mode()) {
            return;
        }
    ?>
        <script>
            <?php echo $this->get_product_slider_script(); ?>
        </script>
<?php
    }

    private function get_product_slider_script()
    {
        return <<<'JS'
            (function($) {
                if (!$) {
                    return;
                }

                if (window.adkingProductSliderReady) {
                    if (window.adkingInitProductSliders) {
                        window.adkingInitProductSliders();
                    }
                    return;
                }

                window.adkingProductSliderReady = true;
                var pendingWishlistButton = null;

                window.adkingInitProductSliders = function() {
                    if (typeof Swiper === 'undefined') {
                        setTimeout(window.adkingInitProductSliders, 150);
                        return;
                    }

                    $('.adking-product-slider-widget').each(function() {
                        var $scope = $(this);
                        var slider = $scope.find('.adking-product-slider-swiper')[0];

                        if (!slider || slider.swiper) {
                            return;
                        }

                        new Swiper(slider, {
                            slidesPerView: parseInt($scope.data('slides-mobile'), 10) || 1,
                            spaceBetween: parseInt($scope.data('space'), 10) || 24,
                            loop: false,
                            autoplay: parseInt($scope.data('autoplay'), 10) ? {
                                delay: parseInt($scope.data('delay'), 10) || 3000,
                                disableOnInteraction: false
                            } : false,
                            navigation: {
                                nextEl: $scope.find('.adking-product-slider-next')[0],
                                prevEl: $scope.find('.adking-product-slider-prev')[0]
                            },
                            breakpoints: {
                                768: {
                                    slidesPerView: parseInt($scope.data('slides-tablet'), 10) || 2
                                },
                                1200: {
                                    slidesPerView: parseInt($scope.data('slides-desktop'), 10) || 4
                                }
                            }
                        });
                    });
                };

                function markWishlistAdded($button) {
                    if (!$button || !$button.length) {
                        return;
                    }

                    var productId = $button.data('product-id') || $button.data('product_id');
                    var $scope = productId
                        ? $('.adking-product-slider-widget .wishlist a[data-product-id="' + productId + '"], .adking-product-slider-widget .wishlist a[data-product_id="' + productId + '"]').closest('.wishlist')
                        : $button.closest('.wishlist');

                    $scope.addClass('exists added');
                    $scope.find('a')
                        .removeClass('add_to_wishlist single_add_to_wishlist')
                        .addClass('yith-wcwl-wishlistaddedbrowse');
                }

                window.adkingInitProductSliders();

                if (window.elementorFrontend && window.elementorFrontend.hooks) {
                    window.elementorFrontend.hooks.addAction('frontend/element_ready/adking_product_slider.default', window.adkingInitProductSliders);
                }

                $(document).on('click', '.adking-product-slider-widget .wishlist a.add_to_wishlist, .adking-product-slider-widget .wishlist a.single_add_to_wishlist', function() {
                    pendingWishlistButton = $(this);
                });

                $(document.body).on('added_to_wishlist', function(event, fragments, cartHash, button) {
                    markWishlistAdded(button ? $(button) : pendingWishlistButton);
                    pendingWishlistButton = null;
                });
            })(window.jQuery);
            JS;
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Product_Slider_Widget());
