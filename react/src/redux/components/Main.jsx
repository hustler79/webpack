'use strict';

import React from 'react';
import { Link } from 'react-router';

export default class Main extends React.Component {
    render() {
        return (
            <div>
                <h1>
                    <Link to="/redux/001/index.php">Reduxstagram</Link>
                </h1>
                <ul>
                    <li><Link to="/redux/001/view/1">page1</Link></li>
                    <li><Link to="/redux/001/view/2">page2</Link></li>
                </ul>
                {React.cloneElement(this.props.children, this.props)}
            </div>
        );
    }
}