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
        /**
         * Global DOM selectors
         * used for JavaScript bindings
         */
        globals: {
            navbar: {
                dropdown:        '.navbar-dropdown',
                content:         '.navbar-dropdown-content'
            },
            topbar: {
                dropdown:        '.topbar-dropdown',
                content:         '.topbar-dropdown-content'
            },
            header: {
                searchInp:       '.page-header-search-inp',
                searchBtn:       '.page-header-search-btn',
                cartClose:       '.page-header-cart-close',
                dropdownContent: '.topbar-dropdown-content'
            },
            filter: {
                checkbox:        '.sidebar-filters-item-checkbox',
                collapse:        '.sidebar-filter-collapse',
                body:            '.sidebar-filters-body'
            },
            featuredCarousel:    '#featured-carousel',
            footerDropdown:      '.js-footer-dropdown-trigger',
            scrollTop:           '.scroll-top'
        },

        /**
         * Main app initialization
         */
        init: function() {
            /**
             * Reference to globals` object
             * @type {ONGR.globals}
             */
            var g = this.globals;

            this.bindHeaderCart(g.header.cartClose, g.header.dropdownContent);
            this.bindHeaderSearch(g.header.searchInp, g.header.searchBtn);

            this.bindDropdown(g.topbar.dropdown, g.topbar.content, 'slide');
            this.bindDropdown(g.navbar.dropdown, g.navbar.content, 'fade');

            this.bindFiltersCollapse(g.filter.collapse, g.filter.body);
            this.bindFilterCheckbox(g.filter.checkbox);

            this.bindFeaturedCarousel(g.featuredCarousel);
            this.bindFooterDropdown(g.footerDropdown);

            this.bindScrollTop(g.scrollTop);
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
         * @param checkbox
         */
        bindFilterCheckbox: function(checkbox) {
            $(checkbox).click(function() {
                $(this).toggleClass('glyphicon-ok');
                var url = window.location.origin + $(this).next().attr('href');
                location.href = url;
            });
        },

        /**
         *
         * @param button
         */
        bindScrollTop: function(button) {
            var btn = $(button);
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    btn.fadeIn();
                } else {
                    btn.fadeOut();
                }
            });

            btn.click(function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 800);
                return;
            });
        },

        /**
         *
         * @param trigger
         * @param body
         */
        bindFiltersCollapse: function(trigger, body) {
            if ($(window).width() <= 767) {
                $(trigger).removeClass('opened').text('+');
                $(trigger).parents().eq(1).find(body).hide();
            };
            $(trigger).click(function() {
                $(this).parents().eq(1).find(body).toggle();
                if ($(this).hasClass('opened')) {
                    $(this).removeClass('opened').text('-');
                } else {
                    $(this).addClass('opened').text('+');
                }
            });
            $(window).resize(function() {
                if ($(window).width() <= 767) {
                    $(trigger).removeClass('opened').text('+');
                    $(trigger).parents().eq(1).find(body).hide();
                } else if ($(window).width() > 767) {
                    $(trigger).addClass('opened').text('-');
                    $(trigger).parents().eq(1).find(body).show();
                }
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

        /**
         *
         * @param carousel
         */
        bindFeaturedCarousel: function(carousel) {
            $(carousel).carousel({
                interval: 3000
            });
        }
    };

    var App = Object.create(ONGR); App.init();
})(jQuery);

