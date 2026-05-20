<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Contact_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_contact';
    }

    public function get_title()
    {
        return esc_html__('EG Contact', 'adking-core');
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
        $this->register_layout_controls();
        $this->register_info_controls();
        $this->register_map_controls();
        $this->register_form_controls();
    }

    private function register_layout_controls()
    {
        $this->start_controls_section(
            'adking_contact_layout',
            [
                'label' => esc_html__('Layout', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_contact_show_section',
            [
                'label'        => esc_html__('Show Contact Section', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_contact_container',
            [
                'label'     => esc_html__('Container Width', 'adking-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'container'       => esc_html__('Container', 'adking-core'),
                    'container-fluid' => esc_html__('Full Width', 'adking-core'),
                ],
                'default'   => 'container',
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_info_controls()
    {
        $this->start_controls_section(
            'adking_contact_info_content',
            [
                'label'     => esc_html__('Contact Info', 'adking-core'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_show_info',
            [
                'label'        => esc_html__('Show Contact Info', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_contact_info_title',
            [
                'label'       => esc_html__('Info Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Contact Us With Support Line', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_contact_show_info' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_contact_item_type',
            [
                'label'   => esc_html__('Type', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'phone'   => esc_html__('Phone', 'adking-core'),
                    'email'   => esc_html__('Email', 'adking-core'),
                    'address' => esc_html__('Address', 'adking-core'),
                ],
                'default' => 'email',
            ]
        );

        $repeater->add_control(
            'adking_contact_item_title',
            [
                'label'       => esc_html__('Card Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('To Know More', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_contact_item_label',
            [
                'label'       => esc_html__('Label', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Email Now', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_contact_item_value',
            [
                'label'       => esc_html__('Value', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('info@example.com', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_contact_item_link',
            [
                'label'       => esc_html__('Address Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'condition'   => [
                    'adking_contact_item_type' => 'address',
                ],
            ]
        );

        $repeater->add_control(
            'adking_contact_item_icon',
            [
                'label'            => esc_html__('Icon', 'adking-core'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'bi bi-envelope-at',
                    'library' => 'bootstrap',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_items',
            [
                'label'       => esc_html__('Contact Items', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_contacts(),
                'title_field' => '{{{ adking_contact_item_title }}}',
                'condition'   => [
                    'adking_contact_show_info' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_show_service_note',
            [
                'label'        => esc_html__('Show Service Note', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_contact_show_info' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_service_note_label',
            [
                'label'     => esc_html__('Note Label', 'adking-core'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('N:B:', 'adking-core'),
                'condition' => [
                    'adking_contact_show_info'         => 'yes',
                    'adking_contact_show_service_note' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_service_note_text',
            [
                'label'       => esc_html__('Note Text', 'adking-core'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => wp_kses_post(__('Customer support always open at <strong>9 am</strong> to <strong>6 pm</strong> in everyday', 'adking-core')),
                'label_block' => true,
                'condition'   => [
                    'adking_contact_show_info'         => 'yes',
                    'adking_contact_show_service_note' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_map_controls()
    {
        $this->start_controls_section(
            'adking_contact_map_content',
            [
                'label'     => esc_html__('Map', 'adking-core'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_show_map',
            [
                'label'        => esc_html__('Show Map', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_contact_map_title',
            [
                'label'       => esc_html__('Map Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Location Map', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_contact_show_map' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_map_url',
            [
                'label'       => esc_html__('Google Map Embed URL', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.564763185785!2d90.36311167608078!3d23.834071185557615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c14c8682a473%3A0xa6c74743d52adb88!2sEgens%20Lab!5e0!3m2!1sen!2sbd!4v1685535738307!5m2!1sen!2sbd',
                'label_block' => true,
                'condition'   => [
                    'adking_contact_show_map' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_form_controls()
    {
        $this->start_controls_section(
            'adking_contact_form_content',
            [
                'label'     => esc_html__('Inquiry Form', 'adking-core'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_show_form',
            [
                'label'        => esc_html__('Show Form', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_contact_form_title',
            [
                'label'       => esc_html__('Form Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Reach Us Anytime', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_contact_show_form' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_contact_field_type',
            [
                'label'   => esc_html__('Field Type', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'text'     => esc_html__('Text', 'adking-core'),
                    'tel'      => esc_html__('Phone', 'adking-core'),
                    'email'    => esc_html__('Email', 'adking-core'),
                    'textarea' => esc_html__('Textarea', 'adking-core'),
                ],
                'default' => 'text',
            ]
        );

        $repeater->add_control(
            'adking_contact_field_label',
            [
                'label'       => esc_html__('Label', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Full Name*', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_contact_field_name',
            [
                'label'       => esc_html__('Field Name', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'full_name',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_contact_field_placeholder',
            [
                'label'       => esc_html__('Placeholder', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Jackson Mile', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_contact_field_required',
            [
                'label'        => esc_html__('Required', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'adking-core'),
                'label_off'    => esc_html__('No', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'adking_contact_field_column',
            [
                'label'   => esc_html__('Column Width', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'col-md-12' => esc_html__('Full Width', 'adking-core'),
                    'col-md-6'  => esc_html__('Half Width', 'adking-core'),
                ],
                'default' => 'col-md-12',
            ]
        );

        $this->add_control(
            'adking_contact_form_fields',
            [
                'label'       => esc_html__('Form Shortcode', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '[contact-form-7 title="Inquery Form"]',
                'label_block' => true,
                'condition'   => [
                    'adking_contact_show_form' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_title_style_controls();
        $this->register_contact_item_style_controls();
        $this->register_note_style_controls();
        $this->register_map_style_controls();
        $this->register_form_style_controls();
        $this->register_button_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_contact_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_section_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-page' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_row_gap',
            [
                'label'      => esc_html__('Row Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 120,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-page .row' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_title_style_controls()
    {
        $this->start_controls_section(
            'adking_contact_style_titles',
            [
                'label'     => esc_html__('Section Titles', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_contact_style_title_typography',
                'selector' => '{{WRAPPER}} .contact-page .section-title h4',
            ]
        );

        $this->add_control(
            'adking_contact_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .section-title h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_title_margin',
            [
                'label'      => esc_html__('Title Area Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-page .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_contact_item_style_controls()
    {
        $this->start_controls_section(
            'adking_contact_style_items',
            [
                'label'     => esc_html__('Contact Items', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                    'adking_contact_show_info'    => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_item_padding',
            [
                'label'      => esc_html__('Item Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-page .single-contact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_contact_style_item_border',
                'selector' => '{{WRAPPER}} .contact-page .single-contact',
            ]
        );

        $this->add_control(
            'adking_contact_style_item_title_bg',
            [
                'label'     => esc_html__('Floating Title Background', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .title' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_contact_style_item_title_typography',
                'selector' => '{{WRAPPER}} .contact-page .single-contact .title h6',
            ]
        );

        $this->add_control(
            'adking_contact_style_item_title_color',
            [
                'label'     => esc_html__('Floating Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .title h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_item_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .contact-page .single-contact .icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .contact-page .single-contact .icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_item_icon_border_color',
            [
                'label'     => esc_html__('Icon Border Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_item_icon_size',
            [
                'label'      => esc_html__('Icon Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 8,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .contact-page .single-contact .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_contact_style_item_label_typography',
                'selector' => '{{WRAPPER}} .contact-page .single-contact .content span',
            ]
        );

        $this->add_control(
            'adking_contact_style_item_label_color',
            [
                'label'     => esc_html__('Label Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .content span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_contact_style_item_value_typography',
                'selector' => '{{WRAPPER}} .contact-page .single-contact .content h6 a',
            ]
        );

        $this->add_control(
            'adking_contact_style_item_value_color',
            [
                'label'     => esc_html__('Value Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .content h6 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_item_value_hover_color',
            [
                'label'     => esc_html__('Value Hover Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .single-contact .content h6 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_note_style_controls()
    {
        $this->start_controls_section(
            'adking_contact_style_note',
            [
                'label'     => esc_html__('Service Note', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_contact_show_section'      => 'yes',
                    'adking_contact_show_info'         => 'yes',
                    'adking_contact_show_service_note' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_note_label_color',
            [
                'label'     => esc_html__('Label Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .service-available span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_note_text_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .service-available p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_contact_style_note_typography',
                'selector' => '{{WRAPPER}} .contact-page .service-available span, {{WRAPPER}} .contact-page .service-available p',
            ]
        );

        $this->end_controls_section();
    }

    private function register_map_style_controls()
    {
        $this->start_controls_section(
            'adking_contact_style_map',
            [
                'label'     => esc_html__('Map', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                    'adking_contact_show_map'     => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_map_height',
            [
                'label'      => esc_html__('Map Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 120,
                        'max' => 800,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-map iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_map_padding',
            [
                'label'      => esc_html__('Map Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-map' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_form_style_controls()
    {
        $this->start_controls_section(
            'adking_contact_style_form',
            [
                'label'     => esc_html__('Form', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                    'adking_contact_show_form'    => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_contact_style_form_background',
                'selector' => '{{WRAPPER}} .contact-page .inquiry-form',
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_form_padding',
            [
                'label'      => esc_html__('Form Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .contact-page .inquiry-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'adking_contact_style_form_shadow',
                'selector' => '{{WRAPPER}} .contact-page .inquiry-form',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_contact_style_form_label_typography',
                'selector' => '{{WRAPPER}} .contact-page .inquiry-form label',
            ]
        );

        $this->add_control(
            'adking_contact_style_form_label_color',
            [
                'label'     => esc_html__('Label Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .inquiry-form label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_form_field_color',
            [
                'label'     => esc_html__('Field Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .inquiry-form .form-inner input' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .contact-page .inquiry-form .form-inner textarea' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_form_field_background',
            [
                'label'     => esc_html__('Field Background', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-page .inquiry-form .form-inner input' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .contact-page .inquiry-form .form-inner textarea' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_contact_style_form_field_border',
                'selector' => '{{WRAPPER}} .contact-page .inquiry-form .form-inner input, {{WRAPPER}} .contact-page .inquiry-form .form-inner textarea',
            ]
        );

        $this->end_controls_section();
    }

    private function register_button_style_controls()
    {
        $button = '{{WRAPPER}} .contact-page .inquiry-form .form-inner .primary-btn1';

        $this->start_controls_section(
            'adking_contact_style_button',
            [
                'label'     => esc_html__('Button', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_contact_show_section' => 'yes',
                    'adking_contact_show_form'    => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_contact_style_button_typography',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_contact_style_button_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_button_background',
            [
                'label'     => esc_html__('Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_button_hover_color',
            [
                'label'     => esc_html__('Hover Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_contact_style_button_hover_background',
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
                'name'     => 'adking_contact_style_button_border',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_contact_style_button_hover_border_color',
            [
                'label'     => esc_html__('Hover Border Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_contact_style_button_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_default_contacts()
    {
        return [
            [
                'adking_contact_item_type'  => 'email',
                'adking_contact_item_title' => esc_html__('To Know More', 'adking-core'),
                'adking_contact_item_label' => esc_html__('Email Now', 'adking-core'),
                'adking_contact_item_value' => esc_html__('info@example.com', 'adking-core'),
                'adking_contact_item_icon'  => [
                    'value'   => 'bi bi-envelope-at',
                    'library' => 'bootstrap',
                ],
            ],
            [
                'adking_contact_item_type'  => 'address',
                'adking_contact_item_title' => esc_html__('Shop Address', 'adking-core'),
                'adking_contact_item_label' => esc_html__('Location', 'adking-core'),
                'adking_contact_item_value' => esc_html__('Road-03, House-123/124, New York.', 'adking-core'),
                'adking_contact_item_icon'  => [
                    'value'   => 'bi bi-geo-alt',
                    'library' => 'bootstrap',
                ],
            ],
        ];
    }


    private function get_container_class($class)
    {
        return in_array($class, ['container', 'container-fluid'], true) ? $class : 'container';
    }

    private function get_field_type($type)
    {
        return in_array($type, ['text', 'tel', 'email', 'textarea'], true) ? $type : 'text';
    }

    private function get_field_column_class($class)
    {
        return in_array($class, ['col-md-12', 'col-md-6'], true) ? $class : 'col-md-12';
    }

    private function get_contact_href($type, $value, $link = [])
    {
        if ('email' === $type) {
            return 'mailto:' . sanitize_email($value);
        }

        if ('phone' === $type) {
            return 'tel:' . preg_replace('/[^0-9+]/', '', (string) $value);
        }

        return !empty($link['url']) ? esc_url($link['url']) : '';
    }

    private function get_link_target_attrs($link)
    {
        $attrs = [];
        $rel = [];

        if (!empty($link['is_external'])) {
            $attrs[] = 'target="_blank"';
            $rel[] = 'noopener';
        }

        if (!empty($link['nofollow'])) {
            $rel[] = 'nofollow';
        }

        if (!empty($rel)) {
            $attrs[] = 'rel="' . esc_attr(implode(' ', array_unique($rel))) . '"';
        }

        return implode(' ', $attrs);
    }

    private function get_form_action($link)
    {
        return !empty($link['url']) ? esc_url($link['url']) : '';
    }

    private function get_note_allowed_html()
    {
        return [
            'strong' => [],
            'br'     => [],
            'em'     => [],
            'span'   => [
                'class' => true,
            ],
        ];
    }

    private function render_contact_items($settings)
    {
        if (($settings['adking_contact_show_info'] ?? 'yes') !== 'yes') {
            return;
        }

        $contacts = !empty($settings['adking_contact_items']) && is_array($settings['adking_contact_items']) ? $settings['adking_contact_items'] : [];

        foreach ($contacts as $index => $contact) :
            $type = !empty($contact['adking_contact_item_type']) ? $contact['adking_contact_item_type'] : 'email';
            $type = in_array($type, ['phone', 'email', 'address'], true) ? $type : 'email';
            $title = $contact['adking_contact_item_title'] ?? '';
            $label = $contact['adking_contact_item_label'] ?? '';
            $value = $contact['adking_contact_item_value'] ?? '';
            $link = $contact['adking_contact_item_link'] ?? [];
            $href = $this->get_contact_href($type, $value, $link);
            $margin_class = 0 === $index ? ' mb-40' : '';

            if (empty($title) && empty($label) && empty($value)) {
                continue;
            }
?>
            <div class="single-contact<?php echo esc_attr($margin_class); ?>">
                <?php if (!empty($title)) : ?>
                    <div class="title">
                        <h6><?php echo esc_html($title); ?></h6>
                    </div>
                <?php endif; ?>

                <?php if (!empty($contact['adking_contact_item_icon'])) : ?>
                    <div class="icon">
                        <?php Icons_Manager::render_icon($contact['adking_contact_item_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                <?php endif; ?>

                <div class="content">
                    <?php if (!empty($label)) : ?>
                        <span><?php echo esc_html($label); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($value)) : ?>
                        <h6>
                            <?php if (!empty($href)) : ?>
                                <a href="<?php echo esc_url($href); ?>" <?php echo $this->get_link_target_attrs($link); ?>><?php echo esc_html($value); ?></a>
                            <?php else : ?>
                                <a><?php echo esc_html($value); ?></a>
                            <?php endif; ?>
                        </h6>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        endforeach;
    }

    private function render_service_note($settings)
    {
        if (($settings['adking_contact_show_info'] ?? 'yes') !== 'yes' || ($settings['adking_contact_show_service_note'] ?? 'yes') !== 'yes') {
            return;
        }

        $label = $settings['adking_contact_service_note_label'] ?? '';
        $text = $settings['adking_contact_service_note_text'] ?? '';

        if (empty($label) && empty($text)) {
            return;
        }
        ?>
        <div class="service-available">
            <?php if (!empty($label)) : ?>
                <span><?php echo esc_html($label); ?></span>
            <?php endif; ?>
            <?php if (!empty($text)) : ?>
                <p><?php echo wp_kses($text, $this->get_note_allowed_html()); ?></p>
            <?php endif; ?>
        </div>
    <?php
    }

    private function render_map($settings)
    {
        if (($settings['adking_contact_show_map'] ?? 'yes') !== 'yes') {
            return;
        }

        $map_url = $settings['adking_contact_map_url'] ?? '';

        if (empty($map_url)) {
            return;
        }
    ?>
        <div class="contact-map">
            <iframe src="<?php echo esc_url($map_url); ?>" title="<?php echo esc_attr($settings['adking_contact_map_title'] ?? ''); ?>" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    <?php
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (($settings['adking_contact_show_section'] ?? 'yes') !== 'yes') {
            return;
        }

        $container_class = $this->get_container_class($settings['adking_contact_container'] ?? '');
    ?>
        <div class="contact-page">
            <div class="<?php echo esc_attr($container_class); ?>">
                <div class="row g-4">
                    <?php if (($settings['adking_contact_show_info'] ?? 'yes') === 'yes') : ?>
                        <div class="col-lg-5">
                            <?php if (!empty($settings['adking_contact_info_title'])) : ?>
                                <div class="section-title mb-50">
                                    <h4><?php echo esc_html($settings['adking_contact_info_title']); ?></h4>
                                </div>
                            <?php endif; ?>
                            <?php $this->render_contact_items($settings); ?>
                            <?php $this->render_service_note($settings); ?>
                            <?php $this->render_map($settings); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (($settings['adking_contact_show_form'] ?? 'yes') === 'yes') : ?>
                        <div class="col-lg-7">
                            <div class="inquiry-form">
                                <?php if (!empty($settings['adking_contact_form_title'])) : ?>
                                    <div class="section-title mb-20">
                                        <h4><?php echo esc_html($settings['adking_contact_form_title']); ?></h4>
                                    </div>
                                <?php endif; ?>
                                <?php
                                echo do_shortcode($settings['adking_contact_form_fields']);
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Contact_Widget());
