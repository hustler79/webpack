'use strict';

import React from 'react';
import { autobind } from 'core-decorators';

export default class Sandbox extends React.Component {
    // https:1//facebook.github.io/react/docs/typechecking-with-proptypes.html
    static PropTypes = {
        input: React.PropTypes.string.isRequired
    };
    @autobind
    onChange(e) {
        this.setState({
            input: e.target.value
        });
    }
    constructor(...args) {
        super(...args);

        this.state = {
            input: '',
        };
    }
    render() {
        return (
            <form onSubmit={this.onSubmit}>
                <label >
                    <input type="text" value={this.state.input} onChange={this.onChange} />
                </label>

                {this.state.multiple.map(function (i) {
                    return <img key={i} src={'/bundles/img/' + i + '.bmp'} />
                })}

                {Object.keys(this.state.list).map((i) => {
                    var item = this.state.list[i];
                    return <div key={i}>{item.name}</div>
                })}
            </form>
        );
    }
}