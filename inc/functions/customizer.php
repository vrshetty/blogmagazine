<?php
/*
 * BlogMagazine custoizer extra functions
 */

if( !function_exists('blogmagazine_get_taxonomy_list') ):
	
	function blogmagazine_get_taxonomy_list( $post_type = 'post' ){

		$taxonomy_names = get_object_taxonomies( $post_type, 'names' );

		$taxonomy_list = array_combine($taxonomy_names, $taxonomy_names );
		
		return $taxonomy_list;

	}

endif;