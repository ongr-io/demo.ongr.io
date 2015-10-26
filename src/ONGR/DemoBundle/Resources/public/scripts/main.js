/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

(function($) {
    var ONGR = {
        init: function() {
            this.bindDropdown('.navbar-dropdown', '.navbar-dropdown-content', 'fade');
            this.bindDropdown('.topbar-dropdown', '.topbar-dropdown-content', 'slide');
            this.bindFooterDropdown('.js-footer-dropdown-trigger');
            this.bindHeaderSearch('.page-header-search-inp', '.page-header-search-btn');
            this.bindHeaderCart('.page-header-cart-close', '.topbar-dropdown-content');
            this.bindFeaturedCarousel();
        },

        /**
         *
         * @param trigger
         * @param target
         * @param type
         */
        bindDropdown: function(trigger, target, type) {
            $(trigger).hover(function() {
                $(this).addClass('opened');
                var delayedTarget = $(this).find(target).stop(true).delay(300);
                (type === 'fade') ? delayedTarget.fadeIn('fast') : delayedTarget.slideDown('fast');
            }, function() {
                $(this).removeClass('opened');
                (type === 'fade') ? $(this).find(target).fadeOut('fast') : $(this).find(target).slideUp('fast');
            });
        },

        /**
         *
         * @param target
         */
        bindFooterDropdown: function(target) {
            $(target).click(function() {
                var $trigger = $(this);
                if ($(this).hasClass('opened')) {
                    $(this).next().slideUp('fast', function() {
                        $trigger.removeClass('opened');
                    });
                } else {
                    $trigger.addClass('opened');
                    $(this).next().slideDown('fast');
                }
            });
        },

        /**
         *
         * @param input
         * @param button
         */
        bindHeaderSearch: function(input, button) {
            $(input).click(function(e) {
                $(this).parent().width('300px');
                e.stopPropagation();
            });

            $(document).click(function() {
                $(input).parent().width('200px');
            });

            $(button).click(function(e) {
                e.stopPropagation();
                $(this).parent().submit();
            });
        },

        /**
         *
         * @param trigger
         * @param target
         */
        bindHeaderCart: function(trigger, target) {
            $(trigger).click(function(e) {
                e.preventDefault();
                $(this).parents().find(target).slideUp('fast');
            });
        },

        bindFeaturedCarousel: function() {
            $('#featured-carousel').carousel({
                interval: 3000
            });
        }
    };

    var App = Object.create(ONGR); App.init();
})(jQuery);

