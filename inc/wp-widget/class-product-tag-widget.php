<?php

/**
 * Product Tags Widget with Custom HTML Structure
 */
class Egns_Product_Tags_Custom_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'egns_product_tags_custom',
            __('Egns Product Tags (Custom)', 'adking-core'),
            array(
                'description' => __('Displays product tags in custom HTML structure', 'adking-core'),
            )
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : 'Tags';
        $number_of_tags = isset($instance['number_of_tags']) ? absint($instance['number_of_tags']) : 9;

        echo $args['before_widget'];

        if (!empty($title)) {
            echo '<h4 class="widget-title">' . esc_html($title) . '</h4>';
        }

        $tags = get_terms(array(
            'taxonomy'   => 'product_tag',
            'number'     => $number_of_tags,
            'orderby'    => 'count',
            'order'      => 'DESC',
            'hide_empty' => true,
        ));

        if (!empty($tags) && !is_wp_error($tags)) {
            echo '<ul class="tag-list">';

            foreach ($tags as $tag) {
                $tag_link = get_term_link($tag, 'product_tag');

                if (is_wp_error($tag_link)) {
                    continue;
                }

                echo '<li>';
                echo '<a href="' . esc_url($tag_link) . '">' . esc_html($tag->name) . '</a>';
                echo '</li>';
            }

            echo '</ul>';
        } else {
            echo '<p>' . esc_html__('No product tags found.', 'adking-core') . '</p>';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : 'Tags';
        $number_of_tags = isset($instance['number_of_tags']) ? absint($instance['number_of_tags']) : 9;
?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:', 'adking-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number_of_tags')); ?>"><?php echo esc_html__('Number of tags to show:', 'adking-core'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number_of_tags')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_tags')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number_of_tags); ?>" size="3">
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number_of_tags'] = absint($new_instance['number_of_tags']);
        return $instance;
    }
}

function register_egns_product_tags_custom_widget()
{
    register_widget('Egns_Product_Tags_Custom_Widget');
}
add_action('widgets_init', 'register_egns_product_tags_custom_widget');
