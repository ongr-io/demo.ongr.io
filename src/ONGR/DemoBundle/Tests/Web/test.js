/* jslint node: true */
/* global casper */
"use strict";

require('/parameters');

var fs = require('fs');
var async = require('async');
var Yadda = require('yadda');
var xpath = require('casper').selectXPath;

var Dictionary = Yadda.Dictionary;
var English = Yadda.localisation.English;

var steps = require('Steps').init();
var yadda = new Yadda.Yadda(steps);
Yadda.plugins.casper(yadda, casper);

var parser = new Yadda.parsers.FeatureParser();


var system = require('system');
var absoluteFilePath = system.args[4];
var absoluteFileDir = absoluteFilePath.replace('test.js', '');

var Features = new Yadda.FileSearch(absoluteFileDir + 'Features');

Features.each(function(file) {
    var feature = parser.parse(fs.read(file));

    casper.test.begin(feature.title, function suite(test) {
        async.eachSeries(feature.scenarios, function(scenario, next) {
            casper.start();
            casper.test.info(scenario.title);
            casper.yadda(scenario.steps);
            casper.run(function() {
                next();
            });
        }, function(err) {
            casper.test.done();
        });
    });

});
