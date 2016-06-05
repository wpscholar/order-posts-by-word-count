<?php

/*
* Plugin Name: Order Posts by Word Count
* Plugin URI: https://wpscholar.com/wordpress-plugins/order-posts-by-word-count/
* Description: Creates a widget that lists posts in order by word count.  Posts can be sorted in ascending or descending order and you can select how many posts you want to show. Widget can be used in the sidebar or any widgetized area.
* Version: 1.2.1
* Author: Micah Wood
* Author URI: https://wpscholar.com
*/

/**
 * Class Order_Posts_By_Word_Count
 */
class Order_Posts_By_Word_Count extends WP_Widget {

	function __construct() {
		parent::__construct(
			false,
			__( 'Order Posts by Word Count' ),
			array(
				'classname'   => 'widget_' . strtolower( get_class( $this ) ),
				'description' => __( 'Shows a list of posts ordered by word count.' )
			)
		);
	}

	function form( $instance ) {
		// set form variables
		$instance = wp_parse_args( (array) $instance, array(
			'title'      => '',
			'sort_order' => 'DESC',
			'num_posts'  => 10,
			'list_type'  => 'ul'
		) );
		// include options form
		include( dirname( __FILE__ ) . '/options.php' );
	}

	function update( $new_instance, $old_instance ) { // processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( $new_instance['sort_order'] === 'ASC' ) {
			$instance['sort_order'] = 'ASC';
		} else {
			$instance['sort_order'] = 'DESC';
		}
		if ( $new_instance['list_type'] === 'ol' ) {
			$instance['list_type'] = 'ol';
		} else {
			$instance['list_type'] = 'ul';
		}
		if ( 1 <= $new_instance['num_posts'] && $new_instance['num_posts'] <= 20 ) {
			$instance['num_posts'] = absint( $new_instance['num_posts'] );
		} else {
			$instance['num_posts'] = 10;
		}

		return $instance;
	}

	function widget( $args, $instance ) { // outputs the widget

		/**
		 * @var wpdb $wpdb
		 */
		global $wpdb;
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$order = $instance['sort_order'];

		$sql = <<<SQL
SELECT ID, post_title FROM {$wpdb->prefix}posts 
WHERE post_type = 'post' AND post_status = 'publish' 
ORDER BY LENGTH(post_content) $order LIMIT %d
SQL;
		$results = $wpdb->get_results( $wpdb->prepare( $sql, $instance['num_posts'] ) );

		$list_type = $instance['list_type']; // set list type

		if ( $results ) {
			echo '<' . $list_type . '>'; // return a numbered list of posts
			foreach ( $results as $post ) { ?>
				<li>
					<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
						<?php echo $post->post_title; ?>
					</a>
				</li>
			<?php }
			echo '</' . $list_type . '>';
		}

		echo $args['after_widget'];
	}

}

// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Order_Posts_By_Word_Count");' ) );