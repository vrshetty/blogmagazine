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
    
    var BLOGMAGAZINE = {

        Snipits: {

            Sliders: function(){

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

                /**
                 * Block carousel layout
                 */
                $('.blogmagazine-block-carousel').each(function(){

                    var blogmagazine_args = {
                        auto: true,
                        loop: true,
                        speed: 2000,
                        pause: 6000,
                        pager: false,
                        controls: false,
                        pauseOnHover: true,
                        adaptiveHeight:true,
                        prevHtml: '<i class="fa fa-angle-left"></i>',
                        nextHtml: '<i class="fa fa-angle-right"></i>',
                        item: 4,
                        responsive: [{
                            breakpoint: 840,
                            settings: {
                                item: 2,
                                slideMove: 1,
                                slideMargin: 6,
                            }
                        },{
                            breakpoint: 480,
                            settings: {
                                item: 1,
                                slideMove: 1,
                            }
                        }]
                    };
                    if($(this).closest('.sidebar-right, .sidebar-left').length){
                        blogmagazine_args.item = 1;
                    }
                    var blogmagazine_slider_obj = $(this).lightSlider(blogmagazine_args);
                    var carousel_controls = blogmagazine_slider_obj.closest('.widget').find('.blogmagazine-carousel-control');
                    carousel_controls.on('click', function(evt){
                        if( $(this).hasClass('blogmagazine-nav-prev') ){
                            blogmagazine_slider_obj.goToPrevSlide();
                        }else{
                            blogmagazine_slider_obj.goToNextSlide();
                        }
                    });
                });
            },

            Widget_Title_Tab: function(evt){
                evt.preventDefault();
                var tab_item = $(this);
                
                var tab_content_class = tab_item.data('tab');
                var widget_title = tab_item.closest('.blogmagazine-block-title');
                var widget_title_tabs =  tab_item.closest('.wdgt-title-tabs');
                var block_post_widget = tab_item.closest('.widget');
                
                widget_title_tabs.find('.wdgt-tab-term').removeClass('active-item');
                tab_item.closest('li').addClass('active-item');
                block_post_widget.find('.blogmagazine-block-posts-wrapper').removeClass('tab-active');
                if( block_post_widget.find( '.' + tab_content_class ).length ){
                    block_post_widget.find( '.' + tab_content_class ).addClass('tab-active');
                    return;
                }

                var ajax_args = $(this).data('ajax-args');
                ajax_args.beforeSend = function(){
                    //megamenu_terms_item.attr('data-running', 'true');
                    //$('.' + megamenu_tab_class ).siblings('.dglib-menu-preloader').removeClass('hidden');
                };
                ajax_args.success = function(data, status, settings){
                    var widget_html = data.widget_html;
                    if(widget_html){
                        block_post_widget.find('.blgmg-tab-alldata').after(widget_html);
                    }else{
                        console.warn('Sorry faild to retrive widget html data on ajax call');    
                    }
                };
                ajax_args.fail = function( xhr, textStatus, errorThrown ){
                    console.warn('Sorry faild widget tab ajax call');
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

        },
    
        Events: function(){
            
            var __this = BLOGMAGAZINE;
            var snipits = __this.Snipits;

            var dgwidt_title_tab = snipits.Widget_Title_Tab;
            $(document).on( 'click', '.dgwidgt-title-tab', dgwidt_title_tab );

        },
    
        Ready: function(){

            var __this = BLOGMAGAZINE;
            var snipits = __this.Snipits;

            snipits.StickyMenu();
            snipits.Sliders();

            __this.Events();

        },

        Load: function(){

        },

        Resize: function(){

        },

        Scroll: function(){

        },

        Init: function(){

            var __this = BLOGMAGAZINE;
            var docready = __this.Ready;
            var winload = __this.Load;
            var winresize = __this.Resize;
            var winscroll = __this.Scroll;

            $(document).ready(docready);
            $(window).load(winload);
            $(window).resize(winresize);
            $(window).scroll(winscroll);

        }
    
    };

    BLOGMAGAZINE.Init();

})(jQuery);

jQuery(document).ready(function($) {

    "use strict";

     /**
     * Default widget tabbed
     */
    $("#blogmagazine-tabbed-widget").tabs();


    //Search toggle
    jQuery('.blogmagazine-header-search-wrapper .search-main').click(function() {
        jQuery('.search-form-main').toggleClass('active-search');
        jQuery('.search-form-main .search-field').focus();
    });

    //responsive menu toggle
    jQuery('.blogmagazine-header-menu-wrapper .menu-toggle').click(function(event) {
        jQuery('.blogmagazine-header-menu-wrapper #site-navigation').slideToggle('slow');
    });

    //responsive sub menu toggle
    jQuery('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

    jQuery('#site-navigation .sub-toggle').click(function() {
        jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    });

    // Scroll To Top
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#blogmagazine-scrollup').fadeIn('slow');
        } else {
            $('#blogmagazine-scrollup').fadeOut('slow');
        }
    });

    $('#blogmagazine-scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});