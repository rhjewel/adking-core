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

    protected function register_controls() {}



    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Adking_Ads_Service_Widget());
