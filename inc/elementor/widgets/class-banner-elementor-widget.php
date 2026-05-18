<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Banner_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_banner';
    }

    public function get_title()
    {
        return esc_html__('EG Banner', 'adking-core');
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
            'adking_banner_content',
            [
                'label' => esc_html__('Banner Content', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_banner_show_section',
            [
                'label'        => esc_html__('Show Banner', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_banner_background_image',
            [
                'label'     => esc_html__('Background Image', 'adking-core'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => $this->get_asset_url('img/home1/home1-banner-img.jpg'),
                ],
                'condition' => [
                    'adking_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_show_title',
            [
                'label'        => esc_html__('Show Title', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Make Your Desire In Customized.', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_banner_show_section' => 'yes',
                    'adking_banner_show_title'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_show_description',
            [
                'label'        => esc_html__('Show Description', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_description',
            [
                'label'       => esc_html__('Description', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Whatever your summer looks like, bring your own heat with up to 25% off Lumin Brand.', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_banner_show_section'     => 'yes',
                    'adking_banner_show_description' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_show_button',
            [
                'label'        => esc_html__('Show Button', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_button_text',
            [
                'label'       => esc_html__('Button Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('*Buy Now*', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_banner_show_section' => 'yes',
                    'adking_banner_show_button'  => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_button_link',
            [
                'label'       => esc_html__('Button Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'adking_banner_show_section' => 'yes',
                    'adking_banner_show_button'  => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_banner_layout',
            [
                'label'     => esc_html__('Layout', 'adking-core'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'adking_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_container',
            [
                'label'   => esc_html__('Container Width', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'container'       => esc_html__('Container', 'adking-core'),
                    'container-fluid' => esc_html__('Full Width', 'adking-core'),
                ],
                'default' => 'container',
            ]
        );

        $this->add_control(
            'adking_banner_content_column',
            [
                'label'   => esc_html__('Content Column', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'col-xl-5 col-lg-7' => esc_html__('Narrow', 'adking-core'),
                    'col-xl-6'          => esc_html__('Default', 'adking-core'),
                    'col-xl-7 col-lg-9' => esc_html__('Wide', 'adking-core'),
                    'col-12'            => esc_html__('Full Width', 'adking-core'),
                ],
                'default' => 'col-xl-6',
            ]
        );

        $this->add_responsive_control(
            'adking_banner_content_alignment',
            [
                'label'     => esc_html__('Content Alignment', 'adking-core'),
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
                    '{{WRAPPER}} .home1-banner-section .banner-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_title_style_controls();
        $this->register_description_style_controls();
        $this->register_button_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_banner_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_style_overlay_color',
            [
                'label'     => esc_html__('Overlay Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, 0.2)',
                'selectors' => [
                    '{{WRAPPER}} .home1-banner-section' => '--adking-banner-overlay-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_style_section_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home1-banner-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_style_background_position',
            [
                'label'     => esc_html__('Background Position', 'adking-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'left center'   => esc_html__('Left Center', 'adking-core'),
                    'center center' => esc_html__('Center Center', 'adking-core'),
                    'right center'  => esc_html__('Right Center', 'adking-core'),
                    'center top'    => esc_html__('Center Top', 'adking-core'),
                    'center bottom' => esc_html__('Center Bottom', 'adking-core'),
                ],
                'default'   => 'right center',
                'selectors' => [
                    '{{WRAPPER}} .home1-banner-section' => 'background-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_style_content_max_width',
            [
                'label'      => esc_html__('Content Max Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_title_style_controls()
    {
        $this->start_controls_section(
            'adking_banner_style_title',
            [
                'label'     => esc_html__('Title', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_show_section' => 'yes',
                    'adking_banner_show_title'   => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_banner_style_title_typography',
                'selector' => '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content h1',
            ]
        );

        $this->add_control(
            'adking_banner_style_title_color',
            [
                'label'     => esc_html__('Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_style_title_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_description_style_controls()
    {
        $this->start_controls_section(
            'adking_banner_style_description',
            [
                'label'     => esc_html__('Description', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_show_section'     => 'yes',
                    'adking_banner_show_description' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_banner_style_description_typography',
                'selector' => '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content p',
            ]
        );

        $this->add_control(
            'adking_banner_style_description_color',
            [
                'label'     => esc_html__('Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_style_description_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_button_style_controls()
    {
        $button = '{{WRAPPER}} .home1-banner-section .banner-content-wrapper .banner-content .primary-btn1';

        $this->start_controls_section(
            'adking_banner_style_button',
            [
                'label'     => esc_html__('Button', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_show_section' => 'yes',
                    'adking_banner_show_button'  => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_banner_style_button_typography',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_banner_style_button_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_style_button_background',
            [
                'label'     => esc_html__('Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_style_button_hover_color',
            [
                'label'     => esc_html__('Hover Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_style_button_hover_background',
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
                'name'     => 'adking_banner_style_button_border',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_banner_style_button_hover_border_color',
            [
                'label'     => esc_html__('Hover Border Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_style_button_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    $button . '::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_style_button_padding',
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
            'adking_banner_style_button_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $button => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_asset_url($path)
    {
        return trailingslashit(get_template_directory_uri()) . 'assets/' . ltrim($path, '/');
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

    private function get_container_class($class)
    {
        return in_array($class, ['container', 'container-fluid'], true) ? $class : 'container';
    }

    private function get_column_class($class)
    {
        $allowed = [
            'col-xl-5 col-lg-7',
            'col-xl-6',
            'col-xl-7 col-lg-9',
            'col-12',
        ];

        return in_array($class, $allowed, true) ? $class : 'col-xl-6';
    }

    private function get_background_style($media)
    {
        $image_url = !empty($media['url']) ? $media['url'] : $this->get_asset_url('img/home1/home1-banner-img.jpg');
        $background = sprintf(
            'background-image: linear-gradient(180deg, var(--adking-banner-overlay-color, rgba(0, 0, 0, 0.2)) 0%%, var(--adking-banner-overlay-color, rgba(0, 0, 0, 0.2)) 100%%), url(%s);',
            esc_url($image_url)
        );

        return $background;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (($settings['adking_banner_show_section'] ?? 'yes') !== 'yes') {
            return;
        }

        $show_title = ($settings['adking_banner_show_title'] ?? 'yes') === 'yes';
        $show_description = ($settings['adking_banner_show_description'] ?? 'yes') === 'yes';
        $show_button = ($settings['adking_banner_show_button'] ?? 'yes') === 'yes';
        $title = $settings['adking_banner_title'] ?? '';
        $description = $settings['adking_banner_description'] ?? '';
        $button_text = $settings['adking_banner_button_text'] ?? '';
        $button_link = $settings['adking_banner_button_link'] ?? [];
        $container_class = $this->get_container_class($settings['adking_banner_container'] ?? '');
        $column_class = $this->get_column_class($settings['adking_banner_content_column'] ?? '');
        $background_style = $this->get_background_style($settings['adking_banner_background_image'] ?? []);
?>
        <div class="home1-banner-section" style="<?php echo esc_attr($background_style); ?>">
            <div class="<?php echo esc_attr($container_class); ?>">
                <div class="banner-content-wrapper">
                    <div class="row align-items-end justify-content-between">
                        <div class="<?php echo esc_attr($column_class); ?>">
                            <div class="banner-content">
                                <?php if ($show_title && !empty($title)) : ?>
                                    <h1><?php echo esc_html($title); ?></h1>
                                <?php endif; ?>

                                <?php if ($show_description && !empty($description)) : ?>
                                    <p><?php echo esc_html($description); ?></p>
                                <?php endif; ?>

                                <?php if ($show_button && !empty($button_text)) : ?>
                                    <a class="primary-btn1 hover-btn3" <?php echo $this->get_link_attributes($button_link); ?>>
                                        <?php echo esc_html($button_text); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Banner_Widget());
