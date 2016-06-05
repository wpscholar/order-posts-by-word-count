<p> <!-- TITLE FOR WIDGET -->
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:' ); ?>
		<input class="widefat"
		       id="<?php echo $this->get_field_id( 'title' ); ?>"
		       name="<?php echo $this->get_field_name( 'title' ); ?>"
		       type="text"
		       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
	</label>
</p>

<p> <!-- SORT ORDER: ASC or DESC -->
	<label for="<?php echo $this->get_field_id( 'sort_order' ); ?>">
		<?php esc_html_e( 'Sort Order:' ); ?> <br/>
		<input <?php checked( $instance['sort_order'] === 'ASC' ); ?>
			id="<?php echo $this->get_field_id( 'sort_order' ) . '_1'; ?>"
			name="<?php echo $this->get_field_name( 'sort_order' ); ?>"
			type="radio"
			value="ASC"/>
		<?php esc_html_e( 'Ascending' ); ?>&nbsp;&nbsp;
		<input <?php checked( $instance['sort_order'] === 'DESC' ); ?>
			id="<?php echo $this->get_field_id( 'sort_order' ) . '_2'; ?>"
			name="<?php echo $this->get_field_name( 'sort_order' ); ?>"
			type="radio"
			value="DESC"/>
		<?php _e( 'Descending' ); ?>
	</label>
</p>

<p> <!-- HTML LIST TYPE: ORDERED or UNORDERED -->
	<label for="<?php echo $this->get_field_id( 'list_type' ); ?>">
		<?php esc_html_e( 'List Type:' ); ?> <br/>
		<input <?php checked( $instance['list_type'] === 'ol' ); ?>
			id="<?php echo $this->get_field_id( 'list_type' ) . '_1'; ?>"
			name="<?php echo $this->get_field_name( 'list_type' ); ?>"
			type="radio"
			value="ol"/>
		<?php esc_html_e( 'Ordered' ); ?>&nbsp;&nbsp;
		<input <?php checked( $instance['list_type'] === 'ul' ); ?>
			id="<?php echo $this->get_field_id( 'list_type' ) . '_2'; ?>"
			name="<?php echo $this->get_field_name( 'list_type' ); ?>"
			type="radio"
			value="ul"/>
		<?php esc_html_e( 'Unordered' ); ?>
	</label>
</p>

<p> <!-- NUMBER OF POSTS TO SHOW -->
	<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>"><?php _e( 'Number of Posts to Show:' ); ?>
		<select id="<?php echo $this->get_field_id( 'num_posts' ); ?>"
		        name="<?php echo $this->get_field_name( 'num_posts' ); ?>"><?php
			for ( $i = 1; $i <= 20; $i ++ ) { ?>
				<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i === $instance['num_posts'] ); ?>>
					<?php echo esc_html( $i ); ?>
				</option>
			<?php } ?>
		</select>
	</label>
</p>