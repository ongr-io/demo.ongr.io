/* jslint node: true */
/* global Dictionary, English, casper, xpath, __utils__ */
"use strict";

module.exports.init = function () {
    var system = require('system');
    var absoluteFilePath = system.args[4];
    var absoluteFileDir = absoluteFilePath.replace('test.js', '') + 'Steps/';
    var DictionaryPath = absoluteFileDir + 'Dictionary/';
    var LibraryPath = absoluteFileDir + 'Library/';

    var fs = require('fs');
    function recursiveInclude(path, argument) {
        var list = fs.list(path);
        list.forEach(function(entry) {
            if (entry === '.' || entry === '..') {
                return;
            }
            if (fs.isDirectory(path + entry)) {
                recursiveInclude(path + entry + '/', argument);
            } else if (fs.isFile(path + entry) && entry.indexOf('.js') !== -1) {
                require(
                    './'
                    + path.replace(absoluteFileDir,'')
                    + entry.replace('.js','')
                ).init(argument);
            }
        })
    }

    var dictionary = new Dictionary();
    recursiveInclude(DictionaryPath, dictionary);
    var library = English.library(dictionary)
    recursiveInclude(LibraryPath, library);

    return library;
};
