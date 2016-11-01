'use strict';

import 'qf/qf.scss';
import React from 'react';
import {render} from 'react-dom';
import Qf from 'qf/Qf';

render(<Qf url="db.php"/>, document.getElementById('app'));
