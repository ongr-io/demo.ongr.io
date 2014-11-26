"use strict";

module.exports.init = function (dictionary) {
    dictionary
        .define('NUM', /(\d+)/)
        .define('ORDER', /(descending|ascending)/)
        .define('PAGE', /(first|previous|next|last)/)
    ;

    return dictionary;
}
