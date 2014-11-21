/* jslint node: true */
/* global Dictionary, English, casper, xpath, __utils__ */
"use strict";

module.exports.init = function () {
    var dictionary = new Dictionary()
        .define('NUM', /(\d+)/)
        .define('ORDER', /(descending|ascending)/)
        .define('PAGE', /(first|previous|next|last)/);

    var library = English.library(dictionary)

            .when("I am on homepage", function () {
                casper.open(document.app.parameters.base_url);
            })

            .when("I am on search page", function () {
                casper.open(document.app.parameters.base_url + "search");
            })

            .when("I am on product page", function () {
                casper.open(document.app.parameters.base_url + "search")
                      .thenClick('.product-thumbnail a');
            })

            .when("I click \"$TITLE\"", function (title) {
                casper.clickLabel(title, 'a');
            })

            .when("I search for \"$TEXT\"", function (text) {
                casper.fill(
                    "form.navbar-form",
                    {
                        "q": text
                    },
                    true
                );
            })

            .when("I select \"$PROPERTY\" from category \"$CATEGORY\"", function (property, category) {
                casper.test.assertExist(
                    {
                        'type': 'xpath',
                        'path': "//*[text()[contains(.,'" + category + "')]]/..//a[text()[contains(.,'" + property + "')]]"
                    },
                    property + " from category " + category + " exists"
                );
                casper.click({
                    'type': 'xpath',
                    'path': "//*[text()[contains(.,'" + category + "')]]/..//a[text()[contains(.,'" + property + "')]]"
                });
            })

            .when("I am on $PAGE page", function (page) {
                casper.click('.pager > .' + page + ' a');
            })

            .when("I sort products \"$RULE\"", function (rule) {
                // casper.click method on menu items didn't work for some reason.
                var num;
                switch (rule) {
                    case 'Price ascending' :
                        num = 0;
                        break;
                    case 'Price descending' :
                        num = 1;
                        break;
                }

                casper.open(document.app.parameters.base_url + "search?sort=" + num);
            })


            .then("I should see $NUM products", function (num) {
                casper.test.assertEquals(casper.fetchText('span.label-info').trim(), num);
            })

            .then("Products has basic information", function () {
                var productCount = casper.getElementsInfo('.product-thumbnail').length;

                casper.test.assertElementCount(".product-thumbnail img", productCount);
                casper.test.assertElementCount(".product-thumbnail .product-title", productCount);
                casper.test.assertElementCount(".product-thumbnail .thumbnail-price", productCount);
            })

            .then("All products has \"$TEXT\" in their names", function (text) {
                casper.test.assertSelectorHasText('.product-title', text);
            })

            .then("I should be redirected to empty search page", function () {
                casper.test.assertEquals(casper.fetchText('.breadcrumb').trim(), 'Home');
            })

            .then("I should see text \"$TEXT\"", function (text) {
                casper.test.assertTextExists(text);
            })

            .then("Pagination exists", function () {
                casper.test.assertExist('.pager');
            })

            .then("I see $PAGE page button", function (page) {
                casper.test.assertExist('.pager > .' + page);
            })

            .then("I see $NUM-$NUM page buttons", function (start, end) {
                for (var i = parseInt(start); i <= parseInt(end); i++) {
                    casper.test.assertSelectorHasText('.pager', i);
                }
            })

            .then("I am on page $NUM", function (page) {
                casper.test.assertSelectorHasText('.pager > .selected', page);
            })

            .then("Products are in price $ORDER order", function (order) {
                var correct = true;
                var price = null;
                var info = casper.getElementsInfo('.thumbnail-price');
                info.forEach(function (info) {
                    var currentPrice = parseFloat(info.text.replace('€ ', ''));
                    if (
                        price == null
                        || (order === 'descending' && price >= currentPrice)
                        || (order === 'ascending' && price <= currentPrice)
                    ) {
                        price = currentPrice;
                    } else {
                        correct = false;
                    }
                });
                casper.test.assertTrue(correct);
            })

            .then("I should see basic product info", function (page) {
                casper.test.assertExist("img.scaled-image");
                casper.test.assertTruthy(casper.fetchText('.product-panel .panel-heading'));
                casper.test.assertTruthy(casper.fetchText('.price'));
                casper.test.assertTextExist("Manufacturer");
                casper.test.assertTextExist("Grape");
                casper.test.assertTextExist("Alcohol level");
                casper.test.assertTextExist("Wine colour");
            })

        ;

    return library;
};
