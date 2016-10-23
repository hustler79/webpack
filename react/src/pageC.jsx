'use strict';

import log from './lib/log';

var tmp;

import "./css/pageB.css";

// --- vvv
  import common from "./lib/common";
  tmp = common();
  log(tmp + ' : ' + (tmp === 'common lib should be in common.js and is available from A and B'));
// --- ^^^

// --- vvv
  import onlyfora from "./lib/onlyfor-b";
  tmp = onlyfora("call from B");
  log(tmp + ' : ' + (tmp === 'onlyfor-b.js: call from B'));
// --- ^^^

// --- vvv
  import es6module from "./lib/common-es6-module";
  tmp = es6module('executed in pageB');
  log(tmp + ' : ' + (tmp === 'es6 module: executed in pageB'));
// --- ^^^

// --- vvv
// --- ^^^

// --- vvv
// --- ^^^

// --- vvv
// --- ^^^

// --- vvv
// --- ^^^

