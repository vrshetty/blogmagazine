<?php 
/*
 * MegaMenu Fields List
 */
if(!function_exists('dglib_megamenu_field_list')):

	function dglib_megamenu_field_list(){
		$megamenu_field_list = array(
			array(
				'name' => 'menu_icon',
				'type' => 'icon',
				'label'=> esc_html__('Menu Icon', 'blogmagazine'),
				'description' => esc_html__('Choose icons for to show in navigation menu.', 'blogmagazine'),
			),
			array(
				'name' => 'description_tips',
				'type' => 'checkbox',
				'label'=> esc_html__('Description as title tips.', 'blogmagazine'),
				'description' => esc_html__('Show description as tool tips.', 'blogmagazine'),
			),
			array(
				'name' => 'enable_megamenu',
				'type' => 'checkbox',
				'label'=> esc_html__('Enable Megamenu', 'blogmagazine'),
				'description' => esc_html__('Enabel megamneu to show megamenu with the replacement of normal menu.', 'blogmagazine'),
			),
			array(
				'name' => 'megamenu_categories',
				'type' => 'termsmulti',
				'taxonomy' => 'category',
				'label'=> esc_html__('Select Categories', 'blogmagazine'),
				'description' => esc_html__('Choose multiple categories to show megamenu.', 'blogmagazine'),
			),
			
		);
		return apply_filters( 'dglib_megamenu_field_list', $megamenu_field_list );
	}

endif;

if(!function_exists('dglib_mega_menu_item_form')):

	function dglib_mega_menu_item_form( $id, $item, $depth, $args ) {
		$megamenu_options = 'menu-item-dglib-megamenu';
		$megamenu_values = get_post_meta($item->ID, $megamenu_options, true);
		$megamenu_fields = dglib_megamenu_field_list();
		?><div class="dglib-megamenu-wrapper" style="clear:both; overflow:hidden;"><?php 
		foreach($megamenu_fields as $single_field){
			$name = (isset($single_field['name'])) ? esc_attr($single_field['name']) : '';
			$type = (isset($single_field['type'])) ? esc_attr($single_field['type']) : '';
			$label = (isset($single_field['label'])) ? esc_attr($single_field['label']) : '';
			$description = (isset($single_field['description'])) ? esc_attr($single_field['description']) : '';
			$value = (isset($megamenu_values[$name])) ? $megamenu_values[$name] : '';
			$id    = sprintf( 'edit-%s-%s-%s', $megamenu_options, $item->ID, $name);
			$field_name  = sprintf( '%s[%s][%s]', $megamenu_options, $item->ID, $name );
			$class = sprintf( 'dglib-megamenu field-%s', $name );
			switch ($type) {
				case 'checkbox':
				?>
				<div class="dg-menu-field-wrapper field-<?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?>-wide <?php echo esc_attr( $class ) ?>">
					<label for="<?php echo esc_attr( $id ); ?>">
						<input type="checkbox" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr($field_name); ?>" value="1" <?php checked( $value ); ?> /><?php echo esc_html( $label ); ?>
					</label>
					<?php 
					if($description){
						?><div class="widefat delib-description-wrapper"><span class="description"><?php echo esc_html($description); ?></span></div><?php
					} 
					?>
				</div>
				<?php
				break;
				case 'icon':
				?>
				<div class="dg-menu-field-wrapper dg-icons-wrapper">
					<div class="dglib-icon-header">
						<div class="dg-icon-preview">
							<?php if( !empty( $value ) ) { echo '<i class="fa '. esc_attr( $value ).'"></i>'; } ?>
						</div>
						<div class="remove-icon">
							<?php esc_html_e('Remove', 'blogmagazine'); ?>
							<span class="dashicons dashicons-no"></span>
						</div>
						<div class="icon-toggle">
							<?php esc_html_e('Icon List','blogmagazine'); ?>
							<span class="dashicons dashicons-arrow-down"></span>
						</div>
					</div>
					<div class="icons-list-wrapper hidden">
						<input class="icon-search widefat" type="text" placeholder="<?php esc_attr_e('Search Icon','blogmagazine')?>">
						<?php
						$dglib_icons_list = dglib_fa_iconslist();
						foreach ( $dglib_icons_list as $single_icon ) {
							if( $value == $single_icon ) {
								echo '<span class="single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
							} else {
								echo '<span class="single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
							}
						}
						?>
					</div>
					<input class="widefat dg-icon-value" id="<?php echo esc_attr( $id ); ?>" type="hidden" name="<?php echo esc_attr($field_name); ?>" value="<?php echo esc_attr( $value ); ?>" placeholder="fa-desktop"/>
					<?php 
					if($description){
						?><div class="widefat delib-description-wrapper"><span class="description"><?php echo esc_html($description); ?></span></div><?php
					} 
					?>
				</div>
				<?php
				break;
				case 'text':
				?>
				<p class="dg-menu-field-wrapper field-<?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?>-wide <?php echo esc_attr( $class ) ?>">
					<label for="<?php echo esc_attr( $id ); ?>">
						<?php echo esc_html( $label ); ?></br>
						<input type="text" class="widefat" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr($field_name); ?>" value="<?php echo esc_attr($value); ?>"/>
					</label>
					<?php 
					if($description){
						?><div class="widefat delib-description-wrapper"><span class="description"><?php echo esc_html($description); ?></span></div><?php
					} 
					?>
				</p>
				<?php
				break;
				case 'termsmulti':
				$taxonomy = (isset($single_field['taxonomy'])) ? esc_attr($single_field['taxonomy']) : '';
				$field_name .= '[]';
				?>
				<div class="dg-menu-field-wrapper field-<?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?>-wide">
					<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label>
					<ul class="dg-multiple-checkbox">
						<?php
						if( taxonomy_exists( $taxonomy ) ){
							$args = array(
								'taxonomy'     => $taxonomy,
								'hide_empty'   => false,
								'number'      => 999,
							);
							$all_terms = get_terms($args);
							if( $all_terms ){
								foreach( $all_terms as $single_term ){
									$tcy_term_id = $single_term->term_id;
									$tcy_term_name = $single_term->name;
									?>
									<li>
										<input 
										id="<?php echo esc_attr( $id.'_'.$taxonomy.'_'.$tcy_term_id ); ?>" 
										name="<?php echo esc_attr( $field_name ); ?>" 
										type="checkbox" 
										value="<?php echo $tcy_term_id; ?>" 
										<?php checked(in_array($tcy_term_id, (array)$value)); ?> 
										/>
										<label for="<?php echo esc_attr( $id.'_'.$taxonomy.'_'.$tcy_term_id ); ?>"><?php echo esc_html( $tcy_term_name ).' ('.$single_term->count.')'; ?></label>
									</li>
									<?php
								}
							}else{
								?><span><?php esc_html_e( 'No terms found in this taxonomy', 'blogmagazine' ); ?></span><?php
							}
						}else{
							?><span><?php esc_html_e( 'Selected taxonomy doesn\'t exist', 'blogmagazine' ); ?></span><?php
						}
						?>
					</ul>
					<?php
					if($description){
						?><div class="widefat delib-description-wrapper"><span class="description"><?php echo esc_html($description); ?></span></div><?php
					}
					?>
				</div>
				<?php
				break;
				default:
				?><p class="dg-menu-field-wrapper field-<?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?> <?php echo esc_attr($name); ?>-wide"><?php echo esc_html__('Field ', 'blogmagazine') . $type . esc_html__( ' not found.', 'blogmagazine'); ?></p><?php
				break;
			}
		}
		?></div><?php
	}
endif;
add_action( 'dglib_mega_menu_item_fields', 'dglib_mega_menu_item_form', 10, 4 );

// Save fields
if(!function_exists('dglib_update_mega_menu_item')):

	function dglib_update_mega_menu_item( $menu_id, $menu_item_db_id, $menu_item_args ) {

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}
		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );
		$megamenu_fields = dglib_megamenu_field_list();
		$megamenu_options = 'menu-item-dglib-megamenu';
		$sanitize_value = array();
		$megamenu_values = (isset($_POST[ $megamenu_options ][ $menu_item_db_id ])) ? $_POST[ $megamenu_options ][ $menu_item_db_id ] : array();
		foreach($megamenu_fields as $single_field){
			$name = (isset($single_field['name'])) ? esc_attr($single_field['name']) : '';
			$type = (isset($single_field['type'])) ? esc_attr($single_field['type']) : '';
			$value = (isset($megamenu_values[$name])) ? $megamenu_values[$name] : '';
			switch ($type) {
				case 'checkbox':
				$sanitize_value[$name] = absint($value);
				break;
				case 'termsmulti':
				$sanitize_value[$name] = array();
				foreach((array)$value as $index=>$term_id){
					$sanitize_value[$name][] = absint($term_id);
				}
				$sanitize_value[$name] = array_unique($sanitize_value[$name]);
				break;
				default:
				$sanitize_value[$name] = esc_attr($value);
				break;
			}
		}
		update_post_meta( $menu_item_db_id, $megamenu_options, $sanitize_value );

	}
endif;
add_action( 'wp_update_nav_menu_item', 'dglib_update_mega_menu_item', 10, 3 );

if(!function_exists('dglib_edit_mega_menu_walker')):

	function dglib_edit_mega_menu_walker( $walker ) {
		$megamenu_walker = 'Dglib_Walker_Mega_Menu_Edit';
		if(class_exists($megamenu_walker)){
			return $megamenu_walker;
		}
		return $walker;
	}

endif;
add_filter( 'wp_edit_nav_menu_walker', 'dglib_edit_mega_menu_walker', 10, 1 );


if(!function_exists('dglib_navmenu_args_filter')):

	function dglib_navmenu_args_filter($args){

		$args['walker'] = new Dglib_Walker_Mega_Menu();
		return $args;

	}

endif;
add_filter( 'wp_nav_menu_args', 'dglib_navmenu_args_filter', 10, 1);
