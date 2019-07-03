/**
 * dg-customizer-icons-control.js
 *
 * @package dineshghimire
 * @subpackage DgLib
 * @version 1.0.0
 * @since 1.0.0
 *
 * Contains handlers to make Theme Customizer image options
 */
 ( function( $, customize ) {
    'use strict';
    var dglib_document = $(document);
    var dglib_window = $(window);
    var IMAGE_OPTION_CONTROL = {
        Snipits: {
            ImageOptions: function(){
                var wrapper_obj = $(this).closest('.dg-imageoption-wrapper');
                var settings_object = wrapper_obj.find('.dglib-imageoption-checkbox');
                var settings_value_obj = wrapper_obj.find('.dglib-imageoption-value');
                var value_data = [];
                settings_object.each(function(){
                    if($(this).is(':checked')){
                        value_data.push($(this).val());     
                    }
                });
                var value_json = JSON.stringify(value_data);
                settings_value_obj.val(value_json);
                settings_value_obj.trigger('change');
            },
        },

        Events: function(){
            var __this = IMAGE_OPTION_CONTROL;
            var snipits = __this.Snipits;
            var imageoptions = snipits.ImageOptions;
            dglib_document.on('change', '.dg-imageoption-wrapper .dglib-imageoption-checkbox', imageoptions);
        },

        Ready: function(){
            var __this = IMAGE_OPTION_CONTROL;
            var snipits = __this.Snipits;
            __this.Events();
        },

        Load: function(){
        },

        Resize: function(){
        },

        Scroll: function(){
        },

        Init: function(){
            var __this = IMAGE_OPTION_CONTROL;
            var load, ready, resize, scroll;
            ready = __this.Ready;
            load = __this.Load;
            resize = __this.Resize;
            scroll = __this.Scroll;
            dglib_document.ready(ready);
            /*dglib_window.load(load);
            dglib_window.resize(resize);
            dglib_window.scroll(scroll);*/

        },
    };
    IMAGE_OPTION_CONTROL.Init();
 } )( jQuery, wp.customize );
