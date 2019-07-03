<?php

if(!function_exists('dglib_assets_url')){
	/**
	 * Function to get dglib assets url
	 * @since 1.0.0
	 * @param $filename
	 * @return assets absolute url
	 */
	function dglib_assets_url($filename){

		$absolute_path = get_template_directory_uri().'/inc/dglib/assets/'.$filename;
		return $absolute_path;

	}

}


if(!function_exists('dglib_posttypes')){
	/**
	 * Function to get public post types
	 * @since 1.0.0
	 * @return array || Public post types
	 */
	function dglib_posttypes(){
		$args = array(
			'public'=>true,
		);
		$dglib_posttypes = get_post_types($args);
		return $dglib_posttypes;
	}

}



if(!function_exists('dglib_taxonomies')){
	/**
	 * Function to get taxonomy on specific post types
	 * @since 1.0.0
	 * @return array || Public post types
	 */
	function dglib_taxonomies( $post_types = 'post' ){
		
		$dglib_taxonomies[''] = esc_html__('No Filters', '__Text_Domain__');
		$taxonomy_list = get_object_taxonomies($post_types);
		foreach($taxonomy_list as $index=>$taxonomy_key){
			$dglib_taxonomies[$taxonomy_key] = ucwords($taxonomy_key);
		}
		return $dglib_taxonomies;
	}
}

if (!function_exists('dglib_get_image_sizes')){
	/**
	 * Function to get dglib image sizes options
	 * @since 1.0.0
	 * @param $disable_image
	 * @return Image size array
	 */
	function dglib_get_image_sizes( $disable_image = false ) {
		global $_wp_additional_image_sizes;
		$dglib_get_image_sizes = array();
		if ( true == $disable_image ) {
			$dglib_get_image_sizes['disable'] = esc_html__( 'No Image', '__Text_Domain__' );
		}
		foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
			$dglib_get_image_sizes[ $_size ] = $_size . ' ('. get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
		}
		$dglib_get_image_sizes['full'] = esc_html__( 'full (original)', '__Text_Domain__' );
		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ($_wp_additional_image_sizes as $key => $size ) {
				$croped_resize = ($size['crop']) ? esc_html__('Croped', '__Text_Domain__') : esc_html__('Resize', '__Text_Domain__'); 
				$dglib_get_image_sizes[ $key ] = $key . ' - '.$croped_resize;
			}
		}

		return $dglib_get_image_sizes;
	}
}

if (!function_exists('dglib_post_order')){
	/**
	 * Function to get dglib order
	 * @since 1.0.0
	 * @return order || array
	 */
	function dglib_post_order(){

		$dglib_post_order = array(
			'ASC' => esc_html__( 'ASC', '__Text_Domain__' ),
			'DESC' => esc_html__( 'DESC', '__Text_Domain__' ),
		);
		return $dglib_post_order;
	}
}

if (!function_exists('dglib_post_orderby')){
	/**
	 * Function to get dglib orderby
	 * @since 1.0.0
	 * @return orderby || array
	 */
	function dglib_post_orderby(){

		$dglib_post_orderby = array(
			'none' => esc_html__( 'None', '__Text_Domain__' ),
			'ID' => esc_html__( 'ID', '__Text_Domain__' ),
			'author' => esc_html__( 'Author', '__Text_Domain__' ),
			'title' => esc_html__( 'Title', '__Text_Domain__' ),
			'date' => esc_html__( 'Date', '__Text_Domain__' ),
			'modified' => esc_html__( 'Modified Date', '__Text_Domain__' ),
			'rand' => esc_html__( 'Random', '__Text_Domain__' ),
			'comment_count' => esc_html__( 'Comment Count', '__Text_Domain__' ),
			'menu_order' => esc_html__( 'Menu Order', '__Text_Domain__' ),
		);
		return $dglib_post_orderby;
	}
}

if (!function_exists('dglib_no_of_column')) {
	/**
	 * Function to get dglib no of column
	 * @since 1.0.0
	 * @return no of column || array
	 */
	function dglib_no_of_column(){

		$dglib_no_of_column = array(
			1 => esc_html__( '1', '__Text_Domain__' ),
			2 => esc_html__( '2', '__Text_Domain__' ),
			3 => esc_html__( '3', '__Text_Domain__' ),
			4 =>  esc_html__( '4', '__Text_Domain__' ),
		);
		return apply_filters( 'dglib_no_of_column', $dglib_no_of_column);
	}
}

if (!function_exists('dglib_link_target')) {
	/**
	 * Function to get dglib link target
	 * @since 1.0.0
	 * @return target string || array
	 */
	function dglib_link_target(){

		$dglib_link_target = array(
			''			=> esc_html__('Disable', '__Text_Domain__'),
			'_blank'	=> esc_html__('Open with New Tab', '__Text_Domain__'),
			'_self'		=> esc_html__('Open with Same Tab', '__Text_Domain__'),
			/*'_parent'	=> esc_html__('_parent', '__Text_Domain__'),
			'_top'		=> esc_html__('_top', '__Text_Domain__'),*/
		);

		return $dglib_link_target;

	}
}

if (!function_exists('dglib_display_types')) {
	/**
	 * Function to get display types
	 * @since 1.0.0
	 * @return display string || array
	 */
	function dglib_display_types(){

		$dglib_display_types = array(
			'carousel'=>esc_html__('Carousel', '__Text_Domain__'),
			'columns'=>esc_html__('Columns', '__Text_Domain__'),
		);
		$dglib_display_types = apply_filters( 'dglib_display_types', $dglib_display_types );
		return $dglib_display_types;

	}

}

if (!function_exists('dglib_fa_iconslist')) {
	/**
	 *  Get all Font Awesome Icons
	 * https://gist.github.com/codersantosh/b4f423fec60fe598b315594fac0a5812
	 *
	 * Function to get font awesome icons
	 * @since 1.0.0
	 * @return string || array
	 */
	function dglib_fa_iconslist(){
		$fa_icon_list = ' fa-glass, fa-music, fa-search, fa-envelope-o, fa-heart, fa-star, fa-star-o, fa-user, fa-film, fa-th-large, fa-th, fa-th-list, fa-check, fa-times, fa-search-plus, fa-search-minus, fa-power-off, fa-signal, fa-cog, fa-trash-o, fa-home, fa-file-o, fa-clock-o, fa-road, fa-download, fa-arrow-circle-o-down, fa-arrow-circle-o-up, fa-inbox, fa-play-circle-o, fa-repeat, fa-refresh, fa-list-alt, fa-lock, fa-flag, fa-headphones, fa-volume-off, fa-volume-down, fa-volume-up, fa-qrcode, fa-barcode, fa-tag, fa-tags, fa-book, fa-bookmark, fa-print, fa-camera, fa-font, fa-bold, fa-italic, fa-text-height, fa-text-width, fa-align-left, fa-align-center, fa-align-right, fa-align-justify, fa-list, fa-outdent, fa-indent, fa-video-camera, fa-picture-o, fa-pencil, fa-map-marker, fa-adjust, fa-tint, fa-pencil-square-o, fa-share-square-o, fa-check-square-o, fa-arrows, fa-step-backward, fa-fast-backward, fa-backward, fa-play, fa-pause, fa-stop, fa-forward, fa-fast-forward, fa-step-forward, fa-eject, fa-chevron-left, fa-chevron-right, fa-plus-circle, fa-minus-circle, fa-times-circle, fa-check-circle, fa-question-circle, fa-info-circle, fa-crosshairs, fa-times-circle-o, fa-check-circle-o, fa-ban, fa-arrow-left, fa-arrow-right, fa-arrow-up, fa-arrow-down, fa-share, fa-expand, fa-compress, fa-plus, fa-minus, fa-asterisk, fa-exclamation-circle, fa-gift, fa-leaf, fa-fire, fa-eye, fa-eye-slash, fa-exclamation-triangle, fa-plane, fa-calendar, fa-random, fa-comment, fa-magnet, fa-chevron-up, fa-chevron-down, fa-retweet, fa-shopping-cart, fa-folder, fa-folder-open, fa-arrows-v, fa-arrows-h, fa-bar-chart, fa-twitter-square, fa-facebook-square, fa-camera-retro, fa-key, fa-cogs, fa-comments, fa-thumbs-o-up, fa-thumbs-o-down, fa-star-half, fa-heart-o, fa-sign-out, fa-linkedin-square, fa-thumb-tack, fa-external-link, fa-sign-in, fa-trophy, fa-github-square, fa-upload, fa-lemon-o, fa-phone, fa-square-o, fa-bookmark-o, fa-phone-square, fa-twitter, fa-facebook, fa-github, fa-unlock, fa-credit-card, fa-rss, fa-hdd-o, fa-bullhorn, fa-bell, fa-certificate, fa-hand-o-right, fa-hand-o-left, fa-hand-o-up, fa-hand-o-down, fa-arrow-circle-left, fa-arrow-circle-right, fa-arrow-circle-up, fa-arrow-circle-down, fa-globe, fa-wrench, fa-tasks, fa-filter, fa-briefcase, fa-arrows-alt, fa-users, fa-link, fa-cloud, fa-flask, fa-scissors, fa-files-o, fa-paperclip, fa-floppy-o, fa-square, fa-bars, fa-list-ul, fa-list-ol, fa-strikethrough, fa-underline, fa-table, fa-magic, fa-truck, fa-pinterest, fa-pinterest-square, fa-google-plus-square, fa-google-plus, fa-money, fa-caret-down, fa-caret-up, fa-caret-left, fa-caret-right, fa-columns, fa-sort, fa-sort-desc, fa-sort-asc, fa-envelope, fa-linkedin, fa-undo, fa-gavel, fa-tachometer, fa-comment-o, fa-comments-o, fa-bolt, fa-sitemap, fa-umbrella, fa-clipboard, fa-lightbulb-o, fa-exchange, fa-cloud-download, fa-cloud-upload, fa-user-md, fa-stethoscope, fa-suitcase, fa-bell-o, fa-coffee, fa-cutlery, fa-file-text-o, fa-building-o, fa-hospital-o, fa-ambulance, fa-medkit, fa-fighter-jet, fa-beer, fa-h-square, fa-plus-square, fa-angle-double-left, fa-angle-double-right, fa-angle-double-up, fa-angle-double-down, fa-angle-left, fa-angle-right, fa-angle-up, fa-angle-down, fa-desktop, fa-laptop, fa-tablet, fa-mobile, fa-circle-o, fa-quote-left, fa-quote-right, fa-spinner, fa-circle, fa-reply, fa-github-alt, fa-folder-o, fa-folder-open-o, fa-smile-o, fa-frown-o, fa-meh-o, fa-gamepad, fa-keyboard-o, fa-flag-o, fa-flag-checkered, fa-terminal, fa-code, fa-reply-all, fa-star-half-o, fa-location-arrow, fa-crop, fa-code-fork, fa-chain-broken, fa-question, fa-info, fa-exclamation, fa-superscript, fa-subscript, fa-eraser, fa-puzzle-piece, fa-microphone, fa-microphone-slash, fa-shield, fa-calendar-o, fa-fire-extinguisher, fa-rocket, fa-maxcdn, fa-chevron-circle-left, fa-chevron-circle-right, fa-chevron-circle-up, fa-chevron-circle-down, fa-html5, fa-css3, fa-anchor, fa-unlock-alt, fa-bullseye, fa-ellipsis-h, fa-ellipsis-v, fa-rss-square, fa-play-circle, fa-ticket, fa-minus-square, fa-minus-square-o, fa-level-up, fa-level-down, fa-check-square, fa-pencil-square, fa-external-link-square, fa-share-square, fa-compass, fa-caret-square-o-down, fa-caret-square-o-up, fa-caret-square-o-right, fa-eur, fa-gbp, fa-usd, fa-inr, fa-jpy, fa-rub, fa-krw, fa-btc, fa-file, fa-file-text, fa-sort-alpha-asc, fa-sort-alpha-desc, fa-sort-amount-asc, fa-sort-amount-desc, fa-sort-numeric-asc, fa-sort-numeric-desc, fa-thumbs-up, fa-thumbs-down, fa-youtube-square, fa-youtube, fa-xing, fa-xing-square, fa-youtube-play, fa-dropbox, fa-stack-overflow, fa-instagram, fa-flickr, fa-adn, fa-bitbucket, fa-bitbucket-square, fa-tumblr, fa-tumblr-square, fa-long-arrow-down, fa-long-arrow-up, fa-long-arrow-left, fa-long-arrow-right, fa-apple, fa-windows, fa-android, fa-linux, fa-dribbble, fa-skype, fa-foursquare, fa-trello, fa-female, fa-male, fa-gratipay, fa-sun-o, fa-moon-o, fa-archive, fa-bug, fa-vk, fa-weibo, fa-renren, fa-pagelines, fa-stack-exchange, fa-arrow-circle-o-right, fa-arrow-circle-o-left, fa-caret-square-o-left, fa-dot-circle-o, fa-wheelchair, fa-vimeo-square, fa-try, fa-plus-square-o, fa-space-shuttle, fa-slack, fa-envelope-square, fa-wordpress, fa-openid, fa-university, fa-graduation-cap, fa-yahoo, fa-google, fa-reddit, fa-reddit-square, fa-stumbleupon-circle, fa-stumbleupon, fa-delicious, fa-digg, fa-pied-piper-pp, fa-pied-piper-alt, fa-drupal, fa-joomla, fa-language, fa-fax, fa-building, fa-child, fa-paw, fa-spoon, fa-cube, fa-cubes, fa-behance, fa-behance-square, fa-steam, fa-steam-square, fa-recycle, fa-car, fa-taxi, fa-tree, fa-spotify, fa-deviantart, fa-soundcloud, fa-database, fa-file-pdf-o, fa-file-word-o, fa-file-excel-o, fa-file-powerpoint-o, fa-file-image-o, fa-file-archive-o, fa-file-audio-o, fa-file-video-o, fa-file-code-o, fa-vine, fa-codepen, fa-jsfiddle, fa-life-ring, fa-circle-o-notch, fa-rebel, fa-empire, fa-git-square, fa-git, fa-hacker-news, fa-tencent-weibo, fa-qq, fa-weixin, fa-paper-plane, fa-paper-plane-o, fa-history, fa-circle-thin, fa-header, fa-paragraph, fa-sliders, fa-share-alt, fa-share-alt-square, fa-bomb, fa-futbol-o, fa-tty, fa-binoculars, fa-plug, fa-slideshare, fa-twitch, fa-yelp, fa-newspaper-o, fa-wifi, fa-calculator, fa-paypal, fa-google-wallet, fa-cc-visa, fa-cc-mastercard, fa-cc-discover, fa-cc-amex, fa-cc-paypal, fa-cc-stripe, fa-bell-slash, fa-bell-slash-o, fa-trash, fa-copyright, fa-at, fa-eyedropper, fa-paint-brush, fa-birthday-cake, fa-area-chart, fa-pie-chart, fa-line-chart, fa-lastfm, fa-lastfm-square, fa-toggle-off, fa-toggle-on, fa-bicycle, fa-bus, fa-ioxhost, fa-angellist, fa-cc, fa-ils, fa-meanpath, fa-buysellads, fa-connectdevelop, fa-dashcube, fa-forumbee, fa-leanpub, fa-sellsy, fa-shirtsinbulk, fa-simplybuilt, fa-skyatlas, fa-cart-plus, fa-cart-arrow-down, fa-diamond, fa-ship, fa-user-secret, fa-motorcycle, fa-street-view, fa-heartbeat, fa-venus, fa-mars, fa-mercury, fa-transgender, fa-transgender-alt, fa-venus-double, fa-mars-double, fa-venus-mars, fa-mars-stroke, fa-mars-stroke-v, fa-mars-stroke-h, fa-neuter, fa-genderless, fa-facebook-official, fa-pinterest-p, fa-whatsapp, fa-server, fa-user-plus, fa-user-times, fa-bed, fa-viacoin, fa-train, fa-subway, fa-medium, fa-y-combinator, fa-optin-monster, fa-opencart, fa-expeditedssl, fa-battery-full, fa-battery-three-quarters, fa-battery-half, fa-battery-quarter, fa-battery-empty, fa-mouse-pointer, fa-i-cursor, fa-object-group, fa-object-ungroup, fa-sticky-note, fa-sticky-note-o, fa-cc-jcb, fa-cc-diners-club, fa-clone, fa-balance-scale, fa-hourglass-o, fa-hourglass-start, fa-hourglass-half, fa-hourglass-end, fa-hourglass, fa-hand-rock-o, fa-hand-paper-o, fa-hand-scissors-o, fa-hand-lizard-o, fa-hand-spock-o, fa-hand-pointer-o, fa-hand-peace-o, fa-trademark, fa-registered, fa-creative-commons, fa-gg, fa-gg-circle, fa-tripadvisor, fa-odnoklassniki, fa-odnoklassniki-square, fa-get-pocket, fa-wikipedia-w, fa-safari, fa-chrome, fa-firefox, fa-opera, fa-internet-explorer, fa-television, fa-contao, fa-500px, fa-amazon, fa-calendar-plus-o, fa-calendar-minus-o, fa-calendar-times-o, fa-calendar-check-o, fa-industry, fa-map-pin, fa-map-signs, fa-map-o, fa-map, fa-commenting, fa-commenting-o, fa-houzz, fa-vimeo, fa-black-tie, fa-fonticons, fa-reddit-alien, fa-edge, fa-credit-card-alt, fa-codiepie, fa-modx, fa-fort-awesome, fa-usb, fa-product-hunt, fa-mixcloud, fa-scribd, fa-pause-circle, fa-pause-circle-o, fa-stop-circle, fa-stop-circle-o, fa-shopping-bag, fa-shopping-basket, fa-hashtag, fa-bluetooth, fa-bluetooth-b, fa-percent, fa-gitlab, fa-wpbeginner, fa-wpforms, fa-envira, fa-universal-access, fa-wheelchair-alt, fa-question-circle-o, fa-blind, fa-audio-description, fa-volume-control-phone, fa-braille, fa-assistive-listening-systems, fa-american-sign-language-interpreting, fa-deaf, fa-glide, fa-glide-g, fa-sign-language, fa-low-vision, fa-viadeo, fa-viadeo-square, fa-snapchat, fa-snapchte-ghost, fa-snapchte-square, fa-pied-piper, fa-first-order, fa-yoast, fa-themeisle, fa-google-plus-official, fa-font-awesome, fa-handshake-o, fa-envelope-open, fa-envelope-open-o, fa-linode, fa-address-book, fa-address-book-o, fa-address-card, fa-address-card-o, fa-user-circle, fa-user-circle-o, fa-user-o, fa-id-badge, fa-id-card, fa-id-card-o, fa-quora, fa-free-code-camp, fa-telegram, fa-thermometer-full, fa-thermometer-three-quarters, fa-thermometer-half, fa-thermometer-quarter, fa-thermometer-empty, fa-shower, fa-bath, fa-podcast, fa-window-maximize, fa-window-minimize, fa-window-restore, fa-window-close, fa-window-close-o, fa-bandcamp, fa-grav, fa-etsy, fa-imdb, fa-ravelry, fa-eercast, fa-microchip, fa-snowflake-o, fa-superpowers, fa-wpexplorer, fa-meetup' ;
		$fa_icon_list_array = explode( ", " , $fa_icon_list);
		return $fa_icon_list_array;
	}
}

if (!function_exists('dglib_faicon_sizes')){
	/**
	 * Function to get dglib fontawesome sizes options
	 * @since 1.0.0
	 * @return Image size array
	 */
	function dglib_faicon_sizes(){

		$fontawesome_icons_size = array(
			''		=> esc_html__('Default', '__Text_Domain__'),
			'fa-2x'	=> esc_html__('fa-2x', '__Text_Domain__'),
			'fa-3x'	=> esc_html__('fa-3x', '__Text_Domain__'),
			'fa-4x'	=> esc_html__('fa-4x', '__Text_Domain__'),
			'fa-5x'	=> esc_html__('fa-5x', '__Text_Domain__'),
		);

		return apply_filters( 'dglib_faicon_sizes', $fontawesome_icons_size );

	}

}

if (!function_exists('dglib_is_json')){
	/**
	 * Function to check string is valid json or not
	 * @since 1.0.0
	 * @return boolean
	 */
	function dglib_is_json( $raw_json ){
		return ( json_decode( $raw_json , true ) == NULL ) ? false : true ; 
	}

}


if(!function_exists('dglib_get_excerpt')):

    function dglib_get_excerpt($excerpt_length=150, $readmore=true, $readmore_text=false ){
    	
        $full_content = get_the_content();
        $content_without_shortcode = strip_shortcodes($full_content);
        $content_without_tags = strip_tags($content_without_shortcode);
        $excerpt = substr($content_without_tags, 0, $excerpt_length);
        if($readmore){
            $default_readmore = '<span class="readmore-wrapper">';
            $default_readmore.= '<a href="'.get_the_permalink().'">';
            if($readmore_text){
            	$default_readmore.= esc_html($readmore_text);
            }else{
            	$default_readmore.= esc_html__('Read More', '__Text_Domain__');	
            }
            $default_readmore.= '</a>';
            $default_readmore.= '</span>';
            $readmore_html = apply_filters( 'dglib_excerpt_more', $default_readmore );
            $excerpt .= $readmore_html;
        }
        
        $excerpt = trim(preg_replace('/\s\s+/', ' ', $excerpt));
        return apply_filters( 'get_the_excerpt', $excerpt );

    }

endif;

if(!function_exists('dglib_the_excerpt')):

    function dglib_the_excerpt($excerpt_length=150, $readmore=true, $readmore_text = false ){

        echo apply_filters( 'the_excerpt', dglib_get_excerpt($excerpt_length, $readmore, $readmore_text) );

    }

endif;

if(!function_exists('dglib_author_listing')):

    function dglib_author_listing(){

        $authors = get_users();
        $author_listing = array();
        foreach ( $authors as $author_detail ) :
            $author_listing[$author_detail->ID]=$author_detail->data->user_login;
        endforeach;

        return $author_listing;

    }

endif;


if( !function_exists('dglib_reactions_icons') ):
	function dglib_reactions_icons(){
		$dglib_reactions_icons = array(
			'like' => array(
				'label'=>esc_html__('Like', '__Text_Domain__'),
				'url'=> dglib_assets_url("img/reactions/like.png"),
			),
			'sad' => array(
				'label'=>esc_html__('Sad', '__Text_Domain__'),
				'url'=> dglib_assets_url("img/reactions/sad.png"),
			),
			'love' => array(
				'label'=>esc_html__('Love', '__Text_Domain__'),
				'url'=> dglib_assets_url("img/reactions/love.png"),
			),
			'surprised' => array(
				'label'=>esc_html__('Surprised', '__Text_Domain__'),
				'url'=> dglib_assets_url("img/reactions/surprised.png"),
			),
			'angry' => array(
				'label'=>esc_html__('Angry', '__Text_Domain__'),
				'url'=> dglib_assets_url("img/reactions/angry.png"),
			),
			'happy' => array(
				'label'=>esc_html__('Happy', '__Text_Domain__'),
				'url'=> dglib_assets_url("img/reactions/happy.png"),
			),
			'crying' => array(
				'label'=>esc_html__('Crying', '__Text_Domain__'),
				'url'=> dglib_assets_url("img/reactions/crying.png"),
			)
		);

		return $dglib_reactions_icons;
	}
endif;

/*
 * Dglib Array Column
 */
if( !function_exists('dglib_array_column') ){

	function dglib_array_column( array $input, $columnKey, $indexKey = null ){
		$array_col = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array_col[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array_col[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array_col;
	}

}

/*
 * Taxonomy List
 */

if( !function_exists('dglib_taxonomy_list') ):
	
	function dglib_taxonomy_list( $post_type = 'post' ){

		$taxonomy_names = get_object_taxonomies( $post_type, 'names' );

		$taxonomy_list = array_combine($taxonomy_names, $taxonomy_names );
		
		return $taxonomy_list;

	}

endif;