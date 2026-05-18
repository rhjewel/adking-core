<?php

/**
 * Table of contents widget with custom HTML structure.
 */
class Egns_Table_Cnt_Custom_Widget extends WP_Widget
{
    const MAX_ITEMS = 10;

    function __construct()
    {
        parent::__construct(
            'egns_table_cnt_custom',
            __('Egns Table of Contents', 'adking-core'),
            array(
                'description' => __('Displays table of contents links with custom section targets.', 'adking-core'),
            )
        );
    }

    public function widget($args, $instance)
    {
        $title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : __('Table of Content', 'adking-core');
        $items = $this->get_items($instance);

        echo $args['before_widget'];
?>

        <div class="table-content-area">
            <?php if (!empty($title)) : ?>
                <h4><?php echo esc_html($title); ?></h4>
            <?php endif; ?>

            <?php if (!empty($items)) : ?>
                <ul>
                    <?php foreach ($items as $index => $item) : ?>
                        <li><?php echo esc_html($index + 1); ?>.
                            <div class="content" data-target="<?php echo esc_attr($item['target']); ?>">
                                <span><?php echo esc_html($item['label']); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

    <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : __('Table of Content', 'adking-core');
        $items = $this->get_items($instance);
        $items = array_pad($items, self::MAX_ITEMS, array('label' => '', 'target' => ''));
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html__('Title:', 'adking-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p><?php echo esc_html__('Add each sidebar item label and the matching section ID from the post content, for example #section1.', 'adking-core'); ?></p>

        <?php for ($i = 0; $i < self::MAX_ITEMS; $i++) : ?>
            <p>
                <strong><?php echo esc_html(sprintf(__('Item %d', 'adking-core'), $i + 1)); ?></strong>
                <label for="<?php echo esc_attr($this->get_field_id('items_' . $i . '_label')); ?>"><?php echo esc_html__('Label:', 'adking-core'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_' . $i . '_label')); ?>" name="<?php echo esc_attr($this->get_field_name('items')); ?>[<?php echo esc_attr($i); ?>][label]" type="text" value="<?php echo esc_attr($items[$i]['label']); ?>" />
                <label for="<?php echo esc_attr($this->get_field_id('items_' . $i . '_target')); ?>"><?php echo esc_html__('Target ID:', 'adking-core'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_' . $i . '_target')); ?>" name="<?php echo esc_attr($this->get_field_name('items')); ?>[<?php echo esc_attr($i); ?>][target]" type="text" value="<?php echo esc_attr($items[$i]['target']); ?>" placeholder="#section<?php echo esc_attr($i + 1); ?>" />
            </p>
        <?php endfor; ?>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = isset($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['items'] = $this->sanitize_items(isset($new_instance['items']) ? $new_instance['items'] : array());

        return $instance;
    }

    private function get_items($instance)
    {
        if (isset($instance['items']) && is_array($instance['items'])) {
            return $this->sanitize_items($instance['items']);
        }

        return $this->default_items();
    }

    private function default_items()
    {
        return array(
            array('label' => __('Overview of Global Tax Law.', 'adking-core'), 'target' => '#section1'),
            array('label' => __('Quotation of Andreson.', 'adking-core'), 'target' => '#section2'),
            array('label' => __('Why Cost Control Is Critical for Industrial Businesses.', 'adking-core'), 'target' => '#section3'),
            array('label' => __('Key Cost Control Strategies.', 'adking-core'), 'target' => '#section4'),
            array('label' => __('Business Benefits of Smart Cost Control.', 'adking-core'), 'target' => '#section5'),
            array('label' => __('Conclusion', 'adking-core'), 'target' => '#section6'),
        );
    }

    private function sanitize_items($items)
    {
        $sanitized_items = array();

        foreach ($items as $item) {
            $label = isset($item['label']) ? sanitize_text_field($item['label']) : '';
            $target = isset($item['target']) ? $this->sanitize_target($item['target']) : '';

            if ('' === $label || '' === $target) {
                continue;
            }

            $sanitized_items[] = array(
                'label' => $label,
                'target' => $target,
            );

            if (count($sanitized_items) >= self::MAX_ITEMS) {
                break;
            }
        }

        return $sanitized_items;
    }

    private function sanitize_target($target)
    {
        $target = sanitize_text_field($target);
        $target = preg_replace('/[^A-Za-z0-9_\-#]/', '', $target);
        $target = ltrim($target, '#');

        if ('' === $target) {
            return '';
        }

        return '#' . $target;
    }
}

function register_egns_table_cnt_custom_widget()
{
    register_widget('Egns_Table_Cnt_Custom_Widget');
}
add_action('widgets_init', 'register_egns_table_cnt_custom_widget');
