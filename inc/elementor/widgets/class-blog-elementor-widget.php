<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Adking_Blog_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'adking_blog';
    }

    public function get_title()
    {
        return esc_html__('EG Blog', 'adking-core');
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
        $this->register_header_controls();
        $this->register_blog_controls();
    }

    private function register_header_controls()
    {
        $this->start_controls_section(
            'adking_blog_content_header',
            [
                'label' => esc_html__('Header', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_blog_show_header',
            [
                'label'        => esc_html__('Show Header', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_blog_title',
            [
                'label'       => esc_html__('Title', 'adking-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Our Beauty Article', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_blog_show_header' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_blog_controls()
    {
        $this->start_controls_section(
            'adking_blog_content_items',
            [
                'label' => esc_html__('Blog Query', 'adking-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'adking_blog_posts_per_page',
            [
                'label'   => esc_html__('Posts Per Page', 'adking-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 12,
                'step'    => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'adking_blog_categories',
            [
                'label'       => esc_html__('Select Categories', 'adking-core'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_category_options(),
                'multiple'    => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'adking_blog_posts',
            [
                'label'       => esc_html__('Select Posts', 'adking-core'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_post_options(),
                'multiple'    => true,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'adking_blog_orderby',
            [
                'label'   => esc_html__('Order By', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ID'         => esc_html__('ID', 'adking-core'),
                    'author'     => esc_html__('Author', 'adking-core'),
                    'title'      => esc_html__('Title', 'adking-core'),
                    'date'       => esc_html__('Date', 'adking-core'),
                    'rand'       => esc_html__('Random', 'adking-core'),
                    'menu_order' => esc_html__('Menu Order', 'adking-core'),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'adking_blog_order',
            [
                'label'   => esc_html__('Order', 'adking-core'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__('ASC', 'adking-core'),
                    'DESC' => esc_html__('DESC', 'adking-core'),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'adking_blog_show_date',
            [
                'label'        => esc_html__('Show Date', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_blog_show_tags',
            [
                'label'        => esc_html__('Show Tags', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_blog_show_excerpt',
            [
                'label'        => esc_html__('Show Excerpt', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_blog_show_read_more',
            [
                'label'        => esc_html__('Show Read More', 'adking-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'adking-core'),
                'label_off'    => esc_html__('Hide', 'adking-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'adking_blog_read_more_text',
            [
                'label'       => esc_html__('Read More Text', 'adking-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Read More', 'adking-core'),
                'label_block' => true,
                'condition'   => [
                    'adking_blog_show_read_more' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_style_controls()
    {
        $this->register_section_style_controls();
        $this->register_header_style_controls();
        $this->register_card_style_controls();
        $this->register_content_style_controls();
        $this->register_read_more_style_controls();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'adking_blog_style_section',
            [
                'label' => esc_html__('Section', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_blog_style_section_background',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .blog-section',
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_section_padding',
            [
                'label'      => esc_html__('Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .blog-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_section_margin',
            [
                'label'      => esc_html__('Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .blog-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_header_style_controls()
    {
        $this->start_controls_section(
            'adking_blog_style_header',
            [
                'label'     => esc_html__('Header', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_blog_show_header' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_header_margin',
            [
                'label'      => esc_html__('Header Margin', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    '{{WRAPPER}} .blog-section .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_blog_style_title_typography',
                'selector' => '{{WRAPPER}} .blog-section .section-title h3',
            ]
        );

        $this->add_control(
            'adking_blog_style_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-section .section-title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_title_line_color',
            [
                'label'     => esc_html__('Title Line Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-section .section-title h3::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_title_line_width',
            [
                'label'      => esc_html__('Title Line Width', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .blog-section .section-title h3::after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_card_style_controls()
    {
        $this->start_controls_section(
            'adking_blog_style_card',
            [
                'label' => esc_html__('Card', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $card = '{{WRAPPER}} .blog-card';

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'adking_blog_style_card_background',
                'types'    => ['classic', 'gradient'],
                'selector' => $card,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_blog_style_card_border',
                'selector' => $card,
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_card_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $card => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_image_height',
            [
                'label'      => esc_html__('Image Height', 'adking-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range'      => [
                    'px' => [
                        'min' => 120,
                        'max' => 600,
                    ],
                ],
                'selectors'  => [
                    $card . ' .article-image .article-card-img img' => 'min-height: {{SIZE}}{{UNIT}}; max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_date_heading',
            [
                'label'     => esc_html__('Date Badge', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'adking_blog_show_date' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'adking_blog_style_date_typography',
                'selector'  => $card . ' .article-image .blog-date a',
                'condition' => [
                    'adking_blog_show_date' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_date_color',
            [
                'label'     => esc_html__('Date Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $card . ' .article-image .blog-date a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'adking_blog_show_date' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_date_background',
            [
                'label'     => esc_html__('Date Background', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $card . ' .article-image .blog-date a' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'adking_blog_show_date' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_date_padding',
            [
                'label'      => esc_html__('Date Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $card . ' .article-image .blog-date a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'adking_blog_show_date' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_content_style_controls()
    {
        $this->start_controls_section(
            'adking_blog_style_content',
            [
                'label' => esc_html__('Card Content', 'adking-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $content = '{{WRAPPER}} .blog-card .article-card-content';

        $this->add_responsive_control(
            'adking_blog_style_content_padding',
            [
                'label'      => esc_html__('Content Padding', 'adking-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors'  => [
                    $content => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_tag_heading',
            [
                'label'     => esc_html__('Tags', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'adking_blog_show_tags' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'adking_blog_style_tag_typography',
                'selector'  => $content . ' .tag ul li a',
                'condition' => [
                    'adking_blog_show_tags' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_tag_color',
            [
                'label'     => esc_html__('Tag Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $content . ' .tag ul li a' => 'color: {{VALUE}};',
                    $content . ' .tag ul li::before' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'adking_blog_show_tags' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_tag_hover_color',
            [
                'label'     => esc_html__('Tag Hover Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $content . ' .tag ul li a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'adking_blog_show_tags' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_title_heading',
            [
                'label'     => esc_html__('Title', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_blog_style_card_title_typography',
                'selector' => $content . ' h5 a',
            ]
        );

        $this->add_control(
            'adking_blog_style_card_title_color',
            [
                'label'     => esc_html__('Title Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $content . ' h5 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_card_title_hover_line_color',
            [
                'label'     => esc_html__('Title Underline Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $content . ' h5 a.hover-underline' => 'background-image: linear-gradient(to bottom, {{VALUE}} 0%, {{VALUE}} 98%);',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_excerpt_heading',
            [
                'label'     => esc_html__('Excerpt', 'adking-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'adking_blog_show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'adking_blog_style_excerpt_typography',
                'selector'  => $content . ' p',
                'condition' => [
                    'adking_blog_show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_excerpt_color',
            [
                'label'     => esc_html__('Excerpt Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $content . ' p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'adking_blog_show_excerpt' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_read_more_style_controls()
    {
        $this->start_controls_section(
            'adking_blog_style_read_more',
            [
                'label'     => esc_html__('Read More', 'adking-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'adking_blog_show_read_more' => 'yes',
                ],
            ]
        );

        $button = '{{WRAPPER}} .blog-card .article-card-content > a.adking-blog-read-more';

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'adking_blog_style_read_more_typography',
                'selector' => $button,
            ]
        );

        $this->add_control(
            'adking_blog_style_read_more_color',
            [
                'label'     => esc_html__('Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_read_more_background',
            [
                'label'     => esc_html__('Underline Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button => 'background-image: linear-gradient(to bottom, {{VALUE}} 0%, {{VALUE}} 98%);',
                ],
            ]
        );

        $this->add_control(
            'adking_blog_style_read_more_hover_color',
            [
                'label'     => esc_html__('Hover Text Color', 'adking-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $button . ':hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'adking_blog_style_read_more_border',
                'selector' => $button,
            ]
        );

        $this->add_responsive_control(
            'adking_blog_style_read_more_padding',
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $query = new \WP_Query($this->get_query_args($settings));

        if (!$query->have_posts()) {
            return;
        }

        $posts = $query->posts;
        $left_posts = array_slice($posts, 0, 2);
        $right_posts = array_slice($posts, 2);
?>
        <div class="blog-section adking-blog-widget">
            <div class="container">
                <?php if (!empty($settings['adking_blog_show_header']) && 'yes' === $settings['adking_blog_show_header'] && !empty($settings['adking_blog_title'])) : ?>
                    <div class="section-title style-2 text-center">
                        <h3><?php echo nl2br(esc_html($settings['adking_blog_title'])); ?></h3>
                    </div>
                <?php endif; ?>

                <div class="row gy-4">
                    <?php if (!empty($left_posts)) : ?>
                        <div class="col-lg-7">
                            <div class="row gy-4">
                                <?php foreach ($left_posts as $post) : ?>
                                    <div class="col-md-6">
                                        <?php $this->render_blog_card($post, $settings); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($right_posts)) : ?>
                        <div class="col-lg-5">
                            <?php foreach ($right_posts as $post) : ?>
                                <?php $this->render_blog_card($post, $settings); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
        wp_reset_postdata();
    }

    private function render_blog_card($post, $settings)
    {
        $post_id = $post instanceof \WP_Post ? $post->ID : absint($post);
        $title = get_the_title($post_id);
        $permalink = get_permalink($post_id);
        $date = get_the_date('', $post_id);
        $categories = get_the_category($post_id);
        $excerpt = $this->get_post_excerpt($post_id);
        $image_url = get_the_post_thumbnail_url($post_id, 'large');
        $image_alt = $this->get_post_thumbnail_alt($post_id, $title);
        $read_more_text = !empty($settings['adking_blog_read_more_text']) ? $settings['adking_blog_read_more_text'] : '';
    ?>
        <div class="blog-card">
            <div class="article-image">
                <?php if (!empty($settings['adking_blog_show_date']) && 'yes' === $settings['adking_blog_show_date'] && !empty($date)) : ?>
                    <div class="blog-date">
                        <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($date); ?></a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($image_url)) : ?>
                    <a class="article-card-img hover-img" href="<?php echo esc_url($permalink); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                    </a>
                <?php endif; ?>
            </div>

            <div class="article-card-content">
                <?php if (!empty($settings['adking_blog_show_tags']) && 'yes' === $settings['adking_blog_show_tags'] && !empty($categories)) : ?>
                    <div class="tag">
                        <ul>
                            <?php foreach ($categories as $category) : ?>
                                <li><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <h5><a class="hover-underline" href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h5>
                <?php endif; ?>

                <?php if (!empty($settings['adking_blog_show_excerpt']) && 'yes' === $settings['adking_blog_show_excerpt'] && !empty($excerpt)) : ?>
                    <p><?php echo esc_html($excerpt); ?></p>
                <?php endif; ?>

                <?php if (!empty($settings['adking_blog_show_read_more']) && 'yes' === $settings['adking_blog_show_read_more'] && !empty($read_more_text)) : ?>
                    <a class="adking-blog-read-more" href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($read_more_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
<?php
    }

    private function get_query_args($settings)
    {
        $allowed_orderby = ['ID', 'author', 'title', 'date', 'rand', 'menu_order'];
        $allowed_order = ['ASC', 'DESC'];

        $posts_per_page = !empty($settings['adking_blog_posts_per_page']) ? absint($settings['adking_blog_posts_per_page']) : 3;
        $posts_per_page = max(1, min(12, $posts_per_page));

        $orderby = !empty($settings['adking_blog_orderby']) && in_array($settings['adking_blog_orderby'], $allowed_orderby, true) ? $settings['adking_blog_orderby'] : 'date';
        $order = !empty($settings['adking_blog_order']) && in_array(strtoupper($settings['adking_blog_order']), $allowed_order, true) ? strtoupper($settings['adking_blog_order']) : 'DESC';

        $args = [
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $posts_per_page,
            'orderby'             => $orderby,
            'order'               => $order,
            'ignore_sticky_posts' => true,
        ];

        $selected_posts = $this->sanitize_id_list($settings['adking_blog_posts'] ?? []);
        if (!empty($selected_posts)) {
            $args['post__in'] = $selected_posts;
        }

        $selected_categories = $this->sanitize_id_list($settings['adking_blog_categories'] ?? []);
        if (!empty($selected_categories)) {
            $args['category__in'] = $selected_categories;
        }

        return $args;
    }

    private function sanitize_id_list($ids)
    {
        if (empty($ids)) {
            return [];
        }

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $ids = array_map('absint', $ids);

        return array_values(array_filter($ids));
    }

    private function get_category_options()
    {
        $options = [];
        $categories = get_categories([
            'taxonomy'   => 'category',
            'hide_empty' => false,
        ]);

        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->term_id] = $category->name;
            }
        }

        return $options;
    }

    private function get_post_options()
    {
        $options = [];
        $posts = get_posts([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 100,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        }

        return $options;
    }

    private function get_post_excerpt($post_id)
    {
        $excerpt = get_the_excerpt($post_id);

        if (empty($excerpt)) {
            $excerpt = wp_trim_words(wp_strip_all_tags(strip_shortcodes(get_post_field('post_content', $post_id))), 22, '.......');
        }

        return $excerpt;
    }

    private function get_post_thumbnail_alt($post_id, $fallback = '')
    {
        $thumbnail_id = get_post_thumbnail_id($post_id);

        if ($thumbnail_id) {
            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

            if (!empty($alt)) {
                return $alt;
            }
        }

        return $fallback;
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Blog_Widget());
