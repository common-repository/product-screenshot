<?php
 /**
 * Product screenshot post type.
 *
 * Handle all post content of the plugin.
 *
 * @since 1.0.0
 */

class Prscrt_Custom_Post{

    public function __construct() {
        add_action( 'init', array($this,'custom_post_register'));
    }

    function custom_post_register(){
        // Register Product Screenshot Post Type
        $labels = array(
            'name'                  => _x( 'Product Screenshot', 'Post Type General Name', 'product-screenshot' ),
            'all_items'     => __( 'All Product Screenshot', 'product-screenshot' ),
            'parent_item_colon'     => __( 'Parent Product Screenshot:', 'product-screenshot' ),
            'add_new_item'          => __( 'Add New Product Screenshot', 'product-screenshot' ),
            'add_new'               => __( 'Add New', 'product-screenshot' ),
            'new_item'              => __( 'New Screenshot', 'product-screenshot' ),
            'edit_item'             => __( 'Edit Screenshot', 'product-screenshot' ),
            'update_item'           => __( 'Update Screenshot', 'product-screenshot' ),
            'view_item'             => __( 'View Screenshot', 'product-screenshot' ),
            'search_items'          => __( 'Search Screenshot', 'product-screenshot' ),
            'not_found'             => __( 'Not found', 'product-screenshot' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'product-screenshot' ),
            'insert_into_item'      => __( 'Insert into item', 'product-screenshot' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'product-screenshot' ),
            'items_list'            => __( 'Screenshot list', 'product-screenshot' ),
            'items_list_navigation' => __( 'Screenshot list navigation', 'product-screenshot' ),
            'filter_items_list'     => __( 'Filter items list', 'product-screenshot' ),
        );
        $args = array(
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-format-gallery',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'prscrt', $args );
    }
}
?>