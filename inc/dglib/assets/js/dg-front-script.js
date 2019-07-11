/*!
 * Admin script of dglib
 * @package dineshghimire
 * @subpackage dglib
 */
 (function($){
    'use strict';
    var winWidth, winHeight, Dglib_Front;
    var dglib_document = $(document);
    Dglib_Front = {

        //Custom Snipits goes here
        Snipits: {
            
            Variables: function(){
                winWidth = $(window).width();
                winHeight = $(window).height();
            },

            MegaMenuPosts: function(){

                var megamenu_terms_item = $(this);
                var ajax_running = megamenu_terms_item.attr('data-running');
                var megamenu_tab_class = megamenu_terms_item.data('tab');
                megamenu_terms_item.siblings('li').removeClass('active-item');
                megamenu_terms_item.addClass('active-item');
                $('.'+megamenu_tab_class).siblings('.dglib-megamenu-terms-posts').removeClass('active-item');
                $('.'+megamenu_tab_class).addClass('active-item');

                if(ajax_running){
                    return;
                }
                var megamenu_term_link = megamenu_terms_item.children('a');
                var ajax_args = megamenu_term_link.data('config');
                ajax_args.beforeSend = function(){
                    megamenu_terms_item.attr('data-running', 'true');
                    $('.' + megamenu_tab_class ).siblings('.dglib-menu-preloader').removeClass('hidden');
                };
                ajax_args.success = function(data, status, settings){
                    console.log(data);
                    if(!data.megamenu_html){
                        return;
                    }
                    $('.' + megamenu_tab_class + ' .dglib-menu-posts-wrap' ).html(data.megamenu_html);
                    $('.' + megamenu_tab_class ).siblings('.dglib-menu-preloader').addClass('hidden');
                    
                };
                ajax_args.fail = function( xhr, textStatus, errorThrown ){
                    console.warn('Sorry faild megamenu ajax call');
                };
                $.ajax(ajax_args);

            },

            Reaction_Values: function(evt){
                var reaction_icon_image = $(this);
                var reaction_single_item = reaction_icon_image.closest('.dglib-reaction-single-item');
                var ajax_args = reaction_single_item.data('reaction-config');
                ajax_args.beforeSend = function(){
                    reaction_single_item.find('.dglib-reaction-image-wrap').removeClass('active');
                    reaction_icon_image.addClass('active');
                };
                ajax_args.success = function(data, status, settings){
                    console.log('request successful');
                    console.log(data);
                };
                ajax_args.fail = function( xhr, textStatus, errorThrown ){
                    console.warn('Sorry ajax url not found.')
                };
                $.ajax(ajax_args);
            },
        },     

        Events: function(){

            var __this = Dglib_Front;
            var snipits = __this.Snipits;

            var reaction_values = snipits.Reaction_Values;
            dglib_document.on('click', '.dglib-reaction-image-wrap', reaction_values);

            var megamenu_terms_posts = snipits.MegaMenuPosts;
            dglib_document.on('hover', '.dglib-term-list-item', megamenu_terms_posts);


        },

        Ready: function(){
            var __this = Dglib_Front;
            var snipits = __this.Snipits;

            //This is  functions
            snipits.Variables();
            __this.Events();

        },

        Load: function(){

        },

        Resize: function(){

        },

        Scroll: function(){

        },

        Init: function(){
            var __this = Dglib_Front;
            var docready = __this.Ready;
            var winload = __this.Load;
            var winresize = __this.Resize;
            var winscroll = __this.Scroll;
            $(document).ready(docready);
            $(window).load(winload);
            $(window).scroll(winscroll);
            $(window).resize(winresize);
        },

     };
     
     Dglib_Front.Init();

})(jQuery);