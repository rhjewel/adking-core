<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Banner_Card_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_banner_card';
    }

    public function get_title()
    {
        return esc_html__('EG Banner Card', 'adking-core');
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
            'adking_banner_card_content',
            [
                'label' => esc_html__('Banner Card', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_banner_card_show_section',
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
            'adking_banner_card_item_image',
            [
                'label'   => esc_html__('Image', 'adking-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_image_alt',
            [
                'label'       => esc_html__('Image Alt Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Banner Card Image', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_image_position',
            [
                'label'   => esc_html__('Image Position', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'  => esc_html__('Left', 'adking-core'),
                    'right' => esc_html__('Right', 'adking-core'),
                ],
                'default' => 'left',
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_top_gap',
            [
                'label'        => esc_html__('Use Top Item Spacing', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'adking-core'),
                'label_off'    => esc_html__('No', 'adking-core'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_show_subtitle',
            [
                'label'        => esc_html__('Show Subtitle', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_subtitle',
            [
                'label'       => esc_html__('Subtitle', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('BROW BESTSELLERS', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_banner_card_item_show_subtitle' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__("They're kinda our Best thing!", 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_description',
            [
                'label'       => esc_html__('Description', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Whatever your summer looks like, bring your own heat with up to 25% off Lumin Brand.Pellentesque ipsum dui, laoreet vitae ex in, pellentesque aliquam leo.', 'adking-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_show_button',
            [
                'label'        => esc_html__('Show Button', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_button_text',
            [
                'label'       => esc_html__('Button Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Order Now', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_banner_card_item_show_button' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'adking_banner_card_item_button_link',
            [
                'label'       => esc_html__('Button Link', 'adking-core'),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_url(home_url('/')),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'adking_banner_card_item_show_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_card_items',
            [
                'label'       => esc_html__('Cards', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_items(),
                'title_field' => '{{{ adking_banner_card_item_title }}}',
                'condition'   => [
                    'adking_banner_card_show_section' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_image_style_controls();
        $this->register_content_style_controls();
        $this->register_button_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_banner_card_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_card_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_banner_card_style_section_background',
                'selector' => '{{WRAPPER}} .best-selling-section',
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_section_padding',
            [
                'label'      => esc_html__('Section Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-selling-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_section_margin',
            [
                'label'      => esc_html__('Section Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-selling-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_item_gap',
            [
                'label'      => esc_html__('Top Item Bottom Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 160,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .best-selling-section .makeup-top-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_image_style_controls()
    {
        $this->start_controls_section(
            'adking_banner_card_style_image',
            [
                'label'     => esc_html__('Image', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_card_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_banner_card_style_image_border',
                'selector' => '{{WRAPPER}} .best-selling-section .best-selling-img img',
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_image_radius',
            [
                'label'      => esc_html__('Border Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-selling-section .best-selling-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_image_max_height',
            [
                'label'      => esc_html__('Max Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 200,
                        'max' => 900,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .best-selling-section .best-selling-img img' => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_content_style_controls()
    {
        $this->start_controls_section(
            'adking_banner_card_style_content',
            [
                'label'     => esc_html__('Content', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_card_show_section' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_content_padding',
            [
                'label'      => esc_html__('Content Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-selling-section .makeup-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_content_max_width',
            [
                'label'      => esc_html__('Content Max Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 280,
                        'max' => 900,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .best-selling-section .makeup-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_banner_card_style_subtitle_typography',
                'label'    => esc_html__('Subtitle Typography', 'adking-core'),
                'selector' => '{{WRAPPER}} .best-selling-section .makeup-content span',
            ]
        );

        $this->add_control(
            'adking_banner_card_style_subtitle_color',
            [
                'label'     => esc_html__('Subtitle Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .best-selling-section .makeup-content span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_subtitle_margin',
            [
                'label'      => esc_html__('Subtitle Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-selling-section .makeup-content span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_banner_card_style_title_typography',
                'label'    => esc_html__('Title Typography', 'adking-core'),
                'selector' => '{{WRAPPER}} .best-selling-section .makeup-content h2',
            ]
        );

        $this->add_control(
            'adking_banner_card_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .best-selling-section .makeup-content h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_title_margin',
            [
                'label'      => esc_html__('Title Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-selling-section .makeup-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_banner_card_style_description_typography',
                'label'    => esc_html__('Description Typography', 'adking-core'),
                'selector' => '{{WRAPPER}} .best-selling-section .makeup-content p',
            ]
        );

        $this->add_control(
            'adking_banner_card_style_description_color',
            [
                'label'     => esc_html__('Description Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .best-selling-section .makeup-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_description_margin',
            [
                'label'      => esc_html__('Description Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .best-selling-section .makeup-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_button_style_controls()
    {
        $button = '{{WRAPPER}} .best-selling-section .makeup-content .primary-btn1.style-2.hover-btn3';

        $this->start_controls_section(
            'adking_banner_card_style_button',
            [
                'label'     => esc_html__('Button', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_banner_card_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_banner_card_style_button_typography',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_banner_card_style_button_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_card_style_button_background',
            [
                'label'     => esc_html__('Background Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_card_style_button_hover_color',
            [
                'label'     => esc_html__('Hover Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_banner_card_style_button_hover_background',
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
                'name'     => 'adking_banner_card_style_button_border',
                'selector' => $button,
            ]
        );

        $this->add_responsive_control(
            'adking_banner_card_style_button_padding',
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
            'adking_banner_card_style_button_radius',
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

    private function get_default_items()
    {
        return [
            [
                'adking_banner_card_item_image'         => [
                    'url' => $this->get_asset_url('img/home1/best-selling-img1.jpg'),
                ],
                'adking_banner_card_item_image_alt'     => esc_html__('Best selling makeup', 'adking-core'),
                'adking_banner_card_item_image_position' => 'left',
                'adking_banner_card_item_top_gap'       => 'yes',
                'adking_banner_card_item_show_subtitle' => 'yes',
                'adking_banner_card_item_subtitle'      => esc_html__('BROW BESTSELLERS', 'adking-core'),
                'adking_banner_card_item_title'         => esc_html__("They're kinda our Best thing!", 'adking-core'),
                'adking_banner_card_item_description'   => esc_html__('Whatever your summer looks like, bring your own heat with up to 25% off Lumin Brand.Pellentesque ipsum dui, laoreet vitae ex in, pellentesque aliquam leo.', 'adking-core'),
                'adking_banner_card_item_show_button'   => 'yes',
                'adking_banner_card_item_button_text'   => esc_html__('Order Now', 'adking-core'),
                'adking_banner_card_item_button_link'   => [
                    'url' => '#',
                ],
            ],
            [
                'adking_banner_card_item_image'         => [
                    'url' => $this->get_asset_url('img/home1/best-selling-img2.jpg'),
                ],
                'adking_banner_card_item_image_alt'     => esc_html__('Perfect best makeup', 'adking-core'),
                'adking_banner_card_item_image_position' => 'right',
                'adking_banner_card_item_top_gap'       => '',
                'adking_banner_card_item_show_subtitle' => '',
                'adking_banner_card_item_subtitle'      => '',
                'adking_banner_card_item_title'         => esc_html__('Try on your perfect Best Makeup!', 'adking-core'),
                'adking_banner_card_item_description'   => esc_html__('Whatever your summer looks like, bring your own heat with up to 25% off Lumin Brand.Pellentesque ipsum dui, laoreet vitae ex in, pellentesque aliquam leo.', 'adking-core'),
                'adking_banner_card_item_show_button'   => '',
                'adking_banner_card_item_button_text'   => esc_html__('Order Now', 'adking-core'),
                'adking_banner_card_item_button_link'   => [
                    'url' => '#',
                ],
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

            if ('href' === $attribute) {
                $value = esc_url($value);
            } else {
                $value = esc_attr($value);
            }

            $rendered_attributes[] = esc_attr($attribute) . '="' . $value . '"';
        }

        return implode(' ', $rendered_attributes);
    }

    private function render_image_column($item, $classes = '')
    {
        $image = !empty($item['adking_banner_card_item_image']['url']) ? $item['adking_banner_card_item_image'] : ['url' => Utils::get_placeholder_image_src()];
        $alt = $this->get_media_alt($image, !empty($item['adking_banner_card_item_image_alt']) ? $item['adking_banner_card_item_image_alt'] : esc_html__('Banner Card Image', 'adking-core'));
?>
        <div class="<?php echo esc_attr(trim('col-lg-6 ' . $classes)); ?>">
            <div class="best-selling-img hover-img">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($alt); ?>">
            </div>
        </div>
    <?php
    }

    private function render_content_column($item, $classes = '')
    {
        $show_subtitle = !empty($item['adking_banner_card_item_show_subtitle']) && 'yes' === $item['adking_banner_card_item_show_subtitle'];
        $show_button = !empty($item['adking_banner_card_item_show_button']) && 'yes' === $item['adking_banner_card_item_show_button'];
        $button_text = !empty($item['adking_banner_card_item_button_text']) ? $item['adking_banner_card_item_button_text'] : '';
    ?>
        <div class="<?php echo esc_attr(trim('col-lg-6 ' . $classes)); ?>">
            <div class="makeup-content">
                <?php if ($show_subtitle && !empty($item['adking_banner_card_item_subtitle'])) : ?>
                    <span><?php echo esc_html($item['adking_banner_card_item_subtitle']); ?></span>
                <?php endif; ?>
                <?php if (!empty($item['adking_banner_card_item_title'])) : ?>
                    <h2><?php echo esc_html($item['adking_banner_card_item_title']); ?></h2>
                <?php endif; ?>
                <?php if (!empty($item['adking_banner_card_item_description'])) : ?>
                    <p><?php echo esc_html($item['adking_banner_card_item_description']); ?></p>
                <?php endif; ?>
                <?php if ($show_button && !empty($button_text)) : ?>
                    <a <?php echo $this->render_attributes($this->get_link_attributes(!empty($item['adking_banner_card_item_button_link']) ? $item['adking_banner_card_item_button_link'] : [])); ?> class="primary-btn1 style-2 hover-btn3"><?php echo esc_html($button_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }

    private function render_card($item)
    {
        $image_position = !empty($item['adking_banner_card_item_image_position']) && 'right' === $item['adking_banner_card_item_image_position'] ? 'right' : 'left';
    ?>
        <div class="row align-items-center justify-content-center g-0 gy-4">
            <?php if ('right' === $image_position) : ?>
                <?php $this->render_content_column($item, 'order-lg-1 order-2'); ?>
                <?php $this->render_image_column($item, 'order-lg-2 order-1'); ?>
            <?php else : ?>
                <?php $this->render_image_column($item); ?>
                <?php $this->render_content_column($item); ?>
            <?php endif; ?>
        </div>
    <?php
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['adking_banner_card_show_section']) || 'yes' !== $settings['adking_banner_card_show_section']) {
            return;
        }

        $items = !empty($settings['adking_banner_card_items']) && is_array($settings['adking_banner_card_items'])
            ? $settings['adking_banner_card_items']
            : $this->get_default_items();
    ?>
        <div class="best-selling-section mb-110">
            <div class="container">
                <?php foreach ($items as $item) : ?>
                    <?php if (!empty($item['adking_banner_card_item_top_gap']) && 'yes' === $item['adking_banner_card_item_top_gap']) : ?>
                        <div class="makeup-top-item">
                            <?php $this->render_card($item); ?>
                        </div>
                    <?php else : ?>
                        <?php $this->render_card($item); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Banner_Card_Widget());
