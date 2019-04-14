<?php 
/*
 * Reactiions Section Frontend
 */
if(!function_exists('dblib_reaction_icons_callback')):

	function dblib_reaction_icons_callback(){

		$visitor_reaction_heading = get_theme_mod( 'visitor_reaction_heading', false );
		$display_reaction_value = get_theme_mod( 'display_reaction_value', 'percentage' );
		$visitor_reaction_icons_json = get_theme_mod( 'dglib_reaction_icons', false );
		$visitor_reactions_icons_arr = json_decode( $visitor_reaction_icons_json, true );
		if(!$visitor_reactions_icons_arr){
			return;
		}
		$selected_reaction_icon_names = array_unique(array_column($visitor_reactions_icons_arr, 'reaction_icon_name') );
		$visitor_reactions_unique = array_intersect_key( $visitor_reactions_icons_arr, $selected_reaction_icon_names );
		$singular_post_id = get_the_ID();
		$dglib_reaction_details = array();
		foreach($selected_reaction_icon_names as $icon_name){
			$dglib_reaction_details[$icon_name] = absint(get_post_meta( $singular_post_id, 'dglib_reaction_'.$icon_name.'_values', true ) );
		}
		?>
		<section id="reactionblock" class="dblib-reaction-wrapper" >
			<div class="dglib-section-container">
				<h2 class='dblib-reaction-header'><?php echo esc_html($visitor_reaction_heading); ?></h2>
				<?php if($visitor_reactions_unique): ?>
					<ul class="dglib-reaction-list">
						<?php
						foreach($visitor_reactions_unique as $reaction_key => $reaction_details ){
							$reaction_icon_name = isset($reaction_details['reaction_icon_name']) ? esc_attr($reaction_details['reaction_icon_name']) : '';
							$reaction_icon_title = isset($reaction_details['reaction_icon_title']) ? esc_attr($reaction_details['reaction_icon_title']) : '';
							if(!$reaction_icon_name){
								continue;
							}
							$reaction_args = array(
								'type'		=> 'POST',
								'dataType'	=> 'json',
								'url' 		=> admin_url('admin-ajax.php'),
								'data' => array(
									'action'				=> 'dglib_reaction_data',
									'singular_post_id'		=> $singular_post_id,
									'reaction_icon_name' 	=> $reaction_icon_name,
									'reaction_prev_icon' 	=> '',
									'reaction_icon_nonce'	=> wp_create_nonce( 'dglib_post_reaction_nonce' )
								)
							);
							?>
							<li class="dglib-reaction-single-item" data-reaction-config='<?php echo esc_attr(json_encode($reaction_args) ); ?>' title="<?php echo esc_attr($reaction_icon_title); ?>">
								<div class="reaction-item-wrapper">
									<span class="dblib-reaction-count"><?php 
									switch ($display_reaction_value){
										case 'percentage':
										echo ($dglib_reaction_details[$reaction_icon_name]) ? round(( $dglib_reaction_details[$reaction_icon_name]/array_sum($dglib_reaction_details)  * 100 )) . '%' : $dglib_reaction_details[$reaction_icon_name] . '%';
										break;
										default:
										echo absint($dglib_reaction_details[$reaction_icon_name]); 
										break;
									}
									?></span>
									<figure class="dblib-reaction-image-wrap">
										<?php if($reaction_icon_name): ?>
											<img src="<?php echo dglib_directory_uri('assets/img/reactions/'.$reaction_icon_name.'.png') ?>" alt="<?php echo esc_attr($reaction_icon_title); ?>" title="<?php echo esc_attr($reaction_icon_title); ?>"/>
										<?php endif; ?>
									</figure>
									<em class="dglib-reaction-label"><?php echo esc_html($reaction_icon_title); ?></em>
								</div>
							</li>
						<?php } ?>
					</ul>
				<?php endif; ?>
			</div>
		</section>
		<?php
		
	}

endif;
add_action('dblib_reaction_section_icons', 'dblib_reaction_icons_callback' );