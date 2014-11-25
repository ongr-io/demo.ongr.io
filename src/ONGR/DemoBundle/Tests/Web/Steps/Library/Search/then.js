"use strict";
/* global casper */

module.exports.init = function (steps) {
    steps
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
    ;

    return steps;
}
