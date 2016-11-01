'use strict';

import React from 'react';

export default class Range extends React.Component {
    static PropTypes = {
        label: React.PropTypes.string,
        // value: React.PropTypes.number,
        min: React.PropTypes.number,
        max: React.PropTypes.number,
        // step: React.PropTypes.number,
        onChange: React.PropTypes.func
    };
    render() {
        var step = this.props.step || 1;
        return (
            <label>
                <input
                    type="range"
                    min={this.props.min}
                    max={this.props.max}
                    step={this.props.step}
                    value={this.props.value}
                    onChange={this.props.onChange}
                />
                {this.props.label}
            </label>
        );
    }
}