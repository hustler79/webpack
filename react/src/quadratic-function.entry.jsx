'use strict';

import 'qf/qf.scss';
import React from 'react';
import {render} from 'react-dom';
import Qf from 'qf/Qf';

render(<Qf
    url="db.php"
    radius={32}
    step={2}
    height={200}
    width={200}
/>, document.getElementById('app'));
