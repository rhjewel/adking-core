<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Button_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_button';
    }

    public function get_title()
    {
        return esc_html__('EG Button', 'adking-core');
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
        $this->start_controls_section(
            'adking_button_content',
            [
                'label' => esc_html__('Content', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_button_style',
            [
                'label'   => esc_html__('Button Style', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'primary_1'             => esc_html__('Primary 1', 'adking-core'),
                    'primary_1_transparent' => esc_html__('Primary 1 Transparent', 'adking-core'),
                    'primary_1_two'         => esc_html__('Primary 1 Two', 'adking-core'),
                    'primary_2'             => esc_html__('Primary 2', 'adking-core'),
                    'primary_2_two'         => esc_html__('Primary 2 Two', 'adking-core'),
                    'primary_3'             => esc_html__('Primary 3', 'adking-core'),
                    'primary_3_two'         => esc_html__('Primary 3 Two', 'adking-core'),
                    'primary_3_white'       => esc_html__('Primary 3 White BG', 'adking-core'),
                    'primary_3_transparent' => esc_html__('Primary 3 Transparent', 'adking-core'),
                    'view_all'              => esc_html__('View All', 'adking-core'),
                    'explore'               => esc_html__('Explore', 'adking-core'),
                    'read_more'             => esc_html__('Read More', 'adking-core'),
                    'download'              => esc_html__('Download', 'adking-core'),
                    'contact'               => esc_html__('Contact', 'adking-core'),
                ],
                'default' => 'primary_3',
            ]
        );

        $this->add_control(
            'adking_button_text',
            [
                'label'       => esc_html__('Button Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Read More', 'adking-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'adking_button_link',
            [
                'label'       => esc_html__('Button Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'adking_button_show_icon',
            [
                'label'        => esc_html__('Show Icon', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_responsive_control(
            'adking_button_alignment',
            [
                'label'     => esc_html__('Alignment', 'adking-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'adking-core'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'adking-core'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'adking-core'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .adking-button-widget' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->start_controls_section(
            'adking_button_style_section',
            [
                'label' => esc_html__('Style', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $button = '{{WRAPPER}} .adking-button-widget .adking-button';

        $this->add_control(
            'adking_button_text_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'color: {{VALUE}};',
                    $button . ' span' => 'color: {{VALUE}};',
                    $button . ' span::before' => 'color: {{VALUE}};',
                    $button . ' svg' => 'fill: {{VALUE}};',
                    $button . ' svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_button_background',
            [
                'label'     => esc_html__('Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_button_hover_text_color',
            [
                'label'     => esc_html__('Hover Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'color: {{VALUE}};',
                    $button . ':hover span' => 'color: {{VALUE}};',
                    $button . ':hover span::before' => 'color: {{VALUE}};',
                    $button . ':hover svg' => 'fill: {{VALUE}};',
                    $button . ':hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_button_hover_background',
            [
                'label'     => esc_html__('Hover Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_button_typography',
                'selector' => $button,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_button_border',
                'selector' => $button,
            ]
        );

        $this->add_responsive_control(
            'adking_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_button_padding',
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
            'adking_button_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_button_icon_size',
            [
                'label'      => esc_html__('Icon Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 60,
                    ],
                ],
                'selectors'  => [
                    $button . ' svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'adking_button_show_icon' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $text = !empty($settings['adking_button_text']) ? $settings['adking_button_text'] : '';

        if (empty($text)) {
            return;
        }

        $style = !empty($settings['adking_button_style']) ? $settings['adking_button_style'] : 'primary_3';
        $link = !empty($settings['adking_button_link']) && is_array($settings['adking_button_link']) ? $settings['adking_button_link'] : ['url' => '#'];
        $show_icon = !empty($settings['adking_button_show_icon']) && 'yes' === $settings['adking_button_show_icon'];
        $classes = $this->get_button_classes($style);

        $this->add_render_attribute('adking_button_link', 'class', $classes);
        $this->add_render_attribute('adking_button_link', 'data-text', $text);

        if (!empty($link['url'])) {
            $this->add_link_attributes('adking_button_link', $link);
        } else {
            $this->add_render_attribute('adking_button_link', 'href', '#');
        }
?>
        <div class="adking-button-widget adking-button-style-<?php echo esc_attr($style); ?>">
            <a <?php $this->print_render_attribute_string('adking_button_link'); ?>>
                <?php $this->render_button_content($style, $text, $show_icon); ?>
            </a>
        </div>
<?php
    }

    private function get_button_classes($style)
    {
        $class_map = [
            'primary_1'             => 'primary-btn1 animate-btn',
            'primary_1_transparent' => 'primary-btn1 transparent animate-btn',
            'primary_1_two'         => 'primary-btn1 two animate-btn',
            'primary_2'             => 'primary-btn2',
            'primary_2_two'         => 'primary-btn2 two',
            'primary_3'             => 'primary-btn3',
            'primary_3_two'         => 'primary-btn3 two',
            'primary_3_white'       => 'primary-btn3 white-bg',
            'primary_3_transparent' => 'primary-btn3 transparent',
            'view_all'              => 'view-all-btn',
            'explore'               => 'explore-btn',
            'read_more'             => 'read-more-btn',
            'download'              => 'download-btn',
            'contact'               => 'contact-btn',
        ];

        $classes = !empty($class_map[$style]) ? $class_map[$style] : $class_map['primary_3'];

        return 'adking-button ' . $classes;
    }

    private function render_button_content($style, $text, $show_icon)
    {
        if (in_array($style, ['primary_1', 'primary_1_transparent', 'primary_1_two'], true)) {
            echo '<span>' . esc_html($text) . '</span>';
            return;
        }

        if (in_array($style, ['primary_3', 'primary_3_two', 'primary_3_white', 'primary_3_transparent'], true)) {
            echo '<span data-text="' . esc_attr($text) . '">' . esc_html($text) . '</span>';
            if ($show_icon) {
                $this->render_arrow_icon();
            }
            return;
        }

        echo '<span>' . esc_html($text) . '</span>';

        if ($show_icon) {
            $this->render_arrow_icon();
        }
    }

    private function render_arrow_icon()
    {
?>
        <svg width="9" height="9" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
            <g>
                <path d="M8 4.5L2 9L2 0L8 4.5Z" />
            </g>
        </svg>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Button_Widget());
