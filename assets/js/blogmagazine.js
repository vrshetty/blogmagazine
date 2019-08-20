/**
 * Main JavaScript file for the BlogMagazine theme.
 *
 * @package    dineshghimire
 * @subpackage blogmagazine
 * @author     Dinesh Ghimire <developer.dinesh1@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://dinesh-ghimire.com.np
 * @since      1.0.0
 */
 
(function($){

    "use strict";
    var winObj = $(window);
    var docObj = $(document);
    var winWidth = winObj.width();
    var winHeight = winObj.height();
    var BLOGMAGAZINE = {

        Snipits: {

            Variables: function(){
                winWidth = winObj.width();
                winHeight = winObj.height();
            },

            AppendHTML: function(){
                //responsive sub menu toggle
                $('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-plus"></i> </span>');
            },

            Sliders: function(){

                var is_rtl = ($('html').attr('dir')=='rtl') ? true : false;

                /**
                 * Ticker script
                 */
                var newsticker_args = {
                    item: 1,
                    loop: true,
                    auto: true,
                    speed: 2000,
                    pause: 6000,
                    pager: false,
                    controls: true,
                    vertical: true,
                    enableDrag: false,
                    enableTouch: false,
                    verticalHeight: 35,
                    adaptiveHeight:true,
                    prevHtml: '<i class="fa fa-angle-left"></i>',
                    nextHtml: '<i class="fa fa-angle-right"></i>',
                };
                $('.blogmagazine-newsticker').each(function(){
                    $(this).lightSlider(newsticker_args);
                });

                /**
                 * Slider script
                 */
                var blogmagazine_mainslider_args = {
                    item: 1,
                    auto: true,
                    loop: true,
                    speed: 2000,
                    pause: 6000,
                    rtl: is_rtl,
                    pager: false,
                    slideMargin: 0,
                    enableDrag: false,
                    enableTouch: false,
                    adaptiveHeight:true,
                    prevHtml: '<i class="fa fa-angle-left"></i>',
                    nextHtml: '<i class="fa fa-angle-right"></i>',
                };
                $('.blogmagazine-featured-main-slider').each(function() {
                    $(this).lightSlider(blogmagazine_mainslider_args);
                });

                var gallery_slider_obj = $('.blogmagazine-post-format-slider');
                if(gallery_slider_obj.length){
                    var gallery_slider_args = {
                        'item':1,
                        'auto':true,
                        'loop':true,
                        'rtl': is_rtl,
                        'speed':2000,
                        'pause':6000,
                        'pager':false,
                        'slideMargin':0,
                        'controls':true,
                        'pauseOnHover':true,
                        'adaptiveHeight':true,
                        'prevHtml' : '<i class="fa fa-angle-left"></i>',
                        'nextHtml' : '<i class="fa fa-angle-right"></i>'
                    };
                    gallery_slider_obj.lightSlider(gallery_slider_args);
                }

                /**
                 * Block carousel layout
                 */
                $('.blogmagazine-block-carousel').each(function(){

                    var blogmagazine_args = $(this).data( 'config' );
                    if($(this).closest('.sidebar-main, .middle-aside, .footer_column_4').length){
                        blogmagazine_args.item = 1;
                    }
                    blogmagazine_args.responsive = [{
                        breakpoint: 991,
                        settings: {
                            item: (blogmagazine_args.item>3) ? 3 : blogmagazine_args.item,
                            slideMove: 1,
                        }
                    },{
                        breakpoint: 840,
                        settings: {
                            item: (blogmagazine_args.item>2) ? 2 : blogmagazine_args.item,
                            slideMove: 1,
                        }
                    },{
                        breakpoint: 480,
                        settings: {
                            item: 1,
                            slideMove: 1,
                        }
                    }];
                    if($(this).closest('.sidebar-main').length){
                        blogmagazine_args.item = 1;
                    }
                    var blogmagazine_slider_obj = $(this).lightSlider(blogmagazine_args);
                    var carousel_controls = blogmagazine_slider_obj.closest('.widget').find('.dglib-carousel-control');
                    carousel_controls.on('click', function(evt){
                        if( $(this).hasClass('dglib-nav-prev') ){
                            blogmagazine_slider_obj.goToPrevSlide();
                        }else{
                            blogmagazine_slider_obj.goToNextSlide();
                        }
                    });
                });
            },

            ManageStyle: function(evt){

                var main_navigation = $('#site-navigation');
                if(winWidth>768){
                    main_navigation.removeAttr('style');
                }


            },

            Title_Tab_Toggle: function(evt){
                var widget_title = $(this).closest('.blogmagazine-block-title, .widget-title');
                var arrow_icon = widget_title.find('.wdgt-tab-toggle .fa');
                if(arrow_icon.hasClass('fa-angle-up')){
                    arrow_icon.removeClass( 'fa-angle-up').addClass('fa-angle-down');
                    widget_title.find('.wdgt-title-tabs').removeClass('show-tabs');
                }else{
                    arrow_icon.removeClass( 'fa-angle-down').addClass('fa-angle-up');
                    widget_title.find('.wdgt-title-tabs').addClass('show-tabs');
                }
                
            },

            Widget_Title_Tab: function(evt){

                evt.preventDefault();
                var tab_item = $(this);
                if( tab_item.closest( '.wdgt-tab-term' ).hasClass( 'active-item' ) ){
                    return;
                }
                var widget_title_tabs =  tab_item.closest('.wdgt-title-tabs');
                if( widget_title_tabs.attr( 'data-loading' ) == 1 ){
                    return;
                }

                var tab_content_class = tab_item.data('tab');
                var widget_title = tab_item.closest('.blogmagazine-block-title, .widget-title');
                var block_post_widget = tab_item.closest('.widget');
                
                widget_title_tabs.find('.wdgt-tab-term').removeClass('active-item');
                tab_item.closest('li').addClass('active-item');
                block_post_widget.find('.blogmagazine-block-posts-wrapper').removeClass( 'tab-active' );
                if( block_post_widget.find( '.' + tab_content_class ).length ){
                    block_post_widget.find( '.' + tab_content_class ).addClass( 'tab-active' );
                    return;
                }
                var ajax_args = $(this).data('ajax-args');
                ajax_args.beforeSend = function(){
                    widget_title_tabs.attr( 'data-loading', 1 );
                    block_post_widget.find('.blgmg-wdgt-preloader').removeClass('hidden');
                };
                ajax_args.success = function(data, status, settings){
                    widget_title_tabs.attr( 'data-loading', 0 );
                    block_post_widget.find('.blgmg-wdgt-preloader').addClass('hidden');
                    var widget_html = data.widget_html;
                    if(widget_html){
                        block_post_widget.find('.dglib-tab-alldata').after(widget_html);
                    }else{
                        console.warn('Sorry faild to retrive widget html data on ajax call');    
                    }
                };
                ajax_args.fail = function( xhr, textStatus, errorThrown ){
                    widget_title_tabs.attr( 'data-loading', 0 );
                    console.warn('Sorry faild to call widget tab ajax.');
                };
                $.ajax(ajax_args);                

            },

            StickyMenu: function(){

                if(typeof $().sticky != 'function'){
                    return;
                }
                var wpAdminBar = jQuery('#wpadminbar');
                if (wpAdminBar.length){
                    jQuery("#blogmagazine-menu-wrap").sticky({topSpacing:wpAdminBar.height()});
                }else{
                    jQuery("#blogmagazine-menu-wrap").sticky({topSpacing:0});
                }

            },

            DisplayScrollTop: function(){
                if (winObj.scrollTop() > 1000) {
                    $('#blogmagazine-scrollup').fadeIn('slow');
                } else {
                    $('#blogmagazine-scrollup').fadeOut('slow');
                }
            },

            SubmenuToggle: function(){
                $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
                $(this).children('.fa-plus').first().toggleClass('fa-minus');
            },

            SearchToggle: function(){
                $('.search-form-main').toggleClass('active-search');
                $('.search-form-main .search-field').focus();
            },

            NavigationToggle: function(){
                $('#site-navigation').slideToggle('slow');
            },

            TabbedWidget: function(evt){

                if($(this).closest('li').hasClass('active-item')){
                    evt.preventDefault();
                    return;
                }
                
                var tabbed_content_id = $(this).attr( 'href' );
                var tabbed_wrapper = $(this).closest('.blogmagazine-default-tabbed-wrapper');

                tabbed_wrapper.find( 'li' ).removeClass( 'active-item' );
                $(this).closest('li').addClass( 'active-item' );

                tabbed_wrapper.find('.blogmagazine-tabbed-section').removeClass('active');
                $(tabbed_content_id).addClass('active');

                evt.preventDefault();

            },

            ScrollUp: function(){
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            },

        },
    
        Events: function(){
            
            var __this = BLOGMAGAZINE;
            var snipits = __this.Snipits;

            var dgwidt_title_tab = snipits.Widget_Title_Tab;
            docObj.on( 'click', '.dgwidgt-title-tab', dgwidt_title_tab );

            var toggle_title_tab = snipits.Title_Tab_Toggle;
            docObj.on( 'click', '.wdgt-tab-toggle, .dgwidgt-title-tab', toggle_title_tab );

            var blogmag_scroll_up = snipits.ScrollUp;
            docObj.on( 'click', '#blogmagazine-scrollup', blogmag_scroll_up );

            //Search toggle
            var blgm_search_toggle = snipits.SearchToggle;
            docObj.on( 'click', '.blogmagazine-header-search-wrapper .search-main', blgm_search_toggle );

            //responsive menu toggle
            var navigation_toggle = snipits.NavigationToggle;
            docObj.on( 'click', '.blogmagazine-header-menu-wrapper .menu-toggle', navigation_toggle );

            //responsive menu toggle
            var submenu_toggle = snipits.SubmenuToggle;
            docObj.on( 'click', '#site-navigation .sub-toggle', submenu_toggle );

            var tabbed_widget = snipits.TabbedWidget;
            docObj.on( 'click', '.blogmagazine-widget-tab a', tabbed_widget );


        },
    
        Ready: function(){

            var __this = BLOGMAGAZINE;
            var snipits = __this.Snipits;

            snipits.AppendHTML();
            snipits.StickyMenu();
            snipits.Sliders();

            __this.Events();

        },

        Load: function(){

        },

        Resize: function(){
            var __this = BLOGMAGAZINE;
            var snipits = __this.Snipits;
            snipits.Variables();
            snipits.ManageStyle();
        },

        Scroll: function(){
            
            var __this = BLOGMAGAZINE;
            var snipits = __this.Snipits;

            snipits.DisplayScrollTop();

        },

        Init: function(){

            var __this = BLOGMAGAZINE;
            var docready = __this.Ready;
            var winload = __this.Load;
            var winresize = __this.Resize;
            var winscroll = __this.Scroll;

            docObj.ready(docready);
            winObj.load(winload);
            winObj.resize(winresize);
            winObj.scroll(winscroll);

        }
    
    };

    BLOGMAGAZINE.Init();

})(jQuery);
