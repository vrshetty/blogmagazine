<?php

/*
 * BlogMagazine Sanitize Switch Option
 */
if( !function_exists('blogmagazine_sanitize_switch_option') ):
	
	function blogmagazine_sanitize_switch_option($switch_value){

		return esc_attr($switch_value);

	}

endif;