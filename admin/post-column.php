<?php
/**
 * Product screenshot post column.
 *
 * Handle all post column of the plugin.
 *
 * @since 1.0.0
 */

class Prscrt_Posts_Column{

	public function __construct() {
		add_filter( 'manage_prscrt_posts_columns', array( $this, 'filter_posts_columns' ) );
		add_action( 'manage_prscrt_posts_custom_column', array( $this, 'posts_shortcode_column_content' ), 10, 2 );
	}

	/**
	 * Filter posts columns.
	 *
	 * @since 1.0.0
	 *
	 * @return array Columns array.
	 */
	public function filter_posts_columns( $columns ) {
		$columns = array(
			'cb'        => $columns['cb'],
			'title'     => $columns['title'],
			'shortcode' => esc_html__( 'Shortcode', 'product-screenshot' ),
			'date'      => $columns['date'],
		);

		return $columns;
	}

	/**
	 * Posts shortcode column content.
	 *
	 * @since 1.0.0
	 */
	public function posts_shortcode_column_content( $column, $post_id ) {
		$post_id = absint( $post_id );
		$shortcode = '';

		// Shortcode column
		if ( 'shortcode' === $column ) {
			if ( ! empty( $post_id ) ) {
				$shortcode = '[prscrt-screenshot id="' . esc_html( $post_id ) . '"]';
			} else {
				$shortcode = '';
			}
		}

		echo esc_html( $shortcode );
	}
}