"use strict";
/* global casper */

module.exports.init = function (steps) {
    steps
        .when("I am on homepage", function () {
            casper.open(document.app.parameters.base_url);
        })
        .when("I click \"$TITLE\"", function (title) {
            casper.clickLabel(title, 'a');
        })

        .then("I should be redirected to empty search page", function () {
            casper.test.assertEquals(casper.fetchText('.breadcrumb').trim(), 'Home');
        })
        .then("I should see text \"$TEXT\"", function (text) {
            casper.test.assertTextExists(text);
        })
    ;
    return steps;
}
