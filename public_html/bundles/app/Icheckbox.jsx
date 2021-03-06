'use strict';

import React from 'react';
import CreateInstance from 'app/CreateInstance';
log('CreateInstance', CreateInstance);

export default class Icheckbox extends React.Component {
    static PropTypes = {
        label: React.PropTypes.string.isRequired
    };
    constructor(...args) {
        super(...args);
    }
    render() {
        let {label} = this.props;
        return (
            <label className="icontrol" {...this.props}>
                <input type="checkbox"
                       checked={this.props.checked}
                       onChange={this.props.onChange}
                />
                <span className="fake"></span>
                {label}
            </label>
        );
    }
}