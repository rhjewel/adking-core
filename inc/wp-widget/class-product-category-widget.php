<?php

/**
 * Product Category Widget with Custom HTML Structure
 */
class Egns_Product_Category_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'egns_product_category',
            __('Egns Product Category', 'adking-core'),
            array(
                'description' => __('Displays product categories with custom SVG icon', 'adking-core'),
            )
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : 'Category';
        $number_of_categories = isset($instance['number_of_categories']) ? absint($instance['number_of_categories']) : 10;

        echo $args['before_widget'];

        if (!empty($title)) {
            echo '<h4 class="widget-title">' . esc_html($title) . '</h4>';
        }

        function adking_product_category_tree($parent_id = 0, $limit = 0)
        {
            $args = array(
                'taxonomy'   => 'product_cat',
                'orderby'    => 'count',
                'order'      => 'ASC',
                'hide_empty' => true,
                'parent'     => $parent_id,
            );

            // Apply limit ONLY for top-level
            if ($parent_id === 0 && $limit > 0) {
                $args['number'] = $limit;
            }

            $categories = get_terms($args);

            if (empty($categories) || is_wp_error($categories)) {
                return;
            }

            echo '<ul class="category-list' . ($parent_id ? ' child-category-list' : '') . '">';

            foreach ($categories as $category) {
                echo '<li class="category-item">';

                echo '<a href="' . esc_url(get_term_link($category)) . '">';
                echo '<span>' . esc_html($category->name) . ' (' . esc_html($category->count) . ')</span>';
                echo '</a>';

                // Child (no limit)
                adking_product_category_tree($category->term_id, 0);

                echo '</li>';
            }

            echo '</ul>';
        }

        // Call with limit
        adking_product_category_tree(0, $number_of_categories);

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : 'Category';
        $number_of_categories = isset($instance['number_of_categories']) ? absint($instance['number_of_categories']) : 6;
?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:', 'adking-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number_of_categories')); ?>"><?php echo esc_html__('Number of categories to show:', 'adking-core'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number_of_categories')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_categories')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number_of_categories); ?>" size="3">
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number_of_categories'] = absint($new_instance['number_of_categories']);
        return $instance;
    }
}

// Register the widget
function register_egns_product_category_widget()
{
    register_widget('Egns_Product_Category_Widget');
}
add_action('widgets_init', 'register_egns_product_category_widget');
