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
    ;

    return steps;
}
