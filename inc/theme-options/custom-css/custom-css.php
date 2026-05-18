<?php
// exit if access directly
if (!defined('ABSPATH')) {
    exit();
}

function egnsCustomStyling()
{

    $custom_css         = "";
    $egns_theme_options = get_option('egns_theme_options');
    $egns_page_options  = get_post_meta(get_the_ID(), 'egns_page_options', true);

    /**************************
     * Primary Color Start
     *************************/

    $primary_main_color = $egns_theme_options['primary_theme_color'] ?? '';
    $primary_opc_color  = $egns_theme_options['primary_theme_color_opc'] ?? '';

    // Get hex color 
    $hex = $primary_opc_color;

    // Remove the '#' if present
    $hex = ltrim($hex, '#');

    // Convert the hex to RGB values
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));


    if (!empty($primary_main_color)) {
        $custom_css .= "
         :root{
                --primary-color1: $primary_main_color !important;
                --primary-color2: $primary_main_color !important;
              }
          ";
    }

    if (!empty($primary_opc_color)) {
        $custom_css .= "
         :root{
                 --primary-color1-opc: $r, $g, $b !important;
                 --primary-color2-opc: $r, $g, $b !important;
              }
          ";
    }

    /**************************
     * Primary Color End
     *************************/




    /**************************
     * Primary Fonts Start
     *************************/

    $font_intetight = $egns_theme_options['font_intetight']['font-family'] ?? '';
    if (!empty($font_intetight)) {
        $custom_css .= "
         :root{
                 --font-inteTight: '$font_intetight', sans-serif !important;
              }
          ";
    }

    $font_poppins = $egns_theme_options['font_poppins']['font-family'] ?? '';
    if (!empty($font_poppins)) {
        $custom_css .= "
         :root{
                 --font-poppins: '$font_poppins', sans-serif !important;
              }
          ";
    }


    /**************************
     * Primary Fonts End
     *************************/



    /************************
     * Start Breadcrumb Style
     ************************/

    //Breadcrumb BG Color
    $breadcump_color_background = $egns_theme_options['breadcrumb_background_color'] ?? '';
    $breadcump_page_color_background   = $egns_page_options['breadcrumb_page_bg_color'] ?? '';

    if (!empty($breadcump_page_color_background)) {
        $custom_css .= "
        .breadcrumb-section {
            background-color: $breadcump_page_color_background !important;
        }
    ";
    } else {
        if (!empty($breadcump_color_background)) {
            $custom_css .= "
            .breadcrumb-section {
                background-color: $breadcump_color_background !important;
            }
        ";
        }
    }


    // Breadcrumb BG Image
    $breadcump_background_image      = $egns_theme_options['breadcrumb_bg_image']['url'] ?? '';
    $breadcump_page_background_image = $egns_page_options['breadcrumb_page_bg_image']['url'] ?? '';

    $meta = get_post_meta(get_the_ID(), 'EGNS_PEOPLE_META_ID', true);
    $secondary_thumbnail = $meta['secondary_thumbnail']['url'] ?? '';

    $breadcrumb_bg_url = '';

    // Priority 1: Single post thumbnail
    if (is_singular('post') && has_post_thumbnail()) {
        $breadcrumb_bg_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    }
    // Priority 2: Single people post thumbnail
    elseif (is_singular('people')) {
        $breadcrumb_bg_url = $secondary_thumbnail;
    }
    // Priority 3: Page breadcrumb image
    elseif (!empty($breadcump_page_background_image)) {
        $breadcrumb_bg_url = $breadcump_page_background_image;
    }
    // Priority 4: Default breadcrumb image
    elseif (!empty($breadcump_background_image)) {
        $breadcrumb_bg_url = $breadcump_background_image;
    }

    if (!empty($breadcrumb_bg_url)) {
        $custom_css .= "
        .breadcrumb-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('" . esc_url($breadcrumb_bg_url) . "') !important;
        }
    ";
    }

    /*********************
     * End Breadcrumb
     *********************/




    wp_register_style('egns-stylesheet', false);
    wp_enqueue_style('egns-stylesheet', false);
    wp_add_inline_style('egns-stylesheet', $custom_css);
}

if (class_exists('CSF')) {
    add_action('wp_enqueue_scripts', 'egnsCustomStyling');
}
