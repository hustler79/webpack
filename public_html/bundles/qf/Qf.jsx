'use strict'

import React from 'react';
import {autobind} from 'core-decorators';

import Range from 'qf/Range';
import Grid from 'qf/Grid';
import debounce from 'lodash/debounce';

export default class Qf extends React.Component {
    constructor() {
        super()
        this.state = {
            a: 0,
            b: 0,
            c: 0
        };
    }
    @autobind
    onChangeRange(e) {
        const variable = e.target.parentNode.innerText.toLowerCase();
        let state = {};
        state[variable] = parseInt(e.target.value, 10);
        this.setState(state);
    }
    render() {
        var
            data = [],
            a_ = this.state.a / 100,
            b_ = this.state.b / 100,
            c = this.state.c
        ;

        for (var x = -10 ; x <= 10 ; x += 2 ) {
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
                    : {a_}
                </div>
                <div>
                    <Range
                        label="B"
                        value={this.state.b}
                        min={-10}
                        max={10}
                        onChange={this.onChangeRange}
                    />
                    : {b_}
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
                        width={200}
                        height={200}
                    >
                        {list.map(function (d, i) {
                            return (
                                <line
                                    key={i}
                                    x1={d[0][0]}
                                    y1={d[0][1]}
                                    x2={d[1][0]}
                                    y2={d[1][1]}
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