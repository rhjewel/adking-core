<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Feature_Banner_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_feature_banner';
    }

    public function get_title()
    {
        return esc_html__('EG Feature Banner', 'adking-core');
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
            'adking_feature_banner_content',
            [
                'label' => esc_html__('Feature Banner', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_feature_banner_show_section',
            [
                'label'        => esc_html__('Show Section', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_feature_banner_container',
            [
                'label'     => esc_html__('Container Width', 'adking-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'container-fluid p-0' => esc_html__('Full Width', 'adking-core'),
                    'container'           => esc_html__('Container', 'adking-core'),
                ],
                'default'   => 'container-fluid p-0',
                'condition' => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_feature_banner_columns',
            [
                'label'     => esc_html__('Columns', 'adking-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '4' => esc_html__('4 Columns', 'adking-core'),
                    '3' => esc_html__('3 Columns', 'adking-core'),
                    '2' => esc_html__('2 Columns', 'adking-core'),
                    '1' => esc_html__('1 Column', 'adking-core'),
                ],
                'default'   => '4',
                'condition' => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_feature_banner_item_icon',
            [
                'label'            => esc_html__('Icon', 'adking-core'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'bi bi-truck',
                    'library' => 'bootstrap',
                ],
            ]
        );

        $repeater->add_control(
            'adking_feature_banner_item_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Fast Delivery', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_feature_banner_item_description',
            [
                'label'       => esc_html__('Description', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Delivery in 24 hours max!', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_feature_banner_item_link',
            [
                'label'       => esc_html__('Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
            ]
        );

        $repeater->add_control(
            'adking_feature_banner_item_show_divider',
            [
                'label'        => esc_html__('Show Divider', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_feature_banner_items',
            [
                'label'       => esc_html__('Feature Items', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_items(),
                'title_field' => '{{{ adking_feature_banner_item_title }}}',
                'condition'   => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_item_style_controls();
        $this->register_icon_style_controls();
        $this->register_content_style_controls();
        $this->register_divider_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_feature_banner_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_feature_banner_style_section_background',
                'selector' => '{{WRAPPER}} .banner-footer',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_feature_banner_style_section_border',
                'selector' => '{{WRAPPER}} .banner-footer',
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_wrapper_padding',
            [
                'label'      => esc_html__('Wrapper Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_row_gap',
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
                    '{{WRAPPER}} .banner-footer .row' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_item_style_controls()
    {
        $this->start_controls_section(
            'adking_feature_banner_style_item',
            [
                'label'     => esc_html__('Item', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_item_gap',
            [
                'label'      => esc_html__('Icon/Text Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_item_alignment',
            [
                'label'     => esc_html__('Alignment', 'adking-core'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'adking-core'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'adking-core'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Bottom', 'adking-core'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_icon_style_controls()
    {
        $this->start_controls_section(
            'adking_feature_banner_style_icon',
            [
                'label'     => esc_html__('Icon', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_feature_banner_style_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_icon_size',
            [
                'label'      => esc_html__('Icon Size', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 8,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_content_style_controls()
    {
        $this->start_controls_section(
            'adking_feature_banner_style_content',
            [
                'label'     => esc_html__('Content', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_content_max_width',
            [
                'label'      => esc_html__('Content Max Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_feature_banner_style_title_typography',
                'selector' => '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content h5',
            ]
        );

        $this->add_control(
            'adking_feature_banner_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content h5 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_feature_banner_style_title_hover_color',
            [
                'label'     => esc_html__('Title Hover Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content h5 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_title_margin',
            [
                'label'      => esc_html__('Title Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_feature_banner_style_description_typography',
                'selector' => '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content p',
            ]
        );

        $this->add_control(
            'adking_feature_banner_style_description_color',
            [
                'label'     => esc_html__('Description Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .banner-footer-item .banner-footer-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_divider_style_controls()
    {
        $this->start_controls_section(
            'adking_feature_banner_style_divider',
            [
                'label'     => esc_html__('Divider', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_feature_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_feature_banner_style_divider_color',
            [
                'label'     => esc_html__('Divider Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .divider::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_feature_banner_style_divider_height',
            [
                'label'      => esc_html__('Divider Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .banner-footer .banner-footer-wrapper .divider::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_default_items()
    {
        return [
            [
                'adking_feature_banner_item_icon'        => ['value' => 'bi bi-truck', 'library' => 'bootstrap'],
                'adking_feature_banner_item_title'       => esc_html__('Fast Delivery', 'adking-core'),
                'adking_feature_banner_item_description' => esc_html__('Delivery in 24 hours max!', 'adking-core'),
                'adking_feature_banner_item_show_divider' => 'yes',
            ],
            [
                'adking_feature_banner_item_icon'        => ['value' => 'bi bi-shield-check', 'library' => 'bootstrap'],
                'adking_feature_banner_item_title'       => esc_html__('Safe Payment', 'adking-core'),
                'adking_feature_banner_item_description' => esc_html__('100% secure payment', 'adking-core'),
                'adking_feature_banner_item_show_divider' => 'yes',
            ],
            [
                'adking_feature_banner_item_icon'        => ['value' => 'bi bi-tags', 'library' => 'bootstrap'],
                'adking_feature_banner_item_title'       => esc_html__('Online Discount', 'adking-core'),
                'adking_feature_banner_item_description' => esc_html__('Add multi-buy discount', 'adking-core'),
                'adking_feature_banner_item_show_divider' => 'yes',
            ],
            [
                'adking_feature_banner_item_icon'        => ['value' => 'bi bi-headset', 'library' => 'bootstrap'],
                'adking_feature_banner_item_title'       => esc_html__('Help Center', 'adking-core'),
                'adking_feature_banner_item_description' => esc_html__('Dedicated 24/7 Support', 'adking-core'),
                'adking_feature_banner_item_show_divider' => '',
            ],
        ];
    }

    private function get_container_class($class)
    {
        $allowed = ['container-fluid p-0', 'container'];

        return in_array($class, $allowed, true) ? $class : 'container-fluid p-0';
    }

    private function get_column_class($columns)
    {
        $map = [
            '4' => 'col-lg-3 col-sm-6',
            '3' => 'col-lg-4 col-sm-6',
            '2' => 'col-lg-6 col-sm-6',
            '1' => 'col-12',
        ];

        return $map[$columns] ?? $map['4'];
    }

    private function get_link_attributes($link, $fallback = '')
    {
        $url = !empty($link['url']) ? $link['url'] : $fallback;

        if (empty($url)) {
            return '';
        }

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

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (($settings['adking_feature_banner_show_section'] ?? 'yes') !== 'yes') {
            return;
        }

        $items = !empty($settings['adking_feature_banner_items']) && is_array($settings['adking_feature_banner_items']) ? $settings['adking_feature_banner_items'] : [];

        if (empty($items)) {
            return;
        }

        $container_class = $this->get_container_class($settings['adking_feature_banner_container'] ?? '');
        $column_class = $this->get_column_class($settings['adking_feature_banner_columns'] ?? '4');
?>
        <div class="banner-footer">
            <div class="<?php echo esc_attr($container_class); ?>">
                <div class="banner-footer-wrapper">
                    <div class="row g-lg-4 gy-4">
                        <?php foreach ($items as $index => $item) :
                            $title = $item['adking_feature_banner_item_title'] ?? '';
                            $description = $item['adking_feature_banner_item_description'] ?? '';
                            $link = $item['adking_feature_banner_item_link'] ?? [];
                            $link_attributes = $this->get_link_attributes($link);
                            $has_divider = ($item['adking_feature_banner_item_show_divider'] ?? '') === 'yes' && $index < count($items) - 1;
                            $justify_class = 0 === $index ? ' justify-content-lg-start' : '';

                            if (empty($title) && empty($description) && empty($item['adking_feature_banner_item_icon']['value'])) {
                                continue;
                            }
                        ?>
                            <div class="<?php echo esc_attr($column_class . ' d-flex' . $justify_class . ' justify-content-sm-center' . ($has_divider ? ' divider' : '')); ?>">
                                <div class="banner-footer-item">
                                    <?php if (!empty($item['adking_feature_banner_item_icon'])) : ?>
                                        <div class="banner-footer-icon">
                                            <?php Icons_Manager::render_icon($item['adking_feature_banner_item_icon'], ['aria-hidden' => 'true']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="banner-footer-content">
                                        <?php if (!empty($title)) : ?>
                                            <h5>
                                                <?php if (!empty($link_attributes)) : ?>
                                                    <a <?php echo $link_attributes; ?>><?php echo esc_html($title); ?></a>
                                                <?php else : ?>
                                                    <?php echo esc_html($title); ?>
                                                <?php endif; ?>
                                            </h5>
                                        <?php endif; ?>

                                        <?php if (!empty($description)) : ?>
                                            <p><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Feature_Banner_Widget());
