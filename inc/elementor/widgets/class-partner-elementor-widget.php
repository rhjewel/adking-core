<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Partner_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_partner';
    }

    public function get_title()
    {
        return esc_html__('EG Partner', 'adking-core');
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
            'adking_partner_content',
            [
                'label' => esc_html__('Partner', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_partner_show_section',
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
            'adking_partner_show_title',
            [
                'label'        => esc_html__('Show Title', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_partner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_partner_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Our Best Brand', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_partner_show_section' => 'yes',
                    'adking_partner_show_title'   => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_partner_item_logo',
            [
                'label'   => esc_html__('Logo', 'adking-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'adking_partner_item_title',
            [
                'label'       => esc_html__('Logo Alt Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Partner Logo', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_partner_item_link',
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
            'adking_partner_items',
            [
                'label'       => esc_html__('Partner Logos', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_partners(),
                'title_field' => '{{{ adking_partner_item_title }}}',
                'condition'   => [
                    'adking_partner_show_section' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_title_style_controls();
        $this->register_logo_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_partner_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_partner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_partner_style_section_background',
                'selector' => '{{WRAPPER}} .best-brand-section',
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_section_padding',
            [
                'label'      => esc_html__('Section Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-brand-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_section_margin',
            [
                'label'      => esc_html__('Section Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-brand-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_wrapper_padding',
            [
                'label'      => esc_html__('Logo Wrapper Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-brand-section .best-brand-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_title_style_controls()
    {
        $this->start_controls_section(
            'adking_partner_style_title',
            [
                'label'     => esc_html__('Title', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_partner_show_section' => 'yes',
                    'adking_partner_show_title'   => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_partner_style_title_typography',
                'selector' => '{{WRAPPER}} .best-brand-section .section-title h3',
            ]
        );

        $this->add_control(
            'adking_partner_style_title_color',
            [
                'label'     => esc_html__('Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .best-brand-section .section-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_title_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-brand-section .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_logo_style_controls()
    {
        $this->start_controls_section(
            'adking_partner_style_logo',
            [
                'label'     => esc_html__('Logo Box', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_partner_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_partner_style_logo_background',
                'selector' => '{{WRAPPER}} .best-brand-section .best-brand-wrapper .brand-icon',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_partner_style_logo_border',
                'selector' => '{{WRAPPER}} .best-brand-section .best-brand-wrapper .brand-icon',
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_logo_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-brand-section .best-brand-wrapper .brand-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_logo_min_height',
            [
                'label'      => esc_html__('Minimum Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 40,
                        'max' => 240,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .best-brand-section .best-brand-wrapper .brand-icon' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_logo_width',
            [
                'label'      => esc_html__('Logo Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 260,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .best-brand-section .best-brand-wrapper .brand-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_partner_style_logo_opacity',
            [
                'label'     => esc_html__('Logo Opacity', 'adking-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .best-brand-section .best-brand-wrapper .brand-icon img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_default_partners()
    {
        $items = [];

        for ($index = 1; $index <= 7; $index++) {
            $items[] = [
                'adking_partner_item_logo'  => [
                    'url' => $this->get_asset_url('img/home1/brand-logo' . $index . '.png'),
                ],
                'adking_partner_item_title' => sprintf(esc_html__('Partner Logo %d', 'adking-core'), $index),
                'adking_partner_item_link'  => [
                    'url' => '#',
                ],
            ];
        }

        return $items;
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

            if ('href' === $attribute) {
                $value = esc_url($value);
            } else {
                $value = esc_attr($value);
            }

            $rendered_attributes[] = esc_attr($attribute) . '="' . $value . '"';
        }

        return implode(' ', $rendered_attributes);
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['adking_partner_show_section']) || 'yes' !== $settings['adking_partner_show_section']) {
            return;
        }

        $items = !empty($settings['adking_partner_items']) && is_array($settings['adking_partner_items'])
            ? $settings['adking_partner_items']
            : $this->get_default_partners();
?>
        <div class="best-brand-section">
            <?php if (!empty($settings['adking_partner_show_title']) && 'yes' === $settings['adking_partner_show_title'] && !empty($settings['adking_partner_title'])) : ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="section-title text-center">
                                <h3><?php echo esc_html($settings['adking_partner_title']); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="container-fluid">
                <div class="best-brand-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="swiper brand-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($items as $item) :
                                        $logo = !empty($item['adking_partner_item_logo']['url']) ? $item['adking_partner_item_logo'] : ['url' => Utils::get_placeholder_image_src()];
                                        $logo_alt = $this->get_media_alt($logo, !empty($item['adking_partner_item_title']) ? $item['adking_partner_item_title'] : esc_html__('Partner Logo', 'adking-core'));
                                        $link_attributes = $this->get_link_attributes(!empty($item['adking_partner_item_link']) ? $item['adking_partner_item_link'] : []);
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="brand-icon">
                                                <a <?php echo $this->render_attributes($link_attributes); ?>>
                                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo_alt); ?>">
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Partner_Widget());
