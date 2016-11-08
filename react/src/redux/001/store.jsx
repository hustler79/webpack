'use strict';

import { createStore, compse } from 'redux';
import { syncHistoryWithStore } from 'react-router-redux';
import { browserHistory } from 'react-router';

import rootReducer from 'redux/reducers/index';

// https://learnredux.com/view/G1CSA5AyDvI