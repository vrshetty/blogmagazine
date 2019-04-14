/**
 * dg-customizer-icons-control.js
 *
 * @package dineshghimire
 * @subpackage DgLib
 * @version 1.0.0
 * @since 1.0.0
 *
 * Contains handlers to make Theme Customizer icons
 */
 ( function( $, customize ) {
 	'use strict';
 	var dg_document = $(document);
 	var dg_window = $(window);
 	var customizer_icons = {
 		Snipits: {

 			CustomizerIcons: function(){
 				var single_icon = $(this);
 				var dg_custoimzer_icons = single_icon.closest( '.dg-customize-icons' );
 				var icon_display_value = single_icon.children('i').attr('class');
 				var icon_split_value = icon_display_value.split(' ');
 				var icon_value = icon_split_value[1];

 				single_icon.siblings().removeClass('selected');
 				single_icon.addClass('selected');
 				dg_custoimzer_icons.find('.dg-icon-value').val( icon_value );
 				dg_custoimzer_icons.find('.dg-icon-preview').html('<i class="' + icon_display_value + '"></i>');
 				dg_custoimzer_icons.find('.dg-icon-value').trigger('change');
 			},

 			IconsToggle: function(){
 				var icon_toggle = $(this);
 				var dg_custoimzer_icons = icon_toggle.closest( '.dg-customize-icons' );
 				var icons_list_wrapper = dg_custoimzer_icons.find( '.dg-icons-list-wrapper' );
 				var dashicons = dg_custoimzer_icons.find( '.dashicons' );
 				if( icons_list_wrapper.is(':hidden') ){
 					icons_list_wrapper.slideDown();
 					dashicons.removeClass('dashicons-arrow-down');
 					dashicons.addClass('dashicons-arrow-up');
 				}else{
 					icons_list_wrapper.slideUp();
 					dashicons.addClass('dashicons-arrow-down');
 					dashicons.removeClass('dashicons-arrow-up');
 				}
 			}, 

 			IconsSearch: function(){
 				var text = $(this),
 				value = this.value,
 				dg_custoimzer_icons = text.closest( '.dg-customize-icons' ),
 				icons_list_wrapper = dg_custoimzer_icons.find( '.dg-icons-list-wrapper' );

 				icons_list_wrapper.find('i').each(function () {
 					if ($(this).attr('class').search(value) > -1) {
 						$(this).parent('.dg-single-icon').show();
 					} else {
 						$(this).parent('.dg-single-icon').hide();

 					}
 				});
 			},


 		},

 		Click: function(){

 			var __this = customizer_icons;
 			var snipits = __this.Snipits;

 			var customizericons = snipits.CustomizerIcons;
 			dg_document.on('click', '.dg-customize-icons .dg-single-icon', customizericons);

 			var iconstoggle = snipits.IconsToggle;
 			dg_document.on('click', '.dg-customize-icons .dg-icon-toggle, .dg-customize-icons .dg-icon-preview', iconstoggle);

 			var iconssearch = snipits.IconsSearch;
 			dg_document.on('keyup', '.dg-customize-icons .icon-search', iconssearch);

 		},

 		Ready: function(){
 			var __this = customizer_icons;
 			var snipits = __this.Snipits;
 			__this.Click();
 		},

 		Load: function(){
 		},

 		Resize: function(){
 		},

 		Scroll: function(){
 		},

 		Init: function(){

 			var __this = customizer_icons;
 			var load, ready, resize, scroll;

 			ready = __this.Ready;
 			load = __this.Load;
 			resize = __this.Resize;
 			scroll = __this.Scroll;
 			dg_document.ready(ready);
 			/*dg_window.load(load);
 			dg_window.resize(resize);
 			dg_window.scroll(scroll);*/

 		},

 	};

 	customizer_icons.Init();

 } )( jQuery, wp.customize );