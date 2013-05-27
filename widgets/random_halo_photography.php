<?php
/**
 * Adds Snaver_Random_Halo_Photography widget.
 */
class Snaver_Random_Halo_Photography extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'random_halo_photography', // Base ID
			'Random Halo Photography', // Name
			array( 'description' => 'Random Halo Photography Photos') // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
				
		$photos = new WP_Query(array(
                   'orderby' => 'rand',
                   'post_type' => 'halo_photography',
                   'posts_per_page' => 2
                ));
			
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		echo '<ul id="widget_halo_photos">';
		if ( $photos->have_posts() ) : while ( $photos->have_posts() ) : $photos->the_post();
		?>
        	<li class="clearfix">
                	<?php $img_alt = get_the_title().' Thumbnail'; ?>
                        <a href="<?php the_permalink() ?>" title="View full sized image <?php the_title_attribute(); ?>" class="item clearfix">
                        <?php the_post_thumbnail( 'medium', array('alt' => $img_alt, 'title' => $img_alt) ); ?>
                        </a>
	        </li>
		<?php
		endwhile; else: ?>
			<li>Sorry, no photos.</li>
		<?php endif;
		echo '</ul>';
		echo $after_widget;
		
		// Reset Post Data
		wp_reset_postdata();
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = 'Halo Photography';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}

} // class H2H_Latest_News_Widget