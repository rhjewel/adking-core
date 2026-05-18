<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Footer_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_footer';
    }

    public function get_title()
    {
        return esc_html__('EG Footer', 'adking-core');
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
        $this->register_cta_controls();
        $this->register_menu_controls('one', esc_html__('Menu One', 'adking-core'), esc_html__('Support', 'adking-core'), $this->get_default_menu_one());
        $this->register_menu_controls('two', esc_html__('Menu Two', 'adking-core'), esc_html__('Company', 'adking-core'), $this->get_default_menu_two());
        $this->register_menu_controls('three', esc_html__('Menu Three', 'adking-core'), esc_html__('Category', 'adking-core'), $this->get_default_menu_three());
        $this->register_payment_controls();
        $this->register_bottom_controls();
    }

    private function register_cta_controls()
    {
        $this->start_controls_section(
            'adking_footer_content_cta',
            [
                'label' => esc_html__('CTA Widget', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_footer_cta_show',
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
            'adking_footer_cta_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('want to Take Customize Product off our Shop?', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_footer_cta_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_cta_button_text',
            [
                'label'       => esc_html__('Button Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Order Now', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_footer_cta_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_cta_button_link',
            [
                'label'       => esc_html__('Button Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '',
                ],
                'condition'   => [
                    'adking_footer_cta_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_menu_controls($key, $label, $default_title, $default_items)
    {
        $this->start_controls_section(
            'adking_footer_content_menu_' . $key,
            [
                'label' => $label,
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_footer_menu_' . $key . '_show',
            [
                'label'        => esc_html__('Show Menu', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_footer_menu_' . $key . '_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => $default_title,
                'label_block' => true,
                'condition'   => [
                    'adking_footer_menu_' . $key . '_show' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_footer_menu_item_text',
            [
                'label'       => esc_html__('Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Menu Item', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_footer_menu_item_link',
            [
                'label'       => esc_html__('Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_menu_' . $key . '_items',
            [
                'label'       => esc_html__('Menu Items', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $default_items,
                'title_field' => '{{{ adking_footer_menu_item_text }}}',
                'condition'   => [
                    'adking_footer_menu_' . $key . '_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_payment_controls()
    {
        $this->start_controls_section(
            'adking_footer_content_payment',
            [
                'label' => esc_html__('Payment Widget', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_footer_payment_show',
            [
                'label'        => esc_html__('Show Payment Widget', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_footer_payment_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Payment Gateway', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_footer_payment_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_payment_description',
            [
                'label'       => esc_html__('Description', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Sed vitae elementum elit. Ut sed maur id sem ultricies ultricies.', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_footer_payment_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_payment_label',
            [
                'label'       => esc_html__('Payment Label', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Secured Payment Gateways', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_footer_payment_show' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_footer_payment_image',
            [
                'label'   => esc_html__('Image', 'adking-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'adking_footer_payment_images',
            [
                'label'       => esc_html__('Payment Images', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_payment_images(),
                'title_field' => esc_html__('Payment Image', 'adking-core'),
                'condition'   => [
                    'adking_footer_payment_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_bottom_controls()
    {
        $this->start_controls_section(
            'adking_footer_content_bottom',
            [
                'label' => esc_html__('Footer Bottom', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_footer_bottom_show',
            [
                'label'        => esc_html__('Show Footer Bottom', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_footer_copyright_text',
            [
                'label'       => esc_html__('Copyright Text', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Copyright 2026 AD King | Design By', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_footer_bottom_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_copyright_link_text',
            [
                'label'       => esc_html__('Copyright Link Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Egens Lab', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_footer_bottom_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_copyright_link',
            [
                'label'       => esc_html__('Copyright Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => 'https://www.egenslab.com/',
                ],
                'condition'   => [
                    'adking_footer_bottom_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_logo_show',
            [
                'label'        => esc_html__('Show Logo', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_footer_bottom_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_logo',
            [
                'label'     => esc_html__('Logo', 'adking-core'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => $this->get_asset_url('img/logo.svg'),
                ],
                'condition' => [
                    'adking_footer_bottom_show' => 'yes',
                    'adking_footer_logo_show'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_logo_link',
            [
                'label'       => esc_html__('Logo Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => home_url('/'),
                ],
                'condition'   => [
                    'adking_footer_bottom_show' => 'yes',
                    'adking_footer_logo_show'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_contact_show',
            [
                'label'        => esc_html__('Show Contact', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_footer_bottom_show' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_footer_contact_type',
            [
                'label'   => esc_html__('Type', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'phone' => esc_html__('Phone', 'adking-core'),
                    'email' => esc_html__('Email', 'adking-core'),
                ],
                'default' => 'phone',
            ]
        );

        $repeater->add_control(
            'adking_footer_contact_label',
            [
                'label'       => esc_html__('Label', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('For Inquiry', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_footer_contact_value',
            [
                'label'       => esc_html__('Value', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('2-965-871-8617', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_footer_contact_icon',
            [
                'label'            => esc_html__('Icon', 'adking-core'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'bi bi-telephone',
                    'library' => 'bootstrap',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_contacts',
            [
                'label'       => esc_html__('Contact Items', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_contacts(),
                'title_field' => '{{{ adking_footer_contact_label }}}',
                'condition'   => [
                    'adking_footer_bottom_show'  => 'yes',
                    'adking_footer_contact_show' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_cta_style_controls();
        $this->register_menu_style_controls();
        $this->register_payment_style_controls();
        $this->register_bottom_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_footer_style_section',
            [
                'label' => esc_html__('Footer Section', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_footer_style_background',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .footer-section',
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_top_padding',
            [
                'label'      => esc_html__('Top Area Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .footer-section .footer-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_cta_style_controls()
    {
        $this->start_controls_section(
            'adking_footer_style_cta',
            [
                'label'     => esc_html__('CTA Widget', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_footer_cta_show' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_cta_title_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-top .footer-widget h3',
            ]
        );

        $this->add_control(
            'adking_footer_style_cta_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $button = '{{WRAPPER}} .footer-section .footer-top .footer-widget .primary-btn1';

        $this->add_control(
            'adking_footer_style_cta_button_heading',
            [
                'label'     => esc_html__('Button', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_cta_button_typography',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_footer_style_cta_button_color',
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
            'adking_footer_style_cta_button_background',
            [
                'label'     => esc_html__('Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_style_cta_button_hover_color',
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
            'adking_footer_style_cta_button_hover_background',
            [
                'label'     => esc_html__('Hover Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'background-color: {{VALUE}};',
                    $button . '::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_footer_style_cta_button_border',
                'selector' => $button,
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_cta_button_padding',
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

    private function register_menu_style_controls()
    {
        $this->start_controls_section(
            'adking_footer_style_menu',
            [
                'label' => esc_html__('Menu Widgets', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_menu_title_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-top .footer-widget .widget-title h5',
            ]
        );

        $this->add_control(
            'adking_footer_style_menu_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .widget-title h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_menu_link_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-top .footer-widget .widget-list li a',
            ]
        );

        $this->add_control(
            'adking_footer_style_menu_link_color',
            [
                'label'     => esc_html__('Link Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .widget-list li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_style_menu_link_hover_color',
            [
                'label'     => esc_html__('Link Hover Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .widget-list li:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .widget-list li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_menu_item_spacing',
            [
                'label'      => esc_html__('Item Spacing', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 40,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .widget-list li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_payment_style_controls()
    {
        $this->start_controls_section(
            'adking_footer_style_payment',
            [
                'label'     => esc_html__('Payment Widget', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_footer_payment_show' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_payment_description_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-top .footer-widget > p',
            ]
        );

        $this->add_control(
            'adking_footer_style_payment_description_color',
            [
                'label'     => esc_html__('Description Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_payment_label_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-top .footer-widget .payment-gateway p',
            ]
        );

        $this->add_control(
            'adking_footer_style_payment_label_color',
            [
                'label'     => esc_html__('Label Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .payment-gateway p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_payment_icon_gap',
            [
                'label'      => esc_html__('Image Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .payment-gateway .icons' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_payment_image_width',
            [
                'label'      => esc_html__('Image Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 160,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .footer-section .footer-top .footer-widget .payment-gateway .icons img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_bottom_style_controls()
    {
        $this->start_controls_section(
            'adking_footer_style_bottom',
            [
                'label'     => esc_html__('Footer Bottom', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_footer_bottom_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_style_bottom_border_color',
            [
                'label'     => esc_html__('Border Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-bottom' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_bottom_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .footer-section .footer-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_copyright_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-bottom .footer-left p, {{WRAPPER}} .footer-section .footer-bottom .footer-left p a',
            ]
        );

        $this->add_control(
            'adking_footer_style_copyright_color',
            [
                'label'     => esc_html__('Copyright Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-left p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-left p a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_logo_width',
            [
                'label'      => esc_html__('Logo Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 30,
                        'max' => 260,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'adking_footer_logo_show' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_contact_label_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .content p',
            ]
        );

        $this->add_control(
            'adking_footer_style_contact_label_color',
            [
                'label'     => esc_html__('Contact Label Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_footer_style_contact_value_typography',
                'selector' => '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .content h6 a',
            ]
        );

        $this->add_control(
            'adking_footer_style_contact_value_color',
            [
                'label'     => esc_html__('Contact Value Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .content h6 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_footer_style_contact_icon_color',
            [
                'label'     => esc_html__('Contact Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_footer_style_contact_icon_size',
            [
                'label'      => esc_html__('Contact Icon Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .footer-section .footer-bottom .footer-contact .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <footer class="footer-section style-2 adking-footer-widget">
            <div class="container">
                <div class="footer-top">
                    <div class="row g-lg-4 gy-5 justify-content-center">
                        <?php $this->render_cta($settings); ?>
                        <?php $this->render_menu($settings, 'one', 'col-lg-2 col-md-4 col-sm-6 d-flex justify-content-lg-start justify-content-sm-end'); ?>
                        <?php $this->render_menu($settings, 'two', 'col-lg-2 col-md-4 col-sm-6 d-flex justify-content-lg-center justify-content-md-end'); ?>
                        <?php $this->render_menu($settings, 'three', 'col-lg-2 col-md-4 col-sm-6 d-flex justify-content-lg-center justify-content-md-start justify-content-sm-end'); ?>
                        <?php $this->render_payment($settings); ?>
                    </div>
                </div>
                <?php $this->render_bottom($settings); ?>
            </div>
        </footer>
    <?php
    }

    private function render_cta($settings)
    {
        if (empty($settings['adking_footer_cta_show']) || 'yes' !== $settings['adking_footer_cta_show']) {
            return;
        }

        $title = !empty($settings['adking_footer_cta_title']) ? $settings['adking_footer_cta_title'] : '';
        $button_text = !empty($settings['adking_footer_cta_button_text']) ? $settings['adking_footer_cta_button_text'] : '';
    ?>
        <div class="col-lg-3 col-md-4 col-sm-6 d-flex align-items-center">
            <div class="footer-widget pr-25">
                <?php if (!empty($title)) : ?>
                    <h3><?php echo nl2br(esc_html($title)); ?></h3>
                <?php endif; ?>

                <?php if (!empty($button_text)) : ?>
                    <a class="primary-btn1 hover-btn3" <?php echo $this->get_link_attributes($settings['adking_footer_cta_button_link'] ?? []); ?>>
                        <span><?php echo esc_html($button_text); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }

    private function render_menu($settings, $key, $column_class)
    {
        if (empty($settings['adking_footer_menu_' . $key . '_show']) || 'yes' !== $settings['adking_footer_menu_' . $key . '_show']) {
            return;
        }

        $title = !empty($settings['adking_footer_menu_' . $key . '_title']) ? $settings['adking_footer_menu_' . $key . '_title'] : '';
        $items = !empty($settings['adking_footer_menu_' . $key . '_items']) && is_array($settings['adking_footer_menu_' . $key . '_items']) ? $settings['adking_footer_menu_' . $key . '_items'] : [];
    ?>
        <div class="<?php echo esc_attr($column_class); ?>">
            <div class="footer-widget">
                <?php if (!empty($title)) : ?>
                    <div class="widget-title">
                        <h5><?php echo esc_html($title); ?></h5>
                    </div>
                <?php endif; ?>

                <?php if (!empty($items)) : ?>
                    <ul class="widget-list">
                        <?php foreach ($items as $item) :
                            $text = !empty($item['adking_footer_menu_item_text']) ? $item['adking_footer_menu_item_text'] : '';
                            if (empty($text)) {
                                continue;
                            }
                        ?>
                            <li>
                                <a <?php echo $this->get_link_attributes($item['adking_footer_menu_item_link'] ?? []); ?>>
                                    <?php echo esc_html($text); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }

    private function render_payment($settings)
    {
        if (empty($settings['adking_footer_payment_show']) || 'yes' !== $settings['adking_footer_payment_show']) {
            return;
        }

        $title = !empty($settings['adking_footer_payment_title']) ? $settings['adking_footer_payment_title'] : '';
        $description = !empty($settings['adking_footer_payment_description']) ? $settings['adking_footer_payment_description'] : '';
        $label = !empty($settings['adking_footer_payment_label']) ? $settings['adking_footer_payment_label'] : '';
        $images = !empty($settings['adking_footer_payment_images']) && is_array($settings['adking_footer_payment_images']) ? $settings['adking_footer_payment_images'] : [];
    ?>
        <div class="col-lg-3 col-md-4 col-sm-6 d-flex justify-content-lg-end justify-content-md-center">
            <div class="footer-widget">
                <?php if (!empty($title)) : ?>
                    <div class="widget-title style-2">
                        <h5><?php echo esc_html($title); ?></h5>
                    </div>
                <?php endif; ?>

                <?php if (!empty($description)) : ?>
                    <p><?php echo esc_html($description); ?></p>
                <?php endif; ?>

                <?php if (!empty($label) || !empty($images)) : ?>
                    <div class="payment-gateway">
                        <?php if (!empty($label)) : ?>
                            <p><?php echo esc_html($label); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($images)) : ?>
                            <div class="icons">
                                <?php foreach ($images as $image) :
                                    $media = !empty($image['adking_footer_payment_image']) && is_array($image['adking_footer_payment_image']) ? $image['adking_footer_payment_image'] : [];
                                    $url = !empty($media['url']) ? $media['url'] : '';
                                    if (empty($url)) {
                                        continue;
                                    }
                                    $alt = $this->get_media_alt($media);
                                ?>
                                    <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }

    private function render_bottom($settings)
    {
        if (empty($settings['adking_footer_bottom_show']) || 'yes' !== $settings['adking_footer_bottom_show']) {
            return;
        }
    ?>
        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-12 d-flex flex-md-row flex-column align-items-center justify-content-md-between justify-content-center flex-wrap gap-3">
                    <?php $this->render_copyright($settings); ?>
                    <?php $this->render_logo($settings); ?>
                    <?php $this->render_contacts($settings); ?>
                </div>
            </div>
        </div>
    <?php
    }

    private function render_copyright($settings)
    {
        $text = !empty($settings['adking_footer_copyright_text']) ? $settings['adking_footer_copyright_text'] : '';
        $link_text = !empty($settings['adking_footer_copyright_link_text']) ? $settings['adking_footer_copyright_link_text'] : '';

        if (empty($text) && empty($link_text)) {
            return;
        }
    ?>
        <div class="footer-left">
            <p>
                <?php echo esc_html($text); ?>
                <?php if (!empty($link_text)) : ?>
                    <a <?php echo $this->get_link_attributes($settings['adking_footer_copyright_link'] ?? []); ?>>
                        <?php echo esc_html($link_text); ?>
                    </a>
                <?php endif; ?>
            </p>
        </div>
    <?php
    }

    private function render_logo($settings)
    {
        if (empty($settings['adking_footer_logo_show']) || 'yes' !== $settings['adking_footer_logo_show']) {
            return;
        }

        $logo = !empty($settings['adking_footer_logo']) && is_array($settings['adking_footer_logo']) ? $settings['adking_footer_logo'] : [];
        $url = !empty($logo['url']) ? $logo['url'] : '';

        if (empty($url)) {
            return;
        }
    ?>
        <div class="footer-logo">
            <a <?php echo $this->get_link_attributes($settings['adking_footer_logo_link'] ?? []); ?>>
                <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($this->get_media_alt($logo, get_bloginfo('name'))); ?>">
            </a>
        </div>
        <?php
    }

    private function render_contacts($settings)
    {
        if (empty($settings['adking_footer_contact_show']) || 'yes' !== $settings['adking_footer_contact_show']) {
            return;
        }

        $contacts = !empty($settings['adking_footer_contacts']) && is_array($settings['adking_footer_contacts']) ? $settings['adking_footer_contacts'] : [];

        foreach ($contacts as $contact) :
            $type = !empty($contact['adking_footer_contact_type']) && 'email' === $contact['adking_footer_contact_type'] ? 'email' : 'phone';
            $label = !empty($contact['adking_footer_contact_label']) ? $contact['adking_footer_contact_label'] : '';
            $value = !empty($contact['adking_footer_contact_value']) ? $contact['adking_footer_contact_value'] : '';
            $href = $this->get_contact_href($type, $value);

            if (empty($label) && empty($value)) {
                continue;
            }
        ?>
            <div class="footer-contact">
                <?php if (!empty($contact['adking_footer_contact_icon'])) : ?>
                    <div class="icon">
                        <?php Icons_Manager::render_icon($contact['adking_footer_contact_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                <?php endif; ?>
                <div class="content">
                    <?php if (!empty($label)) : ?>
                        <p><?php echo esc_html($label); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($value)) : ?>
                        <h6><a href="<?php echo esc_url($href); ?>"><?php echo esc_html($value); ?></a></h6>
                    <?php endif; ?>
                </div>
            </div>
<?php
        endforeach;
    }

    private function get_link_attributes($link, $fallback = '#')
    {
        $url = !empty($link['url']) ? $link['url'] : $fallback;
        $attributes = [
            'href="' . esc_url($url) . '"',
        ];

        if (!empty($link['is_external'])) {
            $attributes[] = 'target="_blank"';
        }

        if (!empty($link['nofollow'])) {
            $attributes[] = 'rel="noopener nofollow"';
        } elseif (!empty($link['is_external'])) {
            $attributes[] = 'rel="noopener"';
        }

        return implode(' ', $attributes);
    }

    private function get_contact_href($type, $value)
    {
        if ('email' === $type) {
            return 'mailto:' . sanitize_email($value);
        }

        return 'tel:' . preg_replace('/[^0-9+]/', '', (string) $value);
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

    private function get_asset_url($path)
    {
        return trailingslashit(get_template_directory_uri()) . 'assets/' . ltrim($path, '/');
    }

    private function get_default_menu_one()
    {
        return [
            [
                'adking_footer_menu_item_text' => esc_html__('Help & Contact Us', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Return & Refunds', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Online Stores', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Privacy Policy', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Profile', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
        ];
    }

    private function get_default_menu_two()
    {
        return [
            [
                'adking_footer_menu_item_text' => esc_html__('What we do', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Gift Offers', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Latest Posts', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('F.A.Q', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Our Brand', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
        ];
    }

    private function get_default_menu_three()
    {
        return [
            [
                'adking_footer_menu_item_text' => esc_html__('Bath & Body', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Skin Care', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Hair Care', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Kids & Baby', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
            [
                'adking_footer_menu_item_text' => esc_html__('Fragrance', 'adking-core'),
                'adking_footer_menu_item_link' => ['url' => '#'],
            ],
        ];
    }

    private function get_default_payment_images()
    {
        return [
            [
                'adking_footer_payment_image' => ['url' => $this->get_asset_url('img/home1/bkash.png')],
            ],
            [
                'adking_footer_payment_image' => ['url' => $this->get_asset_url('img/home1/nagod.png')],
            ],
            [
                'adking_footer_payment_image' => ['url' => $this->get_asset_url('img/home1/rocket.png')],
            ],
            [
                'adking_footer_payment_image' => ['url' => $this->get_asset_url('img/home1/ssl.png')],
            ],
        ];
    }

    private function get_default_contacts()
    {
        return [
            [
                'adking_footer_contact_type'  => 'phone',
                'adking_footer_contact_label' => esc_html__('For Inquiry', 'adking-core'),
                'adking_footer_contact_value' => esc_html__('2-965-871-8617', 'adking-core'),
                'adking_footer_contact_icon'  => [
                    'value'   => 'bi bi-telephone',
                    'library' => 'bootstrap',
                ],
            ],
        ];
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Footer_Widget());
