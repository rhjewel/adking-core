<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Heading_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_heading';
    }

    public function get_title()
    {
        return esc_html__('EG Heading', 'adking-core');
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
            'adking_heading_content',
            [
                'label' => esc_html__('Content', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_heading_style',
            [
                'label'   => esc_html__('Select Style', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'style_one'   => esc_html__('Style One', 'adking-core'),
                    'style_two'   => esc_html__('Style Two', 'adking-core'),
                    'style_three' => esc_html__('Style Three', 'adking-core'),
                    'style_four'  => esc_html__('Style Four', 'adking-core'),
                    'style_five'  => esc_html__('Style Five', 'adking-core'),
                    'style_six'   => esc_html__('Style Six', 'adking-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->add_control(
            'adking_heading_subtitle',
            [
                'label'       => esc_html__('Subtitle / Small Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Adking Firm', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_heading_style!' => ['style_two', 'style_six'],
                ],
            ]
        );

        $this->add_control(
            'adking_heading_title',
            [
                'label'       => esc_html__('Main Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('We help organizations strengthen strategy, improve performance, and achieve measurable growth.', 'adking-core'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'adking_heading_description',
            [
                'label'       => esc_html__('Description', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'adking_heading_alignment',
            [
                'label'        => esc_html__('Alignment', 'adking-core'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
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
                'default'      => 'center',
                'prefix_class' => 'adking-heading-align-',
                'selectors'    => [
                    '{{WRAPPER}} .adking-heading-widget .section-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_heading_button_text',
            [
                'label'       => esc_html__('Button Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('View all chanllenge', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_heading_style' => 'style_four',
                ],
            ]
        );

        $this->add_control(
            'adking_heading_button_link',
            [
                'label'       => esc_html__('Button Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '',
                ],
                'condition'   => [
                    'adking_heading_style' => 'style_four',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->start_controls_section(
            'adking_heading_style_section',
            [
                'label' => esc_html__('Style', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'adking_heading_style_alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .adking-heading-widget .section-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_heading_spacing_heading',
            [
                'label'     => esc_html__('Spacing / Margin / Padding', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'adking_heading_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .adking-heading-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_heading_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .adking-heading-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->register_text_style_controls(
            'adking_heading_subtitle',
            esc_html__('Subtitle Style', 'adking-core'),
            '.section-title > span'
        );

        $this->register_text_style_controls(
            'adking_heading_title',
            esc_html__('Title Style', 'adking-core'),
            '.section-title h2'
        );

        $this->register_text_style_controls(
            'adking_heading_description',
            esc_html__('Description Style', 'adking-core'),
            '.section-title p'
        );

        $this->add_control(
            'adking_heading_button_heading',
            [
                'label'     => esc_html__('Button Style', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'adking_heading_style' => 'style_four',
                ],
            ]
        );

        $this->add_control(
            'adking_heading_button_color',
            [
                'label'     => esc_html__('Button Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-heading-widget .view-all-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .adking-heading-widget .view-all-btn svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .adking-heading-widget .view-all-btn svg path' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'adking_heading_style' => 'style_four',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'adking_heading_button_typography',
                'selector'  => '{{WRAPPER}} .adking-heading-widget .view-all-btn',
                'condition' => [
                    'adking_heading_style' => 'style_four',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_text_style_controls($prefix, $label, $selector)
    {
        $this->add_control(
            $prefix . '_heading',
            [
                'label'     => $label,
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            $prefix . '_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .adking-heading-widget ' . $selector => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => $prefix . '_typography',
                'selector' => '{{WRAPPER}} .adking-heading-widget ' . $selector,
            ]
        );

        $this->add_responsive_control(
            $prefix . '_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .adking-heading-widget ' . $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $prefix . '_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .adking-heading-widget ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $style = !empty($settings['adking_heading_style']) ? $settings['adking_heading_style'] : 'style_one';
        $subtitle = $settings['adking_heading_subtitle'] ?? '';
        $title = $settings['adking_heading_title'] ?? '';
        $description = $settings['adking_heading_description'] ?? '';
        $alignment = $this->get_current_alignment($settings);

        if (empty($subtitle) && empty($title) && empty($description)) {
            return;
        }

        if ('style_four' === $style) {
            $this->render_style_four($settings, $subtitle, $title, $description);
            return;
        }

        if ('style_five' === $style) {
            $this->render_style_five($subtitle, $title, $description);
            return;
        }

        if ('style_six' === $style) {
            $this->render_style_six($title, $description, $alignment);
            return;
        }

        if ('style_three' === $style) {
            $this->render_style_three($subtitle, $title, $description, $alignment);
            return;
        }

        if ('style_two' === $style) {
            $this->render_style_two($title, $description);
            return;
        }

        $this->render_style_one($subtitle, $title, $description, $alignment);
    }

    private function get_current_alignment($settings)
    {
        if (!empty($settings['adking_heading_style_alignment'])) {
            return $settings['adking_heading_style_alignment'];
        }

        return !empty($settings['adking_heading_alignment']) ? $settings['adking_heading_alignment'] : 'center';
    }

    private function get_center_row_class($alignment, $extra_classes = '')
    {
        $classes = ['row'];

        if ('center' === $alignment) {
            $classes[] = 'justify-content-center';
        }

        if (!empty($extra_classes)) {
            $classes = array_merge($classes, explode(' ', $extra_classes));
        }

        return implode(' ', array_filter($classes));
    }

    private function render_style_one($subtitle, $title, $description, $alignment)
    {
?>
        <div class="adking-heading-widget adking-heading-style-one">
            <div class="container one">
                <div class="<?php echo esc_attr($this->get_center_row_class($alignment)); ?>">
                    <div class="col-lg-8">
                        <div class="section-title text-center">
                            <?php $this->render_subtitle($subtitle); ?>
                            <?php $this->render_title($title); ?>
                            <?php $this->render_description($description); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    private function render_style_two($title, $description)
    {
?>
        <div class="adking-heading-widget adking-heading-style-two">
            <div class="container one">
                <div class="section-title two text-center mb-70">
                    <?php if (!empty($title)) : ?>
                        <h2 class="text-anim" data-delay="0.3"><?php echo wp_kses_post($title); ?></h2>
                    <?php endif; ?>
                    <?php $this->render_description($description); ?>
                </div>
            </div>
        </div>
<?php
    }

    private function render_style_three($subtitle, $title, $description, $alignment)
    {
?>
        <div class="adking-heading-widget adking-heading-style-three">
            <div class="container one">
                <div class="<?php echo esc_attr($this->get_center_row_class($alignment, 'mb-60')); ?>">
                    <div class="col-lg-5 col-md-7 col-sm-8">
                        <div class="section-title three text-center">
                            <?php $this->render_subtitle($subtitle); ?>
                            <?php $this->render_title($title); ?>
                            <?php $this->render_description($description); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    private function render_style_four($settings, $subtitle, $title, $description)
    {
        $button_text = $settings['adking_heading_button_text'] ?? '';
        $button_link = $settings['adking_heading_button_link'] ?? [];
        $button_url = !empty($button_link['url']) ? $button_link['url'] : '';

        $this->add_render_attribute('adking_heading_button_link', 'class', 'view-all-btn');

        if (!empty($button_url)) {
            $this->add_link_attributes('adking_heading_button_link', $button_link);
        } else {
            $this->add_render_attribute('adking_heading_button_link', 'href', '#');
        }
?>
        <div class="adking-heading-widget adking-heading-style-four">
            <div class="service-title-area">
                <div class="container one">
                    <div class="row g-4 align-items-md-end justify-content-between">
                        <div class="col-lg-6 col-md-8">
                            <div class="section-title white three">
                                <?php $this->render_subtitle($subtitle); ?>
                                <?php $this->render_title($title); ?>
                                <?php $this->render_description($description); ?>
                            </div>
                        </div>
                        <?php if (!empty($button_text)) : ?>
                            <div class="col-lg-3 col-md-4 d-flex justify-content-md-end">
                                <a <?php $this->print_render_attribute_string('adking_heading_button_link'); ?>>
                                    <span><?php echo esc_html($button_text); ?></span>
                                    <svg width="9" height="9" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="M8 4.5L2 9L2 0L8 4.5Z" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    private function render_style_five($subtitle, $title, $description)
    {
?>
        <div class="adking-heading-widget adking-heading-style-five">
            <div class="container one">
                <div class="row mb-60">
                    <div class="col-xl-10 col-lg-10 col-md-9">
                        <div class="section-title three">
                            <?php $this->render_subtitle($subtitle); ?>
                            <?php $this->render_title($title); ?>
                            <?php $this->render_description($description); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    private function render_style_six($title, $description, $alignment)
    {
?>
        <div class="adking-heading-widget adking-heading-style-six">
            <div class="container one">
                <div class="<?php echo esc_attr($this->get_center_row_class($alignment, 'mb-60')); ?>">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="section-title three text-center">
                            <?php $this->render_title($title); ?>
                            <?php if (!empty($description)) : ?>
                                <p class="fade_anim" data-delay=".2"><?php echo wp_kses_post($description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    private function render_subtitle($subtitle)
    {
        if (empty($subtitle)) {
            return;
        }
?>
        <span class="text-anim"><?php echo esc_html($subtitle); ?></span>
<?php
    }

    private function render_title($title)
    {
        if (empty($title)) {
            return;
        }
?>
        <h2 class="text-anim"><?php echo wp_kses_post($title); ?></h2>
<?php
    }

    private function render_description($description)
    {
        if (empty($description)) {
            return;
        }
?>
        <p><?php echo wp_kses_post($description); ?></p>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Heading_Widget());
