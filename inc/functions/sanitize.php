<?php

/*
 * BlogMagazine Sanitize show/hide Option
 */
if( !function_exists('blogmagazine_sanitize_show_hide_option') ):
	
	function blogmagazine_sanitize_show_hide_option($customizer_value){
		
		$return_value = 'show';
		switch($customizer_value){
			case 'hide':
			case 'show':
				$return_value = $customizer_value;
				break;
			default:
				$return_value = 'show';
				break;
		}

		return $return_value;

	}

endif;

/*
 * BlogMagazine Sanitize enable/disable Option
 */
if( !function_exists('blogmagazine_sanitize_enable_disable_option') ):
	
	function blogmagazine_sanitize_enable_disable_option($customizer_value){
		
		$return_value = 'enable';
		switch($customizer_value){
			case 'enable':
			case 'disable':
				$return_value = $customizer_value;
				break;
			default:
				$return_value = 'enable';
				break;
		}

		return $return_value;

	}

endif;

/*
 * BlogMagazine Sanitize font awesome icons
 */
if( !function_exists('blogmagazine_sanitize_font_awesome_icons') ):
	
	function blogmagazine_sanitize_font_awesome_icons($customizer_value){

		$all_fa_icon_list = dglib_fa_iconslist();
		if(in_array($customizer_value, $all_fa_icon_list)){ // Check customizer value in fontawesome list
			return $customizer_value;
		}else{
			return ''; // customizer value doesn't match then return empty value
		}

	}

endif;

/*
 * BlogMagazine website layout
 */
if( !function_exists('blogmagazine_sanitize_website_layout') ):
	
	function blogmagazine_sanitize_website_layout($customizer_value){

		$return_value = 'fullwidth_layout';
		switch($customizer_value){
			case 'boxed_layout':
				$return_value = $customizer_value;
				break;
			default:
				$return_value = 'fullwidth_layout';
				break;
		}

		return $return_value;

	}

endif;

/*
 * BlogMagazine list item layout
 */
if( !function_exists('blogmagazine_sanitize_list_item_layout') ):
	
	function blogmagazine_sanitize_list_item_layout($customizer_value){

		$return_value = 'classic';
		switch($customizer_value){
			case 'grid':
				$return_value = $customizer_value;
				break;
			default:
				$return_value = 'classic';
				break;
		}

		return $return_value;

	}

endif;


/*
 * BlogMagazine sanitize tab term list
 */
if( !function_exists('blogmagazine_sanitize_widget_tab_options') ):
	
	function blogmagazine_sanitize_widget_tab_options($widget_value){

		$return_value = 'none';
		switch($widget_value){
			case 'grid':
			case 'selected':
			case 'otherterm':
				$return_value = $widget_value;
				break;
			default:
				$return_value = 'none';
				break;
		}

		return $return_value;

	}

endif;


/*
 * BlogMagazine sanitize tab term list
 */
if( !function_exists('blogmagazine_sanitize_image_size') ):
	
	function blogmagazine_sanitize_image_size($image_size){

		$return_value = 'thumbnail';
		$all_image_size = dglib_get_image_sizes();
		if(isset($all_image_size[$image_size])){
			$return_value = $image_size;
		}
		return $return_value;

	}

endif;

/*
 * BlogMagazine sanitize blockposts widget layout
 */
if( !function_exists('blogmagazine_sanitize_block_post_layout') ):
	
	function blogmagazine_sanitize_block_post_layout($widget_value){

		$return_value = 'layout1';
		switch($widget_value){
			case 'layout1':
			case 'layout2':
			case 'layout3':
			case 'layout4':
				$return_value = $widget_value;
				break;
			default:
				$return_value = 'layout1';
				break;
		}

		return $return_value;

	}

endif;

/*
 * BlogMagazine sanitize carousel widget layout
 */
if( !function_exists('blogmagazine_sanitize_carousel_layout') ):
	
	function blogmagazine_sanitize_carousel_layout($widget_value){

		$return_value = 'layout1';
		switch($widget_value){
			case 'layout1':
				$return_value = $widget_value;
				break;
			default:
				$return_value = 'layout1';
				break;
		}

		return $return_value;

	}

endif;