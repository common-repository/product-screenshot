<?php
/**
 * Product screenshot admin options.
 *
 * Handle all admin options of the plugin.
 *
 * @since 1.0.0
 */

class Prscrt_Options{

    public function __construct() {

        if( class_exists( 'CSF' ) ) {
         $this->option_fields();
        }
    }
        
    public function option_fields(){
        
            // Set a unique slug-like ID
            $prefix = 'prscrt_option_fields';
            // Create options
            CSF::createOptions( $prefix, array(
                'menu_title' => __('Settings','product-screenshot'),
                'framework_title' =>  __('Product Screenshot Options','product-screenshot'),
                'menu_slug'  => 'prscrt_options',
                'menu_type'   => 'submenu',
                'menu_parent' => 'edit.php?post_type=prscrt',
            ) );
            // Create a section
            CSF::createSection( $prefix, array(
                'fields' => array(
                // A text field
                array(
                    'id'    => 'column',
                    'type'  => 'select',
                    'options'     => array(
                        '1'  =>  __('Column 1','product-screenshot'),
                        '2'  =>  __('Column 2','product-screenshot'),
                        '3'  =>  __('Column 3','product-screenshot'),
                        '4'  =>  __('Column 4','product-screenshot'),
                        '5'  =>  __('Column 5','product-screenshot'),
                        '6'  =>  __('Column 6','product-screenshot'),
                    ),
                    'title' => __('Item Column','product-screenshot'),
                    'subtitle' => __('Select the number of column','product-screenshot'),
                    'default' => 4,
                    'placeholder' => __('Select Column','product-screenshot'),
                    ),
                    array(
                    'id'    => 'gutter',
                    'type'  => 'number',
                    'title' => __('Space between','product-screenshot'),
                    'subtitle' => __('Enter the number of space between(px)','product-screenshot'),
                    'default' => 15,
                    ),
                    array(
                    'id'    => 'margin_bottom',
                    'type'  => 'number',
                    'title' => __('Bottom Space','product-screenshot'),
                    'subtitle' => __('Enter the number of bottom space(px)','product-screenshot'),
                    'default' => 15,
                    ),
                    array(
                    'id'    => 'show_item',
                    'type'  => 'number',
                    'title' => __('Show Items','product-screenshot'),
                    'subtitle' => __('Enter the number of display item','product-screenshot'),
                    'default' => 8,
                    ),
                    array(
                    'id'    => 'load_item',
                    'type'  => 'number',
                    'title' => __('Load More Items','product-screenshot'),
                    'subtitle' => __('Enter the number of load more item','product-screenshot'),
                    'default' => 4,
                    ),
                    array(
                    'id'    => 'image_box_height',
                    'type'  => 'number',
                    'title' => __('Image Height','product-screenshot'),
                    'subtitle' => __('Enter the height of image (px)','product-screenshot'),
                    'default' => 250,
                    ),
                    array(
                    'id'    => 'title_show_hide',
                    'type'  => 'switcher',
                    'title' => __('Title Show/Hide','product-screenshot'),
                    'subtitle' => __('To show/hide the title','product-screenshot'),
                    'default' =>true,
                    ),
                    array(
                        'id'    => 'title_link_view',
                        'type'  => 'switcher',
                        'title' => __('Title External Link Show/Hide','product-screenshot'),
                        'subtitle' => __('To show/hide the title external link','product-screenshot'),
                        'default' =>false,
                        'dependency' => array( 'title_show_hide', '==', 'true' ),
                        ),
                    array(
                    'id'    => 'title_typography',
                    'type'  => 'typography',
                    'title' => __('Title Typography','product-screenshot'),
                    'output' => '.prscrt-gallery-caption,a.prscrt-gallery-caption',
                    'dependency' => array( 'title_show_hide', '==', 'true' ),
                    ),
                    array(
                    'id'    => 'title_color_hover',
                    'type'  => 'color',
                    'title' => __('Title Hover Color','product-screenshot'),
                    'subtitle' => __('Add Title hover color','product-screenshot'),
                    'default' =>'#7456f1',
                    'output' => '.prscrt-gallery-caption:hover,a.prscrt-gallery-caption:hover',
                    'dependency' => array( 'title_show_hide', '==', 'true' ),
                    ),
                    array(
                    'id'    => 'load_more_btn',
                    'type'  => 'text',
                    'title' => __('Load More Button Text','product-screenshot'),
                    'subtitle' => __('Enter the load more button text','product-screenshot'),
                    'default' => 'Load More',
                    ),
                    array(
                    'id'    => 'load_more_color',
                    'type'  => 'color',
                    'title' => __('Button Text Color','product-screenshot'),
                    'subtitle' => __('Add button  text color','product-screenshot'),
                    'default' =>'#ffff',
                    ),
                    array(
                    'id'    => 'load_more_bg',
                    'type'  => 'color',
                    'title' => __('Button BG Color','product-screenshot'),
                    'subtitle' => __('Add button bg color','product-screenshot'),
                    'default' =>'#7456f1',
                    ),
                    array(
                    'id'    => 'load_more_hover_color',
                    'type'  => 'color',
                    'title' => __('Button Text Hover Color','product-screenshot'),
                    'subtitle' => __('Add button text hover color','product-screenshot'),
                    'default' =>'#7456f1',
                    ),
                    array(
                    'id'    => 'load_more_border_color',
                    'type'  => 'color',
                    'title' => __('Button Hover Border Color','product-screenshot'),
                    'subtitle' => __('Add button color','product-screenshot'),
                    'default' =>'#7456f1',
                    ),
                    array(
                    'id'    => 'pre_loader_color',
                    'type'  => 'color',
                    'title' => __('Preloader Color','product-screenshot'),
                    'subtitle' => __('Add preloader color','product-screenshot'),
                    'default' =>'#7456f1',
                    'output_mode' =>'background-color',
                    'output' =>'.prscrt-preloader-wrap .preloader .dot',
                    ),
                    // responsive
                    array(
                    'id'            => 'responsive_options',
                    'type'          => 'tabbed',
                    'title'         => 'Responsive',
                    'tabs'          => array(
                        array(
                        'title'     => 'Tablet',
                        'fields'    => array(
                            array(
                            'id'    => 't_item_column',
                            'type'  => 'select',
                            'options'     => array(
                                '1'  =>  __('Column 1','product-screenshot'),
                                '2'  =>  __('Column 2','product-screenshot'),
                                '3'  =>  __('Column 3','product-screenshot'),
                                '4'  =>  __('Column 4','product-screenshot'),
                                '5'  =>  __('Column 5','product-screenshot'),
                                '6'  =>  __('Column 6','product-screenshot'),
                            ),
                            'title' => __('Item Column','product-screenshot'),
                            'subtitle' => __('Enter the number of column','product-screenshot'),
                            'default' => 3,
                            ),
                            array(
                            'id'    => 't_image_box_height',
                            'type'  => 'number',
                            'title' => __('Image box height','product-screenshot'),
                            'subtitle' => __('Enter the height of image box(px)','product-screenshot'),
                            'default' => 200,
                            ),
                        )
                        ),
                        array(
                        'title'     => 'Large Mobile',
                        'fields'    => array(
                            array(
                            'id'    => 'lm_item_column',
                            'type'  => 'select',
                            'options'     => array(
                                '1'  =>  __('Column 1','product-screenshot'),
                                '2'  =>  __('Column 2','product-screenshot'),
                                '3'  =>  __('Column 3','product-screenshot'),
                                '4'  =>  __('Column 4','product-screenshot'),
                                '5'  =>  __('Column 5','product-screenshot'),
                                '6'  =>  __('Column 6','product-screenshot'),
                            ),
                            'title' => __('Item Column','product-screenshot'),
                            'subtitle' => __('Enter the number of column','product-screenshot'),
                            'default' => 2,
                            ),
                            array(
                            'id'    => 'lm_image_box_height',
                            'type'  => 'number',
                            'title' => __('Image box height','product-screenshot'),
                            'subtitle' => __('Enter the height of image box','product-screenshot'),
                            'default' => 180,
                            ),
                        )
                        ),
                        array(
                        'title'     => 'Mobile',
                        'fields'    => array(
                            array(
                            'id'    => 'm_item_column',
                            'type'  => 'select',
                            'options'     => array(
                                '1'  =>  __('Column 1','product-screenshot'),
                                '2'  =>  __('Column 2','product-screenshot'),
                                '3'  =>  __('Column 3','product-screenshot'),
                                '4'  =>  __('Column 4','product-screenshot'),
                                '5'  =>  __('Column 5','product-screenshot'),
                                '6'  =>  __('Column 6','product-screenshot'),
                            ),
                            'title' => __('Item Column','product-screenshot'),
                            'subtitle' => __('Enter the number of column','product-screenshot'),
                            'default' => 1,
                            ),
                            array(
                            'id'    => 'm_image_box_height',
                            'type'  => 'number',
                            'title' => __('Image box height','product-screenshot'),
                            'subtitle' => __('Enter the height of image box','product-screenshot'),
                            'default' => 180,
                            ),
                        )
                        ),
                    ),
                    ),
                )
            ) );

    }
}