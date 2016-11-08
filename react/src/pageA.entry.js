require('./css/pageA.css');
var common = require("./lib/common");
var onlyfora = require("./lib/onlyfor-a");
var config = require("./lib/config.json");
onlyfora("call from A");
common();
console.log(config);


var log = require('log');
console.log(log)

log('test log');


