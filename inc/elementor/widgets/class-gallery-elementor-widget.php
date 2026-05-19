<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Gallery_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_gallery';
    }

    public function get_title()
    {
        return esc_html__('EG Gallery', 'adking-core');
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
            'adking_gallery_content',
            [
                'label' => esc_html__('Gallery', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_gallery_show_section',
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
            'adking_gallery_show_title',
            [
                'label'        => esc_html__('Show Title', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'adking_gallery_show_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_gallery_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Gallery Area', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_gallery_show_section' => 'yes',
                    'adking_gallery_show_title'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_gallery_container',
            [
                'label'     => esc_html__('Container Width', 'adking-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'container-fluid one' => esc_html__('Full Width', 'adking-core'),
                    'container'           => esc_html__('Container', 'adking-core'),
                ],
                'default'   => 'container-fluid one',
                'condition' => [
                    'adking_gallery_show_section' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'adking_gallery_block_layout',
            [
                'label'   => esc_html__('Block Layout', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'single' => esc_html__('Single Card', 'adking-core'),
                    'stack'  => esc_html__('Stacked Cards', 'adking-core'),
                ],
                'default' => 'single',
            ]
        );

        $repeater->add_control(
            'adking_gallery_single_card_size',
            [
                'label'   => esc_html__('Single Card Size', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'tall-card'    => esc_html__('Tall', 'adking-core'),
                    'feature-card' => esc_html__('Feature', 'adking-core'),
                    'small-card'   => esc_html__('Small', 'adking-core'),
                ],
                'default'   => 'tall-card',
                'condition' => [
                    'adking_gallery_block_layout' => 'single',
                ],
            ]
        );

        $this->add_card_controls($repeater, 'single', esc_html__('Single Card', 'adking-core'));
        $this->add_card_controls($repeater, 'top', esc_html__('Stack Top Card', 'adking-core'));
        $this->add_card_controls($repeater, 'bottom', esc_html__('Stack Bottom Card', 'adking-core'));

        $this->add_control(
            'adking_gallery_blocks',
            [
                'label'       => esc_html__('Gallery Blocks', 'adking-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_default_blocks(),
                'title_field' => '{{{ adking_gallery_block_layout === "stack" ? "Stacked Cards" : adking_gallery_single_title }}}',
                'condition'   => [
                    'adking_gallery_show_section' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function add_card_controls($repeater, $prefix, $label)
    {
        $layout_condition = 'single' === $prefix ? 'single' : 'stack';

        $repeater->add_control(
            'adking_gallery_' . $prefix . '_heading',
            [
                'label'     => $label,
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'adking_gallery_block_layout' => $layout_condition,
                ],
            ]
        );

        $repeater->add_control(
            'adking_gallery_' . $prefix . '_type',
            [
                'label'     => esc_html__('Media Type', 'adking-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'image' => esc_html__('Image', 'adking-core'),
                    'video' => esc_html__('Video', 'adking-core'),
                ],
                'default'   => 'image',
                'condition' => [
                    'adking_gallery_block_layout' => $layout_condition,
                ],
            ]
        );

        $repeater->add_control(
            'adking_gallery_' . $prefix . '_image',
            [
                'label'     => esc_html__('Image', 'adking-core'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'adking_gallery_block_layout' => $layout_condition,
                    'adking_gallery_' . $prefix . '_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'adking_gallery_' . $prefix . '_video',
            [
                'label'       => esc_html__('Video', 'adking-core'),
                'type'        => Controls_Manager::MEDIA,
                'media_types' => ['video'],
                'condition'   => [
                    'adking_gallery_block_layout' => $layout_condition,
                    'adking_gallery_' . $prefix . '_type' => 'video',
                ],
            ]
        );

        $repeater->add_control(
            'adking_gallery_' . $prefix . '_title',
            [
                'label'       => esc_html__('Alt / Caption Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Gallery Image', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_gallery_block_layout' => $layout_condition,
                ],
            ]
        );
    }

    private function register_style_controls()
    {
        $this->start_controls_section(
            'adking_gallery_style_section',
            [
                'label'     => esc_html__('Section', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_gallery_show_section' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_gallery_style_section_background',
                'selector' => '{{WRAPPER}} .home1-gallery-section',
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_section_padding',
            [
                'label'      => esc_html__('Section Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home1-gallery-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_section_margin',
            [
                'label'      => esc_html__('Section Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home1-gallery-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_gallery_style_title',
            [
                'label'     => esc_html__('Title', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_gallery_show_section' => 'yes',
                    'adking_gallery_show_title'   => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_gallery_style_title_typography',
                'selector' => '{{WRAPPER}} .home1-gallery-section .section-title h3',
            ]
        );

        $this->add_control(
            'adking_gallery_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home1-gallery-section .section-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_title_margin',
            [
                'label'      => esc_html__('Title Area Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home1-gallery-section .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'adking_gallery_style_grid',
            [
                'label'     => esc_html__('Grid', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_gallery_show_section' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_grid_gap',
            [
                'label'      => esc_html__('Grid Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_stack_gap',
            [
                'label'      => esc_html__('Stack Gap', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-stack' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_small_height',
            [
                'label'      => esc_html__('Small Card Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 120,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-card' => 'min-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-stack' => 'grid-template-rows: repeat(2, {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_tall_height',
            [
                'label'      => esc_html__('Tall / Feature Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 240,
                        'max' => 900,
                    ],
                    'vh' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-card.tall-card' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-card.feature-card' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_gallery_style_card_radius',
            [
                'label'      => esc_html__('Card Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-card img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-card video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'adking_gallery_style_video_overlay',
            [
                'label'     => esc_html__('Video Overlay', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .home1-gallery-section .home1-gallery-grid .gallery-card.video-card::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_default_blocks()
    {
        return [
            $this->single_block('video', 'tall-card', '', 'img/home1/video/gallery-video1.mp4', esc_html__('Gallery Video', 'adking-core')),
            $this->stack_block(
                ['image', 'img/home1/gallery-img1.png', esc_html__('Traveler taking a camel ride selfie', 'adking-core')],
                ['image', 'img/home1/gallery-img2.png', esc_html__('Family enjoying a forest tour', 'adking-core')]
            ),
            $this->single_block('video', 'feature-card', '', 'img/home1/video/gallery-video2.mp4', esc_html__('Gallery Video', 'adking-core')),
            $this->stack_block(
                ['image', 'img/home1/gallery-img3.png', esc_html__('Group travelers enjoying a mountain view', 'adking-core')],
                ['image', 'img/home1/gallery-img4.png', esc_html__('Group travelers enjoying a mountain view', 'adking-core')]
            ),
            $this->single_block('image', 'tall-card', 'img/home1/gallery-img5.png', '', esc_html__('Traveler watching a mountain sunset', 'adking-core')),
            $this->single_block('image', 'tall-card', 'img/home1/gallery-img1.png', '', esc_html__('Traveler taking a camel ride selfie', 'adking-core')),
            $this->stack_block(
                ['video', 'img/home1/video/gallery-video1.mp4', esc_html__('Gallery Video', 'adking-core')],
                ['image', 'img/home1/gallery-img2.png', esc_html__('Family enjoying a forest tour', 'adking-core')]
            ),
            $this->single_block('image', 'tall-card', 'img/home1/gallery-img5.png', '', esc_html__('Traveler watching a mountain sunset', 'adking-core')),
            $this->stack_block(
                ['image', 'img/home1/gallery-img3.png', esc_html__('Group travelers enjoying a mountain view', 'adking-core')],
                ['image', 'img/home1/gallery-img4.png', esc_html__('Group travelers enjoying a mountain view', 'adking-core')]
            ),
            $this->single_block('video', 'feature-card', '', 'img/home1/video/gallery-video2.mp4', esc_html__('Gallery Video', 'adking-core')),
        ];
    }

    private function single_block($type, $size, $image_path, $video_path, $title)
    {
        return [
            'adking_gallery_block_layout'     => 'single',
            'adking_gallery_single_card_size' => $size,
            'adking_gallery_single_type'      => $type,
            'adking_gallery_single_image'     => ['url' => !empty($image_path) ? $this->get_asset_url($image_path) : Utils::get_placeholder_image_src()],
            'adking_gallery_single_video'     => ['url' => !empty($video_path) ? $this->get_asset_url($video_path) : ''],
            'adking_gallery_single_title'     => $title,
        ];
    }

    private function stack_block($top, $bottom)
    {
        return [
            'adking_gallery_block_layout' => 'stack',
            'adking_gallery_top_type'     => $top[0],
            'adking_gallery_top_image'    => ['url' => 'image' === $top[0] ? $this->get_asset_url($top[1]) : Utils::get_placeholder_image_src()],
            'adking_gallery_top_video'    => ['url' => 'video' === $top[0] ? $this->get_asset_url($top[1]) : ''],
            'adking_gallery_top_title'    => $top[2],
            'adking_gallery_bottom_type'  => $bottom[0],
            'adking_gallery_bottom_image' => ['url' => 'image' === $bottom[0] ? $this->get_asset_url($bottom[1]) : Utils::get_placeholder_image_src()],
            'adking_gallery_bottom_video' => ['url' => 'video' === $bottom[0] ? $this->get_asset_url($bottom[1]) : ''],
            'adking_gallery_bottom_title' => $bottom[2],
        ];
    }

    private function get_asset_url($path)
    {
        return trailingslashit(get_template_directory_uri()) . 'assets/' . ltrim($path, '/');
    }

    private function get_container_class($class)
    {
        return in_array($class, ['container-fluid one', 'container'], true) ? $class : 'container-fluid one';
    }

    private function get_card_size_class($class)
    {
        return in_array($class, ['small-card', 'tall-card', 'feature-card'], true) ? $class : 'tall-card';
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

    private function render_gallery_card($item, $prefix, $size_class)
    {
        $type = ($item['adking_gallery_' . $prefix . '_type'] ?? 'image') === 'video' ? 'video' : 'image';
        $title = $item['adking_gallery_' . $prefix . '_title'] ?? '';
        $card_classes = 'gallery-card ' . ('video' === $type ? 'video-card ' : '') . $this->get_card_size_class($size_class);

        if ('video' === $type) {
            $video = $item['adking_gallery_' . $prefix . '_video'] ?? [];
            $url = !empty($video['url']) ? $video['url'] : '';

            if (empty($url)) {
                return;
            }
?>
            <a href="<?php echo esc_url($url); ?>" class="<?php echo esc_attr($card_classes); ?>" data-fancybox="video-player">
                <video autoplay loop muted playsinline src="<?php echo esc_url($url); ?>"></video>
            </a>
        <?php
            return;
        }

        $image = $item['adking_gallery_' . $prefix . '_image'] ?? [];
        $url = !empty($image['url']) ? $image['url'] : Utils::get_placeholder_image_src();
        $alt = $this->get_media_alt($image, wp_strip_all_tags($title));
        ?>
        <a href="<?php echo esc_url($url); ?>" class="<?php echo esc_attr($card_classes); ?>" data-fancybox="gallery-01">
            <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>">
        </a>
    <?php
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (($settings['adking_gallery_show_section'] ?? 'yes') !== 'yes') {
            return;
        }

        $blocks = !empty($settings['adking_gallery_blocks']) && is_array($settings['adking_gallery_blocks']) ? $settings['adking_gallery_blocks'] : [];

        if (empty($blocks)) {
            return;
        }

        $container_class = $this->get_container_class($settings['adking_gallery_container'] ?? '');
    ?>
        <div class="home1-gallery-section">
            <div class="<?php echo esc_attr($container_class); ?>">
                <?php if (($settings['adking_gallery_show_title'] ?? 'yes') === 'yes' && !empty($settings['adking_gallery_title'])) : ?>
                    <div class="section-title text-center mb-60 wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <h3><?php echo esc_html($settings['adking_gallery_title']); ?></h3>
                    </div>
                <?php endif; ?>

                <div class="home1-gallery-grid">
                    <?php foreach ($blocks as $block) : ?>
                        <?php if (($block['adking_gallery_block_layout'] ?? 'single') === 'stack') : ?>
                            <div class="gallery-stack">
                                <?php $this->render_gallery_card($block, 'top', 'small-card'); ?>
                                <?php $this->render_gallery_card($block, 'bottom', 'small-card'); ?>
                            </div>
                        <?php else : ?>
                            <?php $this->render_gallery_card($block, 'single', $block['adking_gallery_single_card_size'] ?? 'tall-card'); ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Gallery_Widget());
