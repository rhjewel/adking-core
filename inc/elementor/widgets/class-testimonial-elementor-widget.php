<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Testimonial_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_testimonial';
    }

    public function get_title()
    {
        return esc_html__('EG Testimonial', 'adking-core');
    }

    public function get_icon()
    {
        return 'egns-widget-icon';
    }

    public function get_categories()
    {
        return ['adking_widgets'];
    }

    protected function register_controls()
    {
        $this->register_content_controls();
        $this->register_style_controls();
    }

    private function register_content_controls()
    {
        $this->register_header_controls();
        $this->register_slider_controls();
        $this->register_vector_controls();
    }

    private function register_header_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_content_header',
            [
                'label' => esc_html__('Header', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_testimonial_show_header',
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
            'adking_testimonial_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('They Say About Our Product', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_testimonial_show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_show_navigation',
            [
                'label'        => esc_html__('Show Navigation', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_testimonial_show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_prev_icon',
            [
                'label'            => esc_html__('Previous Icon', 'adking-core'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'bi bi-arrow-left',
                    'library' => 'bootstrap',
                ],
                'condition'        => [
                    'adking_testimonial_show_header'     => 'yes',
                    'adking_testimonial_show_navigation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_next_icon',
            [
                'label'            => esc_html__('Next Icon', 'adking-core'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'bi bi-arrow-right',
                    'library' => 'bootstrap',
                ],
                'condition'        => [
                    'adking_testimonial_show_header'     => 'yes',
                    'adking_testimonial_show_navigation' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_slider_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_content_slider',
            [
                'label' => esc_html__('Testimonials', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_testimonial_show_rating',
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
            'adking_testimonial_rating_icon',
            [
                'label'            => esc_html__('Rating Icon', 'adking-core'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'bi bi-star-fill',
                    'library' => 'bootstrap',
                ],
                'condition'        => [
                    'adking_testimonial_show_rating' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_testimonial_item_rating',
            [
                'label'     => esc_html__('Rating', 'adking-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => 5,
                'step'      => 1,
                'default'   => 5,
            ]
        );

        $repeater->add_control(
            'adking_testimonial_item_text',
            [
                'label'       => esc_html__('Testimonial Text', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('I was recommended snaga from a dear friendest onest Gives energy, strength & mostly youm motivationt goint and WOW!!!', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_testimonial_item_author',
            [
                'label'       => esc_html__('Author Name', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Jayden Carter', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_testimonial_item_designation',
            [
                'label'       => esc_html__('Designation', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Manager at Global Business', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_testimonial_item_quote_image',
            [
                'label'   => esc_html__('Quote Logo', 'adking-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => $this->get_asset_url('img/home1/testimonial-logo-img1.svg'),
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_items',
            [
                'label'       => esc_html__('Testimonial Items', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_testimonials(),
                'title_field' => '{{{ adking_testimonial_item_author }}}',
            ]
        );

        $this->add_control(
            'adking_testimonial_show_pagination',
            [
                'label'        => esc_html__('Show Pagination', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    private function register_vector_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_content_vectors',
            [
                'label' => esc_html__('Background Vectors', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_testimonial_show_vectors',
            [
                'label'        => esc_html__('Show Vectors', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_testimonial_vector_top',
            [
                'label'     => esc_html__('Top Right Vector', 'adking-core'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => $this->get_asset_url('img/home1/testimonial-vector-2.png'),
                ],
                'condition' => [
                    'adking_testimonial_show_vectors' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_vector_bottom',
            [
                'label'     => esc_html__('Bottom Left Vector', 'adking-core'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => $this->get_asset_url('img/home1/testimonial-vector-1.png'),
                ],
                'condition' => [
                    'adking_testimonial_show_vectors' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_header_style_controls();
        $this->register_navigation_style_controls();
        $this->register_card_style_controls();
        $this->register_pagination_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_style_section',
            [
                'label' => esc_html__('Section', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_testimonial_style_section_background',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .testimonial-section',
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_section_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_section_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_wrapper_padding',
            [
                'label'      => esc_html__('Slider Wrapper Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-section .testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_header_style_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_style_header',
            [
                'label'     => esc_html__('Header', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_testimonial_show_header' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_header_margin',
            [
                'label'      => esc_html__('Header Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-section .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_testimonial_style_title_typography',
                'selector' => '{{WRAPPER}} .testimonial-section .section-title h3',
            ]
        );

        $this->add_control(
            'adking_testimonial_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-section .section-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_title_line_color',
            [
                'label'     => esc_html__('Title Line Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-section .section-title h3::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_title_line_width',
            [
                'label'      => esc_html__('Title Line Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-section .section-title h3::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_navigation_style_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_style_navigation',
            [
                'label'     => esc_html__('Navigation', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_testimonial_show_header'     => 'yes',
                    'adking_testimonial_show_navigation' => 'yes',
                ],
            ]
        );

        $button = '{{WRAPPER}} .testimonial-section .slider-btn-grp .slider-btn';

        $this->add_control(
            'adking_testimonial_style_navigation_color',
            [
                'label'     => esc_html__('Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ' i' => 'color: {{VALUE}};',
                    $button . ' svg' => 'fill: {{VALUE}};',
                    $button . ' svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_navigation_background',
            [
                'label'     => esc_html__('Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_navigation_border_color',
            [
                'label'     => esc_html__('Border Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_navigation_hover_color',
            [
                'label'     => esc_html__('Hover Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover i' => 'color: {{VALUE}};',
                    $button . ':hover svg' => 'fill: {{VALUE}};',
                    $button . ':hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_navigation_hover_background',
            [
                'label'     => esc_html__('Hover Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_navigation_size',
            [
                'label'      => esc_html__('Button Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 90,
                    ],
                ],
                'selectors'  => [
                    $button => 'min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_navigation_icon_size',
            [
                'label'      => esc_html__('Icon Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 8,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    $button . ' i' => 'font-size: {{SIZE}}{{UNIT}};',
                    $button . ' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_navigation_gap',
            [
                'label'      => esc_html__('Button Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-section .slider-btn-grp' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_card_style_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_style_card',
            [
                'label' => esc_html__('Testimonial Card', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $card = '{{WRAPPER}} .testimonial-section .testimonial-wrapper .testimonial-card';

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_testimonial_style_card_background',
                'types'    => ['classic', 'gradient'],
                'selector' => $card,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_testimonial_style_card_border',
                'selector' => $card,
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_card_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $card => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_card_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $card => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_card_divider_color',
            [
                'label'     => esc_html__('Divider Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $card . '::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_rating_heading',
            [
                'label'     => esc_html__('Rating', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'adking_testimonial_show_rating' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_rating_color',
            [
                'label'     => esc_html__('Rating Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $card . ' .testimonial-card-top ul li i' => 'color: {{VALUE}};',
                    $card . ' .testimonial-card-top ul li svg' => 'fill: {{VALUE}};',
                    $card . ' .testimonial-card-top ul li svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'adking_testimonial_show_rating' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_rating_size',
            [
                'label'      => esc_html__('Rating Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 8,
                        'max' => 40,
                    ],
                ],
                'selectors'  => [
                    $card . ' .testimonial-card-top ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    $card . ' .testimonial-card-top ul li svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'adking_testimonial_show_rating' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_testimonial_style_text_typography',
                'selector' => $card . ' > p',
            ]
        );

        $this->add_control(
            'adking_testimonial_style_text_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $card . ' > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_testimonial_style_author_typography',
                'selector' => $card . ' .testimonial-card-bottom .author-area .author h5',
            ]
        );

        $this->add_control(
            'adking_testimonial_style_author_color',
            [
                'label'     => esc_html__('Author Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $card . ' .testimonial-card-bottom .author-area .author h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_testimonial_style_designation_typography',
                'selector' => $card . ' .testimonial-card-bottom .author-area .author p',
            ]
        );

        $this->add_control(
            'adking_testimonial_style_designation_color',
            [
                'label'     => esc_html__('Designation Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $card . ' .testimonial-card-bottom .author-area .author p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_quote_image_size',
            [
                'label'      => esc_html__('Quote Image Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 120,
                    ],
                ],
                'selectors'  => [
                    $card . ' .testimonial-card-bottom .quote img' => 'min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_pagination_style_controls()
    {
        $this->start_controls_section(
            'adking_testimonial_style_pagination',
            [
                'label'     => esc_html__('Pagination', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_testimonial_show_pagination' => 'yes',
                ],
            ]
        );

        $bullet = '{{WRAPPER}} .testimonial-section .testimonial-wrapper .swiper-pagination2 .swiper-pagination-bullet';

        $this->add_control(
            'adking_testimonial_style_pagination_border_color',
            [
                'label'     => esc_html__('Border Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $bullet => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_testimonial_style_pagination_active_color',
            [
                'label'     => esc_html__('Active Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $bullet . '.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_pagination_size',
            [
                'label'      => esc_html__('Bullet Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 4,
                        'max' => 40,
                    ],
                ],
                'selectors'  => [
                    $bullet => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_testimonial_style_pagination_gap',
            [
                'label'      => esc_html__('Bullet Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-section .testimonial-wrapper .swiper-pagination2' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $items = !empty($settings['adking_testimonial_items']) && is_array($settings['adking_testimonial_items']) ? $settings['adking_testimonial_items'] : [];
?>

        <?php if (is_admin()): ?>
            <script>
                var swiper = new Swiper(".testimonial-slider", {
                    slidesPerView: 1,
                    speed: 1500,
                    spaceBetween: 24,
                    autoplay: {
                        delay: 2500,
                        pauseOnMouseEnter: true,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".testimonial-slider-next",
                        prevEl: ".testimonial-slider-prev",
                    },
                    breakpoints: {
                        280: {
                            slidesPerView: 1,
                        },
                        386: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        576: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 15,
                        },
                        992: {
                            slidesPerView: 2,
                        },
                        1200: {
                            slidesPerView: 3,
                        },
                        1400: {
                            slidesPerView: 3,
                        },
                    },
                });
            </script>
        <?php endif; ?>


        <div class="testimonial-section adking-testimonial-widget">
            <?php $this->render_vectors($settings); ?>

            <?php if (!empty($settings['adking_testimonial_show_header']) && 'yes' === $settings['adking_testimonial_show_header']) : ?>
                <div class="container">
                    <div class="section-title style-3">
                        <?php if (!empty($settings['adking_testimonial_title'])) : ?>
                            <h3><?php echo nl2br(esc_html($settings['adking_testimonial_title'])); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($settings['adking_testimonial_show_navigation']) && 'yes' === $settings['adking_testimonial_show_navigation']) : ?>
                            <div class="slider-btn-grp">
                                <div class="slider-btn testimonial-slider-prev">
                                    <?php Icons_Manager::render_icon($settings['adking_testimonial_prev_icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                                <div class="slider-btn testimonial-slider-next">
                                    <?php Icons_Manager::render_icon($settings['adking_testimonial_next_icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($items)) : ?>
                <div class="container-fluid p-0">
                    <div class="testimonial-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="swiper testimonial-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($items as $item) : ?>
                                            <?php $this->render_testimonial_item($item, $settings); ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($settings['adking_testimonial_show_pagination']) && 'yes' === $settings['adking_testimonial_show_pagination']) : ?>
                            <div class="swiper-pagination2"></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    private function render_vectors($settings)
    {
        if (empty($settings['adking_testimonial_show_vectors']) || 'yes' !== $settings['adking_testimonial_show_vectors']) {
            return;
        }

        $top = !empty($settings['adking_testimonial_vector_top']) && is_array($settings['adking_testimonial_vector_top']) ? $settings['adking_testimonial_vector_top'] : [];
        $bottom = !empty($settings['adking_testimonial_vector_bottom']) && is_array($settings['adking_testimonial_vector_bottom']) ? $settings['adking_testimonial_vector_bottom'] : [];

        if (!empty($top['url'])) : ?>
            <img src="<?php echo esc_url($top['url']); ?>" alt="<?php echo esc_attr($this->get_media_alt($top)); ?>" class="vector3">
        <?php endif;

        if (!empty($bottom['url'])) : ?>
            <img src="<?php echo esc_url($bottom['url']); ?>" alt="<?php echo esc_attr($this->get_media_alt($bottom)); ?>" class="vector4">
        <?php endif;
    }

    private function render_testimonial_item($item, $settings)
    {
        $text = !empty($item['adking_testimonial_item_text']) ? $item['adking_testimonial_item_text'] : '';
        $author = !empty($item['adking_testimonial_item_author']) ? $item['adking_testimonial_item_author'] : '';
        $designation = !empty($item['adking_testimonial_item_designation']) ? $item['adking_testimonial_item_designation'] : '';
        $quote_image = !empty($item['adking_testimonial_item_quote_image']) && is_array($item['adking_testimonial_item_quote_image']) ? $item['adking_testimonial_item_quote_image'] : [];

        if (empty($text) && empty($author) && empty($designation) && empty($quote_image['url'])) {
            return;
        }
        ?>
        <div class="swiper-slide">
            <div class="testimonial-card">
                <?php if (!empty($settings['adking_testimonial_show_rating']) && 'yes' === $settings['adking_testimonial_show_rating']) : ?>
                    <?php $this->render_rating($item, $settings); ?>
                <?php endif; ?>

                <?php if (!empty($text)) : ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>

                <div class="testimonial-card-bottom">
                    <div class="author-area">
                        <div class="author">
                            <?php if (!empty($author)) : ?>
                                <h5><?php echo esc_html($author); ?></h5>
                            <?php endif; ?>
                            <?php if (!empty($designation)) : ?>
                                <p><?php echo esc_html($designation); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (!empty($quote_image['url'])) : ?>
                        <div class="quote">
                            <img src="<?php echo esc_url($quote_image['url']); ?>" alt="<?php echo esc_attr($this->get_media_alt($quote_image, $author)); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    }

    private function render_rating($item, $settings)
    {
        $rating = !empty($item['adking_testimonial_item_rating']) ? absint($item['adking_testimonial_item_rating']) : 5;
        $rating = max(1, min(5, $rating));
        $icon = !empty($settings['adking_testimonial_rating_icon']) ? $settings['adking_testimonial_rating_icon'] : [];
    ?>
        <div class="testimonial-card-top">
            <ul>
                <?php for ($i = 0; $i < $rating; $i++) : ?>
                    <li><?php Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']); ?></li>
                <?php endfor; ?>
            </ul>
        </div>
<?php
    }

    private function get_default_testimonials()
    {
        $text = esc_html__('I was recommended snaga from a dear friendest onest Gives energy, strength & mostly youm motivationt goint and WOW!!! Gives energy, strength & mostlydat youm motivation', 'adking-core');

        return [
            [
                'adking_testimonial_item_rating'      => 5,
                'adking_testimonial_item_text'        => $text,
                'adking_testimonial_item_author'      => esc_html__('Jayden Carter', 'adking-core'),
                'adking_testimonial_item_designation' => esc_html__('Manager at Global Business', 'adking-core'),
                'adking_testimonial_item_quote_image' => ['url' => $this->get_asset_url('img/home1/testimonial-logo-img1.svg')],
            ],
            [
                'adking_testimonial_item_rating'      => 5,
                'adking_testimonial_item_text'        => $text,
                'adking_testimonial_item_author'      => esc_html__('Colton Roman', 'adking-core'),
                'adking_testimonial_item_designation' => esc_html__('Ceo at Global Business', 'adking-core'),
                'adking_testimonial_item_quote_image' => ['url' => $this->get_asset_url('img/home1/testimonial-logo-img2.svg')],
            ],
            [
                'adking_testimonial_item_rating'      => 5,
                'adking_testimonial_item_text'        => $text,
                'adking_testimonial_item_author'      => esc_html__('Lincoln Miles', 'adking-core'),
                'adking_testimonial_item_designation' => esc_html__('Director at Global Business', 'adking-core'),
                'adking_testimonial_item_quote_image' => ['url' => $this->get_asset_url('img/home1/testimonial-logo-img3.svg')],
            ],
            [
                'adking_testimonial_item_rating'      => 5,
                'adking_testimonial_item_text'        => $text,
                'adking_testimonial_item_author'      => esc_html__('Colton Roman', 'adking-core'),
                'adking_testimonial_item_designation' => esc_html__('Ceo at Global Business', 'adking-core'),
                'adking_testimonial_item_quote_image' => ['url' => $this->get_asset_url('img/home1/testimonial-logo-img4.svg')],
            ],
        ];
    }

    private function get_asset_url($path)
    {
        return trailingslashit(get_template_directory_uri()) . 'assets/' . ltrim($path, '/');
    }

    private function get_media_alt($media, $fallback = '')
    {
        if (!empty($media['id'])) {
            $alt = Control_Media::get_image_alt($media);

            if (!empty($alt)) {
                return $alt;
            }
        }

        return $fallback;
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Testimonial_Widget());
