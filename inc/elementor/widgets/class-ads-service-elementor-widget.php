<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Ads_Service_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_ads_service';
    }

    public function get_title()
    {
        return esc_html__('EG Ads Service', 'adking-core');
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
            'adking_ads_service_content',
            [
                'label' => esc_html__('Ads Services', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_ads_service_show_section',
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
            'adking_ads_service_container',
            [
                'label'   => esc_html__('Container Width', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'container-fluid' => esc_html__('Full Width', 'adking-core'),
                    'container'       => esc_html__('Container', 'adking-core'),
                ],
                'default'   => 'container-fluid',
                'condition' => [
                    'adking_ads_service_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_ads_service_columns',
            [
                'label'   => esc_html__('Columns', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'col-xl-3 col-md-6' => esc_html__('4 Columns', 'adking-core'),
                    'col-xl-4 col-md-6' => esc_html__('3 Columns', 'adking-core'),
                    'col-xl-6 col-md-6' => esc_html__('2 Columns', 'adking-core'),
                    'col-12'            => esc_html__('1 Column', 'adking-core'),
                ],
                'default'   => 'col-xl-4 col-md-6',
                'condition' => [
                    'adking_ads_service_show_section' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_ads_service_item_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Desktop magnetic double-sided rechargeable light box', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_ads_service_item_image',
            [
                'label'   => esc_html__('Image', 'adking-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'adking_ads_service_item_link',
            [
                'label'       => esc_html__('Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'adking_ads_service_items',
            [
                'label'       => esc_html__('Service Items', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_services(),
                'title_field' => '{{{ adking_ads_service_item_title }}}',
                'condition'   => [
                    'adking_ads_service_show_section' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->start_controls_section(
            'adking_ads_service_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_ads_service_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_ads_service_style_section_background',
                'selector' => '{{WRAPPER}} .service-section',
            ]
        );

        $this->add_responsive_control(
            'adking_ads_service_style_section_padding',
            [
                'label'      => esc_html__('Section Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .service-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_ads_service_style_wrapper_padding',
            [
                'label'      => esc_html__('Wrapper Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .service-section .service-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_ads_service_style_row_gap',
            [
                'label'      => esc_html__('Row Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-section .row' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_ads_service_style_card',
            [
                'label'     => esc_html__('Card', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_ads_service_show_section' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_ads_service_style_card_min_height',
            [
                'label'      => esc_html__('Image Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 900,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-section .service-card .service-card-img img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover; width: 100%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_ads_service_style_card_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .service-section .service-card .service-card-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .service-section .service-card .service-card-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'adking_ads_service_style_overlay_color',
            [
                'label'     => esc_html__('Overlay Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-section .service-card .service-card-img::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_ads_service_style_title',
            [
                'label'     => esc_html__('Title', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_ads_service_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_ads_service_style_title_typography',
                'selector' => '{{WRAPPER}} .service-section .service-card h4 a',
            ]
        );

        $this->add_control(
            'adking_ads_service_style_title_color',
            [
                'label'     => esc_html__('Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-section .service-card h4 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_ads_service_style_title_hover_color',
            [
                'label'     => esc_html__('Hover Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-section .service-card h4 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_ads_service_style_title_position_left',
            [
                'label'      => esc_html__('Left Position', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-section .service-card h4' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_ads_service_style_title_position_bottom',
            [
                'label'      => esc_html__('Bottom Position', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-section .service-card h4' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_default_services()
    {
        $title = esc_html__('Desktop magnetic double-sided rechargeable light box', 'adking-core');

        return [
            [
                'adking_ads_service_item_title' => $title,
                'adking_ads_service_item_image' => ['url' => $this->get_asset_url('img/home1/service-card-img1.jpg')],
                'adking_ads_service_item_link'  => ['url' => '#'],
            ],
            [
                'adking_ads_service_item_title' => $title,
                'adking_ads_service_item_image' => ['url' => $this->get_asset_url('img/home1/service-card-img2.jpg')],
                'adking_ads_service_item_link'  => ['url' => '#'],
            ],
            [
                'adking_ads_service_item_title' => $title,
                'adking_ads_service_item_image' => ['url' => $this->get_asset_url('img/home1/service-card-img3.jpg')],
                'adking_ads_service_item_link'  => ['url' => '#'],
            ],
            [
                'adking_ads_service_item_title' => $title,
                'adking_ads_service_item_image' => ['url' => $this->get_asset_url('img/home1/service-card-img4.jpg')],
                'adking_ads_service_item_link'  => ['url' => '#'],
            ],
            [
                'adking_ads_service_item_title' => $title,
                'adking_ads_service_item_image' => ['url' => $this->get_asset_url('img/home1/service-card-img5.jpg')],
                'adking_ads_service_item_link'  => ['url' => '#'],
            ],
            [
                'adking_ads_service_item_title' => $title,
                'adking_ads_service_item_image' => ['url' => $this->get_asset_url('img/home1/service-card-img6.jpg')],
                'adking_ads_service_item_link'  => ['url' => '#'],
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

    private function get_link_attributes($link, $fallback = '#')
    {
        $url = !empty($link['url']) ? $link['url'] : $fallback;
        $attributes = [
            'href' => esc_url($url),
        ];

        if (!empty($link['is_external'])) {
            $attributes['target'] = '_blank';
        }

        if (!empty($link['nofollow'])) {
            $attributes['rel'] = 'nofollow';
        }

        if (!empty($link['is_external'])) {
            $attributes['rel'] = !empty($attributes['rel']) ? $attributes['rel'] . ' noopener' : 'noopener';
        }

        $output = [];

        foreach ($attributes as $key => $value) {
            $output[] = sprintf('%s="%s"', esc_attr($key), esc_attr($value));
        }

        return implode(' ', $output);
    }

    private function get_column_class($class)
    {
        $allowed = [
            'col-xl-3 col-md-6',
            'col-xl-4 col-md-6',
            'col-xl-6 col-md-6',
            'col-12',
        ];

        return in_array($class, $allowed, true) ? $class : 'col-xl-4 col-md-6';
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (($settings['adking_ads_service_show_section'] ?? 'yes') !== 'yes') {
            return;
        }

        $items = $settings['adking_ads_service_items'] ?? [];

        if (empty($items) || !is_array($items)) {
            return;
        }

        $container_class = ($settings['adking_ads_service_container'] ?? 'container-fluid') === 'container' ? 'container' : 'container-fluid';
        $column_class = $this->get_column_class($settings['adking_ads_service_columns'] ?? '');
?>
        <div class="service-section">
            <div class="<?php echo esc_attr($container_class); ?>">
                <div class="service-wrapper">
                    <div class="row gy-4">
                        <?php foreach ($items as $item) :
                            $title = $item['adking_ads_service_item_title'] ?? '';
                            $image = $item['adking_ads_service_item_image'] ?? [];
                            $image_url = !empty($image['url']) ? $image['url'] : Utils::get_placeholder_image_src();

                            if (empty($title) && empty($image_url)) {
                                continue;
                            }

                            $image_alt = $this->get_media_alt($image, wp_strip_all_tags($title));
                            $link = $item['adking_ads_service_item_link'] ?? [];
                        ?>
                            <div class="<?php echo esc_attr($column_class); ?>">
                                <div class="service-card">
                                    <a class="service-card-img hover-img" <?php echo $this->get_link_attributes($link); ?>>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                    </a>
                                    <?php if (!empty($title)) : ?>
                                        <h4>
                                            <a <?php echo $this->get_link_attributes($link); ?>>
                                                <?php echo esc_html($title); ?>
                                            </a>
                                        </h4>
                                    <?php endif; ?>
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

Plugin::instance()->widgets_manager->register(new Adking_Ads_Service_Widget());
