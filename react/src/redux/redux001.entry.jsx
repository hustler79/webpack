'use strict';

import React from 'react';
import {render} from 'react-dom';
import { Router, Route, IndexRoute, browserHistory } from 'react-router';

import Main from 'redux/components/Main';
import Single from 'redux/components/Single';
import PhotoGrid from 'redux/components/PhotoGrid';

render(<Router history={browserHistory}>
    <Route path="/redux/001/index.php" component={Main}>
        <IndexRoute component={PhotoGrid}/>
        <Route path="/redux/001/view/:id" component={Single} />
    </Route>
</Router>, document.getElementById('app'));