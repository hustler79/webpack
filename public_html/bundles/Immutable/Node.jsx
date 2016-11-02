'use strict';

import React from 'react';
import isObject from 'lodash/isObject';

export default class Node extends React.Component {
    render() {

        var data = this.props.data;

        var level = this.props.level || 1;

        return (
            <div className="node">
                {(isObject(data)) && Object.keys(data).map(function (key) {
                    return (
                        <div key={key} className="element">
                            {key}{log('-'.repeat(level)+' key', key)}
                            <Node data={data[key]} level={level + 1}/>
                        </div>
                    );
                })}
            </div>
        );
    }
}