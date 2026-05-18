<?php
/*
Plugin Name: Adking Core
Plugin URI: https://www.egenslab.com/
Description: Adking core plugin is a elementor widget based plugin.
Author: Egens Lab
Author URI: https://www.egenslab.com/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Version: 1.0.0
Text Domain: adking-core
Domain Path: /languages
*/

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The main plugin class
 */
final class Egns_Core
{
    /**
     * Plugin version
     */
    const version = '1.0.0';

    /**
     * Class constructor
     */
    private function __construct()
    {
        $this->egns_core_define_constants();

        register_activation_hook(__FILE__, [$this, 'egns_core_activate']);

        /**
         * Load translation on init or later.
         * Fixes WordPress 6.7+ _load_textdomain_just_in_time notice.
         */
        add_action('init', [$this, 'egns_core_load_textdomain']);

        /**
         * Load plugin files after plugins_loaded,
         * so translation functions do not run too early.
         */
        add_action('plugins_loaded', [$this, 'egns_core_init']);
    }

    /**
     * Initializes a singleton instance
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define plugin constants
     */
    public function egns_core_define_constants()
    {
        define('EGNS_CORE_ENV', true);
        define('EGNS_CORE_ROOT_PATH', plugin_dir_path(__FILE__));
        define('EGNS_CORE_ROOT_URL', plugin_dir_url(__FILE__));
        define('EGNS_CORE_VERSION', self::version);
        define('EGNS_CORE_INC', EGNS_CORE_ROOT_PATH . 'inc');
        define('EGNS_CORE_LIB', EGNS_CORE_ROOT_PATH . 'lib');
        define('EGNS_CORE_INC_ASSETS', EGNS_CORE_ROOT_URL . 'inc/assets');
        define('EGNS_CORE_THEME_OPTIONS', EGNS_CORE_INC . '/theme-options');
        define('EGNS_CORE_DEMO_IMPORT', EGNS_CORE_ROOT_PATH . 'demo-data-import');
        define('EGNS_CORE_THEME_OPTIONS_IMAGES', EGNS_CORE_ROOT_URL . 'inc/theme-options/images');

        define('EGNS_CORE_THEME_CSS', get_template_directory_uri() . '/assets/css');
    }

    /**
     * Load plugin textdomain
     */
    public function egns_core_load_textdomain()
    {
        load_plugin_textdomain(
            'adking-core',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages'
        );
    }

    /**
     * Include required files
     */
    public function egns_core_require_files()
    {
        $includes_files = array(
            array(
                'file-name'   => 'functions',
                'folder-name' => EGNS_CORE_ROOT_PATH . 'helpers',
            ),
            array(
                'file-name'   => 'helper',
                'folder-name' => EGNS_CORE_ROOT_PATH . 'helpers',
            ),
            array(
                'file-name'   => 'codestar-framework',
                'folder-name' => EGNS_CORE_LIB . '/codestar-framework',
            ),
            array(
                'file-name'   => 'elementor',
                'folder-name' => EGNS_CORE_INC . '/elementor',
            ),
            array(
                'file-name'   => 'cpt',
                'folder-name' => EGNS_CORE_INC . '/custom-post',
            ),
            array(
                'file-name'   => 'theme-options',
                'folder-name' => EGNS_CORE_INC . '/theme-options',
            ),
            array(
                'file-name'   => 'menu',
                'folder-name' => EGNS_CORE_INC . '/theme-options/megamenu',
            ),
            array(
                'file-name'   => 'custom-css',
                'folder-name' => EGNS_CORE_THEME_OPTIONS . '/custom-css',
            ),
            array(
                'file-name'   => 'class-search-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'class-popular-post-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'class-category-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'class-blog-tag-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'class-table-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'class-product-category-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'class-product-tag-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'class-table-cnt-widget',
                'folder-name' => EGNS_CORE_INC . '/wp-widget',
            ),
            array(
                'file-name'   => 'widget',
                'folder-name' => EGNS_CORE_INC . '/widget',
            ),
            array(
                'file-name'   => 'demo-importer',
                'folder-name' => EGNS_CORE_DEMO_IMPORT,
            ),
        );

        foreach ($includes_files as $file) {
            $file_path = trailingslashit($file['folder-name']) . $file['file-name'] . '.php';

            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }
    }

    /**
     * Initialize plugin
     */
    public function egns_core_init()
    {
        $this->egns_core_require_files();

        if (class_exists('\Egns_Core\Egns_Elementor')) {
            new \Egns_Core\Egns_Elementor();
        }
    }

    /**
     * Plugin activation
     */
    public function egns_core_activate()
    {
        // Do something when plugin activates.
    }
}

/**
 * Initialize main plugin
 */
function egns_core()
{
    return Egns_Core::init();
}

egns_core();
