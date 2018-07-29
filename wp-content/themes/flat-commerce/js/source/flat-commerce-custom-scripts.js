/*
 * Custom scripts
 * Description: Custom scripts for flat-commerce
 */

jQuery(document).ready(function ($) {
    var jQueryheader_search = $('#search-toggle');
    jQueryheader_search.click(function () {
        var jQuerythis_el_search = $(this),
                jQueryform_search = jQuerythis_el_search.siblings('#search-container');

        if (jQueryform_search.hasClass('displaynone')) {
            jQueryform_search.removeClass('displaynone').addClass('displayblock').animate({opacity: 1}, 300);
        } else {
            jQueryform_search.removeClass('displayblock').addClass('displaynone').animate({opacity: 0}, 300);
        }
    });

    //Fit vids
    if (jQuery.isFunction(jQuery.fn.fitVids)) {
        $('.hentry, .widget').fitVids();
    }

    //responsive main-navigation
    $('.main-navigation').meanmenu();
    $('.mean-bar').insertAfter('#masthead .site-topbar');

    $(window).resize(function(){
        $('.mean-bar').insertAfter('#masthead .site-topbar');
    });

    // Sticky header
    $(window).on('load', function () {
        $(window).scroll(function(){
            var window_top = $(window).scrollTop();
            var div_top = $('.site-header').outerHeight(true);
            if (window_top > 1) {
                $('.site-header').addClass('affix');
            } else {
                $('.site-header').removeClass('affix');
            }
        });
    });

    // WooCommerce product category widget
    $('.product-categories > li.cat-parent > a').on("click", function (e) {
        e.preventDefault();
        if ($(this).next().hasClass("show")) {
            $(this).next().slideUp(500, function () {});
        } else {
            $(this).next().slideDown(500, function () {});
        }
        $(this).toggleClass("show");
    });
});
