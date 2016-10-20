'use strict';

import "./css/pageB.css";
import common from "./lib/common";
import onlyfora from "./lib/onlyfor-b";
import es6module from "./lib/common-es6-module";
onlyfora("call from B");
common();
es6module('executed in pageB');

