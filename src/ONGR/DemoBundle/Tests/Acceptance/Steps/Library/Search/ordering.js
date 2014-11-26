"use strict";
/* global casper */

module.exports.init = function (steps) {
    steps
        .when("I am sorting by \"$RULE\"", function (rule) {
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
