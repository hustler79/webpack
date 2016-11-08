'use strict';

import React from 'react';
import isObject from 'lodash/isObject';
import shallowCompare from 'react-addons-shallow-compare';
import {autobind} from 'core-decorators';

// https://facebook.github.io/react/docs/react-api.html#react.purecomponent
// good article about: http://benchling.engineering/performance-engineering-with-react/
// yarn add react-addons-shallow-compare
export default class Node extends React.PureComponent {
    constructor(props) {
        super(props)
        this.state = {
            toggle: 1
        };
    }
    // @autobind
    // shouldComponentUpdate(nextProps, nextState) {
    //     return shallowCompare(this, nextProps, nextState);
    //
    //     // all below is wrong ...
    //     // switch (window.mode) {
    //     //     case 0:
    //     //         // default logic: https://github.com/seansfkelley/pure-render-decorator/commit/137f8a3c6999aba4688f81ad6c9f4b9f0a180de1
    //     //         return !shallowEqual(this.props, nextProps) || !shallowEqual(this.state, nextState);
    //     //         break;
    //     //     case 1:
    //     //         return shallowCompare(this, nextProps, nextState);
    //     //         break;
    //     //     case 2:
    //     //         return !this.state || this.props.data !== nextProps.data || this.state !== nextState;
    //     //         break;
    //     // }
    // }
    render() {

        var data = this.props.data;

        var level = this.props.level || 1;

        let label = (typeof data === 'string') ? data : '';

        log( '-'.repeat(level) + this.props.k + ' ' + label )

        return (
            <div className="node">
                {(isObject(data)) && Object.keys(data).map(function (key) {

                    let label = (typeof data[key] === 'string') ? data[key] : null;

                    return (
                        <div key={key} className="element">
                            {key} {label}
                            <Node k={key} data={data[key]} level={level + 1}/>
                        </div>
                    );
                })}
            </div>
        );
    }
}