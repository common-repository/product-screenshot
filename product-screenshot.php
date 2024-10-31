<?php
/**
 * Plugin Name: Product Screenshot
 * Description: Product Screenshot Gallery
 * Plugin URI: https://hasthemes.com/plugins/
 * Version: 1.0.3
 * Author: hasthemes
 * Author URI: https://hasthemes.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: product-screenshot
 * Domain Path: /languages
 */

// If this file is accessed directly, exit
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main Product screenshot class
 *
 * @since 1.0.0
 */

final class Prscrt_Product_Screenshot {

    /**
     * Product screenshot version
     *
     * @since 1.0.0
     */
    public $version = '1.0.3';

    /**
     * The single instance of the class
     *
     * @since 1.0.0
     */
    protected static $_instance = null;

    /**
     * Main Prscrt Instance
     *
     * Ensures only one instance of Prscrt is loaded or can be loaded
     *
     * @since 1.0.0
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Prscrt Constructor
     *
     * @since 1.0.0
     */
    private function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init();
    }

    /**
     * Define the required constants
     *
     * @since 1.0.0
     */
    private function define_constants() {
        define( 'PRSCRT_VERSION', $this->version );
        define( 'PRSCRT_FILE', __FILE__ );
        define( 'PRSCRT_PATH', __DIR__ );
        define( 'PRSCRT_URL', plugins_url( '', PRSCRT_FILE ) );
        define( 'PRSCRT_ASSETS', PRSCRT_URL . '/assets' );
        define( 'PRSCRT_PL_URL', plugins_url( '/', __FILE__ ) );
    }

    /**
     * Include files
     *
     * @since 1.0.0
     */
    public function includes() {

        /**
         * Including Codestar Framework.
         */
        if ( ! class_exists( 'CSF' ) ) {
            require_once PRSCRT_PATH .'/includes/libs/codestar-framework/codestar-framework.php';
        }   

        /**
         * Load files
         */
        require_once PRSCRT_PATH.'/admin/Recommended_Plugins.php';
        require_once PRSCRT_PATH.'/admin/class-recommendation-plugins.php';
        require_once PRSCRT_PATH.'/admin/custom-post-type.php';
        require_once PRSCRT_PATH.'/admin/metabox.php';
        require_once PRSCRT_PATH.'/admin/admin-options.php';
        require_once PRSCRT_PATH.'/admin/post-column.php';
        require_once PRSCRT_PATH . '/includes/shortcode.php';
        /**
         * Enqueue files 
         */
        
        add_action( 'wp_enqueue_scripts',array( $this, 'prscrt_enqueue_scripts' ) );
        add_action('admin_enqueue_scripts', array( $this, 'prscrt_admin_scripts' ));
    }

    public function init(){
        $this->load_plugin_textdomain();

        new Prscrt_Options();
        new Prscrt_Custom_Post();
        new Prscrt_Meta_Box();
        new Prscrt_Posts_Column();
        new Prscrt_Shortcode();
    }
    public function prscrt_enqueue_scripts(){
        global $post;
        $editor_mode_check = false;
        if( class_exists( '\Elementor\Plugin' ) && ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) ){
            $editor_mode_check = true;
        }

        if ( ( is_object( $post ) && isset( $post->post_content ) && has_shortcode( $post->post_content, 'prscrt-screenshot' ) ) || $editor_mode_check ) {
            // enqueue styles
            wp_enqueue_style( 'lightgallery', PRSCRT_ASSETS . '/css/plugins/lightgallery.min.css' );
            wp_enqueue_style( 'prscrt-style', PRSCRT_ASSETS . '/css/style.css');
            // enqueue js
            wp_enqueue_script( 'lightgallery', PRSCRT_ASSETS . '/js/plugins/lightgallery.min.js', array('jquery'), '1.6.12', true);   
            wp_enqueue_script( 'prscrt-main', PRSCRT_ASSETS . '/js/main.js', array('jquery'), PRSCRT_VERSION, true);   
        }
    }

    public function prscrt_admin_scripts() {
        wp_enqueue_style( 'prscrt-admin-style', PRSCRT_ASSETS . '/css/admin.css'); 
        wp_enqueue_script( 'prscrt-main', PRSCRT_ASSETS . '/js/admin-main.js', array('jquery'), PRSCRT_VERSION, true); 
    }

    /**
     * Load the plugin textdomain
     *
     * @since 1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( 'product-screenshot', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }
}

/**
 * Returns the main instance of Prscrt
 *
 * @since 1.0.0
*/

/**
 * Init Main Plugin
 */
function prscrt_product_screenshot() {
    return Prscrt_Product_Screenshot::instance();
}
/**
 * Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
 */
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
    add_action( 'plugins_loaded', 'prscrt_product_screenshot', 90 );
} else {
    prscrt_product_screenshot();
}