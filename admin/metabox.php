<?php 
/**
 * Product screenshot meta Fileds.
 *
 * Handle all meta field options of the plugin.
 *
 * @since 1.0.0
 */

 class Prscrt_Meta_Box{
	public function __construct(){
		$this->meta_fields();
	}

	function meta_fields(){
		$post_id = '';
		if ( isset( $_GET['post'] ) ) {
			$post_id = intval( $_GET['post'] );
		} elseif ( isset( $_POST['post_ID'] ) ) {
			$post_id = intval( $_POST['post_ID'] );
		}

		// Control core classes for avoid errors
		if( class_exists( 'CSF' ) ) {
			// Set a unique slug-like ID
			$prefix = 'prscrt_meta_fields';

			// Create a metabox
			CSF::createMetabox( $prefix, array(
				'title'     => __('Screenshot Options','product-screenshot'),
				'post_type' => 'prscrt',
			) );

			// Create a section
			CSF::createSection( $prefix, array(
				//'title'  => 'Screenshot Content',
				'fields' => array(
					array(
						'id'        => 'screenshot-list',
						'type'      => 'group',
						'title'     => __('Screenshots Items','product-screenshot'),
						'button_title'     => __('Add New Item','product-screenshot'),
						'class'     =>'prscrt-group-section',
						'fields'    => array(
							array(
								'id'      => 'screenshot-title',
								'type'    => 'text',
								'title'   => __('Screenshot Title','product-screenshot'),
								'default' => __('','product-screenshot'),
							),
							array(
								'id'    => 'screenshot-link',
								'type'  => 'link',
								'title'   => __(' External Link','product-screenshot'),
							  ),
							array(
								'id'    => 'screenshot-img',
								'type'  => 'media',
								'title' => __('Screenshot Image','product-screenshot'),
							),
						),
						'default'=>array(
							array(
								'screenshot-img'=>'',
								'screenshot-title'=>'',
							),
						),
					),
					array(
						'id'      => 'shortcode_output',
						'type'    => 'text',
						'title'   => __('Shortcode','product-screenshot'),
						'subtitle' => __('Copy the shortcode and paste it on the page where you want to show the screenshots.','product-screenshot'),
						'class' => 'prscrt-shortcode-field',
						'after' => '[prscrt-screenshot id="" column="" show-item="" load-item="" image-height="" margin-bottom="" gutter="" title=""]',

						'attributes' => array(
							'placeholder' => '[prscrt-screenshot id="' . $post_id . '"]',
							'data-prscrt-id' => $post_id,
						),
					),
				),
			));
		}
	}
 }