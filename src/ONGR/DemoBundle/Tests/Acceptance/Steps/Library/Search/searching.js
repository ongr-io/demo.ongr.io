"use strict";
/* global casper */

module.exports.init = function (steps) {
    steps
        .when("I am on search page", function () {
            casper.open(document.app.parameters.base_url + "search");
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
    ;

    return steps;
}
