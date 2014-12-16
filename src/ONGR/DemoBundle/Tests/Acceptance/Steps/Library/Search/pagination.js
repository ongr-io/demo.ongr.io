"use strict";
/* global casper */

module.exports.init = function (steps) {
    steps
        .when("I am on $PAGE page", function (page) {
            casper.click('.pagination > .' + page + ' a');
        })
        .then("Pagination exists", function () {
            casper.test.assertExist('.pagination');
        })
        .then("I see $PAGE page button", function (page) {
            casper.test.assertExist('.pagination > .' + page);
        })
        .then("I see $NUM-$NUM page buttons", function (start, end) {
            for (var i = parseInt(start); i <= parseInt(end); i++) {
                casper.test.assertSelectorHasText('.pagination', i);
            }
        })
        .then("I am on page $NUM", function (page) {
            casper.test.assertSelectorHasText('.pagination > .active', page);
        })
    ;

    return steps;
}
