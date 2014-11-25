"use strict";
/* global casper */

module.exports.init = function (steps) {
    steps
        .when("I am on product page", function () {
            casper.open(document.app.parameters.base_url + "search")
                .thenClick('.product-thumbnail a');
        })

        .then("I should see basic product info", function () {
            casper.test.assertExist("img.scaled-image");
            casper.test.assertTruthy(casper.fetchText('.product-panel .panel-heading'));
            casper.test.assertTruthy(casper.fetchText('.price'));
            casper.test.assertTextExist("Manufacturer");
            casper.test.assertTextExist("Grape");
            casper.test.assertTextExist("Alcohol level");
            casper.test.assertTextExist("Wine colour");
        })
    ;

    return steps;
}
