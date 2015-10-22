/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

(function ($) {
    var topbarDropdown = '.topbar-dropdown-content';

    $('.topbar-dropdown')
        .mouseenter(function() {
            $(this).addClass('opened');
            $(this).find(topbarDropdown).slideDown('fast');
        })
        .mouseleave(function() {
            $(this).removeClass('opened');
            $(this).find(topbarDropdown).slideUp('fast');
        });

    $('.js-footer-dropdown-trigger').click(function() {
        var trigger = $(this);

        if ($(this).hasClass('opened')) {
            $(this).next().slideUp('fast', function() {
                trigger.removeClass('opened');
            });
        } else {
            trigger.addClass('opened');
            $(this).next().slideDown('fast');
        }
    });

    $('.page-header-search-inp').click(function(e) {
        $(this).parent().width('300px');
        e.stopPropagation();
    });

    $(document).click(function() {
        $('.page-header-search-inp').parent().width('200px');
    });

    $('.page-header-search-btn').click(function(e) {
        e.stopPropagation();
        $(this).parent().submit();
    });

    $('.page-header-cart-close').click(function(e) {
        e.preventDefault();
        $(this).parents().find(topbarDropdown).slideUp('fast');
    });
})(jQuery);
