<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Hero_Slider_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_hero_slider';
    }

    public function get_title()
    {
        return esc_html__('EG Hero Slider', 'adking-core');
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
        $this->register_cta_controls();
        $this->register_style_controls();
    }

    private function register_content_controls()
    {
        $this->start_controls_section(
            'adking_hero_slider_content',
            [
                'label' => esc_html__('Hero Slider', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_hero_slider_show_section',
            [
                'label'        => esc_html__('Show Section', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_hero_slider_item_media_type',
            [
                'label'   => esc_html__('Background Type', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__('Image', 'adking-core'),
                    'video' => esc_html__('Video', 'adking-core'),
                ],
                'default' => 'image',
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_image',
            [
                'label'     => esc_html__('Background Image', 'adking-core'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'adking_hero_slider_item_media_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_image_alt',
            [
                'label'       => esc_html__('Image Alt Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Hero Slider Image', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_hero_slider_item_media_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_video',
            [
                'label'       => esc_html__('Background Video', 'adking-core'),
                'type'        => Controls_Manager::MEDIA,
                'media_types' => ['video'],
                'condition'   => [
                    'adking_hero_slider_item_media_type' => 'video',
                ],
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_subtitle',
            [
                'label'       => esc_html__('Subtitle', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Energy & Infrastructure', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Advisory for High-Performance Businesses.', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_heading_tag',
            [
                'label'   => esc_html__('Heading Tag', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                ],
                'default' => 'h2',
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_show_button',
            [
                'label'        => esc_html__('Show Button', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_button_text',
            [
                'label'       => esc_html__('Button Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Buy Now', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_hero_slider_item_show_button' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_button_link',
            [
                'label'       => esc_html__('Button Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'adking_hero_slider_item_show_button' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'adking_hero_slider_item_thumb_title',
            [
                'label'       => esc_html__('Thumb Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Energy & infrastructure', 'adking-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'adking_hero_slider_items',
            [
                'label'       => esc_html__('Slides', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_slides(),
                'title_field' => '{{{ adking_hero_slider_item_thumb_title || adking_hero_slider_item_subtitle }}}',
                'condition'   => [
                    'adking_hero_slider_show_section' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_cta_controls()
    {
        $this->start_controls_section(
            'adking_hero_slider_cta_content',
            [
                'label'     => esc_html__('Bottom CTA', 'adking-core'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'adking_hero_slider_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_show_cta',
            [
                'label'        => esc_html__('Show CTA', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_hero_slider_cta_text',
            [
                'label'       => esc_html__('CTA Text', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Let’s move your business forward—together.', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_hero_slider_show_cta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_cta_button_text',
            [
                'label'       => esc_html__('Button Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Contact Us', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_hero_slider_show_cta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_cta_button_link',
            [
                'label'       => esc_html__('Button Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/contact/')),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'adking_hero_slider_show_cta' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_content_style_controls();
        $this->register_slide_button_style_controls();
        $this->register_thumb_style_controls();
        $this->register_cta_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_hero_slider_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_hero_slider_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_hero_slider_style_overlay_background',
                'label'    => esc_html__('Overlay Background', 'adking-core'),
                'selector' => '{{WRAPPER}} .home2-banner-section .banner-warpper .banner-content-wrap',
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_height',
            [
                'label'      => esc_html__('Slide Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 300,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 40,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .banner-warpper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_content_wrap_padding',
            [
                'label'      => esc_html__('Content Wrap Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home2-banner-section .banner-warpper .banner-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_bottom_spacing',
            [
                'label'      => esc_html__('CTA Area Bottom Spacing', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home2-banner-bottom-cta-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_content_style_controls()
    {
        $this->start_controls_section(
            'adking_hero_slider_style_content',
            [
                'label'     => esc_html__('Slide Content', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_hero_slider_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_hero_slider_style_subtitle_typography',
                'selector' => '{{WRAPPER}} .home2-banner-section .banner-title-area > span',
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_subtitle_color',
            [
                'label'     => esc_html__('Subtitle Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .banner-title-area > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_subtitle_dot_color',
            [
                'label'     => esc_html__('Subtitle Dot Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .banner-title-area > span::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_subtitle_margin',
            [
                'label'      => esc_html__('Subtitle Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home2-banner-section .banner-title-area > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_hero_slider_style_title_typography',
                'selector' => '{{WRAPPER}} .home2-banner-section .banner-title-area h1, {{WRAPPER}} .home2-banner-section .banner-title-area h2',
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .banner-title-area h1, {{WRAPPER}} .home2-banner-section .banner-title-area h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_title_max_width',
            [
                'label'      => esc_html__('Title Max Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 300,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .banner-title-area h1, {{WRAPPER}} .home2-banner-section .banner-title-area h2' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_slide_button_style_controls()
    {
        $button = '{{WRAPPER}} .home2-banner-section .banner-title-area .primary-btn1.hover-btn3';

        $this->start_controls_section(
            'adking_hero_slider_style_slide_button',
            [
                'label'     => esc_html__('Slide Button', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_hero_slider_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_hero_slider_style_slide_button_typography',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_slide_button_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'color: {{VALUE}};',
                    $button . ' span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_slide_button_background',
            [
                'label'     => esc_html__('Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_slide_button_hover_color',
            [
                'label'     => esc_html__('Hover Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'color: {{VALUE}};',
                    $button . ':hover span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_slide_button_hover_background',
            [
                'label'     => esc_html__('Hover Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . '::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_hero_slider_style_slide_button_border',
                'selector' => $button,
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_slide_button_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_slide_button_radius',
            [
                'label'      => esc_html__('Border Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_thumb_style_controls()
    {
        $this->start_controls_section(
            'adking_hero_slider_style_thumb',
            [
                'label'     => esc_html__('Thumb Slider', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_hero_slider_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_hero_slider_style_thumb_typography',
                'selector' => '{{WRAPPER}} .home2-banner-section .thumb-content-area .single-slider-text span:not(.slide_progress-bar)',
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_thumb_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .thumb-content-area .single-slider-text span:not(.slide_progress-bar)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_thumb_border_color',
            [
                'label'     => esc_html__('Top Line Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .thumb-content-area::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_thumb_progress_color',
            [
                'label'     => esc_html__('Progress Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .thumb-content-area .single-slider-text .slide_progress-bar::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_thumb_bottom',
            [
                'label'      => esc_html__('Thumb Area Bottom Position', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-section .thumb-content-area' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_cta_style_controls()
    {
        $button = '{{WRAPPER}} .home2-banner-bottom-cta-area .banner-cta-wrap .primary-btn1.animate-btn';

        $this->start_controls_section(
            'adking_hero_slider_style_cta',
            [
                'label'     => esc_html__('Bottom CTA', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_hero_slider_show_section' => 'yes',
                    'adking_hero_slider_show_cta'     => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_hero_slider_style_cta_background',
                'selector' => '{{WRAPPER}} .home2-banner-bottom-cta-area',
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_cta_padding',
            [
                'label'      => esc_html__('CTA Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home2-banner-bottom-cta-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_hero_slider_style_cta_text_typography',
                'selector' => '{{WRAPPER}} .home2-banner-bottom-cta-area .banner-cta-wrap > span',
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_cta_text_color',
            [
                'label'     => esc_html__('CTA Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home2-banner-bottom-cta-area .banner-cta-wrap > span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_hero_slider_style_cta_button_typography',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_cta_button_color',
            [
                'label'     => esc_html__('Button Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_cta_button_background',
            [
                'label'     => esc_html__('Button Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_cta_button_hover_color',
            [
                'label'     => esc_html__('Button Hover Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_hero_slider_style_cta_button_hover_background',
            [
                'label'     => esc_html__('Button Hover Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_hero_slider_style_cta_button_border',
                'selector' => $button,
            ]
        );

        $this->add_responsive_control(
            'adking_hero_slider_style_cta_button_padding',
            [
                'label'      => esc_html__('Button Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_default_slides()
    {
        return [
            [
                'adking_hero_slider_item_media_type'   => 'image',
                'adking_hero_slider_item_image'        => [
                    'url' => $this->get_asset_url('img/home2/home2-banner-img2.jpg'),
                ],
                'adking_hero_slider_item_image_alt'    => esc_html__('Energy and infrastructure', 'adking-core'),
                'adking_hero_slider_item_subtitle'     => esc_html__('energy & Infrastructure', 'adking-core'),
                'adking_hero_slider_item_title'        => esc_html__('Advisory for High-Performance Businesses.', 'adking-core'),
                'adking_hero_slider_item_heading_tag'  => 'h1',
                'adking_hero_slider_item_show_button'  => 'yes',
                'adking_hero_slider_item_button_text'  => esc_html__('*Buy Now*', 'adking-core'),
                'adking_hero_slider_item_button_link'  => [
                    'url' => '#',
                ],
                'adking_hero_slider_item_thumb_title'  => esc_html__('Energy & infrastructure', 'adking-core'),
            ],
            [
                'adking_hero_slider_item_media_type'   => 'image',
                'adking_hero_slider_item_image'        => [
                    'url' => $this->get_asset_url('img/home2/home2-banner-img1.jpg'),
                ],
                'adking_hero_slider_item_image_alt'    => esc_html__('Healthcare and life sciences', 'adking-core'),
                'adking_hero_slider_item_subtitle'     => esc_html__('Healthcare & life sciences', 'adking-core'),
                'adking_hero_slider_item_title'        => esc_html__('Empowering the Future of Medical Innovation.', 'adking-core'),
                'adking_hero_slider_item_heading_tag'  => 'h2',
                'adking_hero_slider_item_show_button'  => 'yes',
                'adking_hero_slider_item_button_text'  => esc_html__('Buy Now', 'adking-core'),
                'adking_hero_slider_item_button_link'  => [
                    'url' => '#',
                ],
                'adking_hero_slider_item_thumb_title'  => esc_html__('Healthcare & life sciences', 'adking-core'),
            ],
            [
                'adking_hero_slider_item_media_type'   => 'video',
                'adking_hero_slider_item_video'        => [
                    'url' => $this->get_asset_url('video/home2-banner-video.mp4'),
                ],
                'adking_hero_slider_item_subtitle'     => esc_html__('Technology & SaaS', 'adking-core'),
                'adking_hero_slider_item_title'        => esc_html__('Accelerating Business Through Smart Tech.', 'adking-core'),
                'adking_hero_slider_item_heading_tag'  => 'h2',
                'adking_hero_slider_item_show_button'  => 'yes',
                'adking_hero_slider_item_button_text'  => esc_html__('Buy Now', 'adking-core'),
                'adking_hero_slider_item_button_link'  => [
                    'url' => '#',
                ],
                'adking_hero_slider_item_thumb_title'  => esc_html__('Technology & SaaS', 'adking-core'),
            ],
            [
                'adking_hero_slider_item_media_type'   => 'image',
                'adking_hero_slider_item_image'        => [
                    'url' => $this->get_asset_url('img/home2/home2-banner-img3.jpg'),
                ],
                'adking_hero_slider_item_image_alt'    => esc_html__('AI agent and automation', 'adking-core'),
                'adking_hero_slider_item_subtitle'     => esc_html__('AI agent & automation', 'adking-core'),
                'adking_hero_slider_item_title'        => esc_html__('Empowering Enterprises with Smart AI Solutions.', 'adking-core'),
                'adking_hero_slider_item_heading_tag'  => 'h2',
                'adking_hero_slider_item_show_button'  => 'yes',
                'adking_hero_slider_item_button_text'  => esc_html__('Buy Now', 'adking-core'),
                'adking_hero_slider_item_button_link'  => [
                    'url' => '#',
                ],
                'adking_hero_slider_item_thumb_title'  => esc_html__('AI agent & automation', 'adking-core'),
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

    private function get_link_attributes($link)
    {
        $attributes = [
            'href' => '#',
        ];

        if (!empty($link['url'])) {
            $attributes['href'] = $link['url'];
        }

        if (!empty($link['is_external'])) {
            $attributes['target'] = '_blank';
        }

        if (!empty($link['nofollow'])) {
            $attributes['rel'] = 'nofollow';
        }

        if (!empty($link['custom_attributes'])) {
            $custom_attributes = Utils::parse_custom_attributes($link['custom_attributes']);

            foreach ($custom_attributes as $attribute => $value) {
                $attributes[$attribute] = $value;
            }
        }

        if (!empty($attributes['target']) && '_blank' === $attributes['target']) {
            $rel = !empty($attributes['rel']) ? $attributes['rel'] . ' ' : '';
            $attributes['rel'] = trim($rel . 'noopener');
        }

        return $attributes;
    }

    private function render_attributes($attributes)
    {
        $rendered_attributes = [];

        foreach ($attributes as $attribute => $value) {
            if ('' === $value || null === $value) {
                continue;
            }

            if ('href' === $attribute || 'src' === $attribute) {
                $value = esc_url($value);
            } else {
                $value = esc_attr($value);
            }

            $rendered_attributes[] = esc_attr($attribute) . '="' . $value . '"';
        }

        return implode(' ', $rendered_attributes);
    }

    private function get_heading_tag($tag)
    {
        return in_array($tag, ['h1', 'h2'], true) ? $tag : 'h2';
    }

    private function render_slide_media($item)
    {
        if (!empty($item['adking_hero_slider_item_media_type']) && 'video' === $item['adking_hero_slider_item_media_type']) {
            $video_url = !empty($item['adking_hero_slider_item_video']['url']) ? $item['adking_hero_slider_item_video']['url'] : $this->get_asset_url('video/home2-banner-video.mp4');
?>
            <video autoplay loop muted playsinline src="<?php echo esc_url($video_url); ?>"></video>
<?php
            return;
        }

        $image = !empty($item['adking_hero_slider_item_image']['url']) ? $item['adking_hero_slider_item_image'] : ['url' => Utils::get_placeholder_image_src()];
        $image_alt = $this->get_media_alt($image, !empty($item['adking_hero_slider_item_image_alt']) ? $item['adking_hero_slider_item_image_alt'] : esc_html__('Hero Slider Image', 'adking-core'));
?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image_alt); ?>">
<?php
    }

    private function render_slide($item)
    {
        $heading_tag = $this->get_heading_tag(!empty($item['adking_hero_slider_item_heading_tag']) ? $item['adking_hero_slider_item_heading_tag'] : 'h2');
        $show_button = !empty($item['adking_hero_slider_item_show_button']) && 'yes' === $item['adking_hero_slider_item_show_button'];
        $button_text = !empty($item['adking_hero_slider_item_button_text']) ? $item['adking_hero_slider_item_button_text'] : '';
?>
        <div class="swiper-slide">
            <div class="banner-warpper">
                <div class="banner-bg">
                    <?php $this->render_slide_media($item); ?>
                </div>
                <div class="banner-content-wrap">
                    <div class="container one">
                        <div class="row">
                            <div class="col-xl-8 col-lg-9">
                                <div class="banner-content">
                                    <div class="banner-title-area">
                                        <?php if (!empty($item['adking_hero_slider_item_subtitle'])) : ?>
                                            <span><?php echo esc_html($item['adking_hero_slider_item_subtitle']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($item['adking_hero_slider_item_title'])) : ?>
                                            <<?php echo esc_attr($heading_tag); ?>><?php echo esc_html($item['adking_hero_slider_item_title']); ?></<?php echo esc_attr($heading_tag); ?>>
                                        <?php endif; ?>
                                        <?php if ($show_button && !empty($button_text)) : ?>
                                            <a <?php echo $this->render_attributes($this->get_link_attributes(!empty($item['adking_hero_slider_item_button_link']) ? $item['adking_hero_slider_item_button_link'] : [])); ?> class="primary-btn1 hover-btn3">
                                                <span><?php echo esc_html($button_text); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['adking_hero_slider_show_section']) || 'yes' !== $settings['adking_hero_slider_show_section']) {
            return;
        }

        $items = !empty($settings['adking_hero_slider_items']) && is_array($settings['adking_hero_slider_items'])
            ? $settings['adking_hero_slider_items']
            : $this->get_default_slides();
?>
        <div class="home2-banner-section">
            <div class="swiper home2-banner-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $item) : ?>
                        <?php $this->render_slide($item); ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="thumb-content-area">
                <div class="container one">
                    <div class="swiper home2-banner-content-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($items as $item) :
                                $thumb_title = !empty($item['adking_hero_slider_item_thumb_title']) ? $item['adking_hero_slider_item_thumb_title'] : (!empty($item['adking_hero_slider_item_subtitle']) ? $item['adking_hero_slider_item_subtitle'] : '');
                            ?>
                                <div class="swiper-slide">
                                    <div class="single-slider-text">
                                        <span class="slide_progress-bar"></span>
                                        <?php if (!empty($thumb_title)) : ?>
                                            <span><?php echo esc_html($thumb_title); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($settings['adking_hero_slider_show_cta']) && 'yes' === $settings['adking_hero_slider_show_cta']) : ?>
            <div class="home2-banner-bottom-cta-area mb-140">
                <div class="container one">
                    <div class="banner-cta-wrap">
                        <?php if (!empty($settings['adking_hero_slider_cta_text'])) : ?>
                            <span><?php echo esc_html($settings['adking_hero_slider_cta_text']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($settings['adking_hero_slider_cta_button_text'])) : ?>
                            <a <?php echo $this->render_attributes($this->get_link_attributes(!empty($settings['adking_hero_slider_cta_button_link']) ? $settings['adking_hero_slider_cta_button_link'] : [])); ?> class="primary-btn1 hover-btn3">
                                <?php echo esc_html($settings['adking_hero_slider_cta_button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Hero_Slider_Widget());
