'use strict'

import React from 'react';
import {autobind} from 'core-decorators';

import Range from 'qf/Range';
import Grid from 'qf/Grid';
import debounce from 'lodash/debounce';

export default class Qf extends React.Component {
    static PropTypes = {
        radius: React.PropTypes.number.isRequired,
        step: React.PropTypes.number.isRequired,
        height: React.PropTypes.number.isRequired,
        width: React.PropTypes.number.isRequired,
    };
    constructor() {
        super()
        this.state = {
            a: 26,
            b: 18,
            c: -4
        };
        this.setStateDebounced = debounce(this.setStateDebounced, 5);
    }
    @autobind
    onChangeRange(e) {
        const variable = e.target.parentNode.innerText.toLowerCase();
        let state = {};
        state[variable] = parseInt(e.target.value, 10);
        this.setStateDebounced(state);
    }
    setStateDebounced(state) {
        this.setState(state);
    }
    render() {
        let
            data = [],
            a_ = this.state.a / 100,
            b_ = (this.state.b * 0.1).toFixed(2),
            c = this.state.c
        ;

        for (var x = -this.props.radius ; x <= this.props.radius ; x += this.props.step ) {
            data.push([x, Math.pow(x * a_, 2) + (x * b_) + c]);
        }

        let prev, list = [];
        data.forEach(function (d) {
           if (prev) {
               list.push([prev, d]);
           }
           prev = d;
        });

        return (
            <div>
                <div>
                    <Range
                        label="A"
                        value={this.state.a}
                        min={-100}
                        max={100}
                        onChange={this.onChangeRange}
                    />
                    : {a_} , {this.state.a}
                </div>
                <div>
                    <Range
                        label="B"
                        value={this.state.b}
                        min={-100}
                        max={100}
                        onChange={this.onChangeRange}
                    />
                    : {b_} , {this.state.b}
                </div>
                <div>
                    <Range
                        label="C"
                        value={this.state.c}
                        min={-10}
                        max={10}
                        onChange={this.onChangeRange}
                    />
                    : {this.state.c}
                </div>
                <div>
                    <Grid
                        width={this.props.width}
                        height={this.props.height}
                        radius={this.props.radius}
                    >
                        {list.map(function (d, i) {
                            return (
                                <line
                                    key={i}
                                    x1={d[0][0].toFixed(2) * 1}
                                    y1={d[0][1].toFixed(2) * 1}
                                    x2={d[1][0].toFixed(2) * 1}
                                    y2={d[1][1].toFixed(2) * 1}
                                    strokeWidth="1"
                                    stroke="gray"
                                    fill="transparent"
                                />
                            );
                        })}
                    </Grid>
                </div>
            </div>
        );
    }
}