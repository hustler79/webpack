'use strict';

import React from 'react';
import update from 'update';
import {autobind} from 'core-decorators';

import Node from 'immutable/Node';
import deepcopy from "deepcopy";

// https://facebook.github.io/react/docs/perf.html
import Perf from 'react-addons-perf';

// firefox error
console.table = console.log;

let iterator = 0;
window.mode = 0;

const modes = {
    0: 'standard',
    1: 'shalow',
    2: 'identical'
};

export default class Base extends React.Component {
    constructor(...args) {
        super(...args);
        this.state = {
            mode: 0,
            data: {
                l0: {
                    l00: {
                        l001 : {},
                        l002 : {}
                    },
                    l01: {
                        l011 : {},
                        l012 : {}
                    }
                },
                l1: {
                    l10: {},
                    l11: {
                        l111 : {},
                        l112 : {}
                    },
                    l13: {},
                }
            }
        };
    }
    @autobind
    onClickl133() {
        log('onClickl033');
        const newData = update(this.state.data, {
            l0: {
                l01: {
                    l013: {$set: {something: 'else ' + (iterator++)}}
                }
            }
        });
        /// https://gist.github.com/badsyntax/4f8ed3fca9fffa921596/
        // Perf.start();
        this.setState({data: newData});
        // Perf.stop();
        // const t = Perf.getLastMeasurements();
        // Perf.printInclusive(t);
        // Perf.printWasted(t);
    }
    @autobind
    onClickl111() {
        log('onClickl111');
        const newData = update(this.state.data, {
            l1: {
                l11: {
                    l111: {$set: {something: 'else ' + (iterator++)}}
                }
            }
        });
        this.setState({data: newData});
    }
    @autobind
    onClickl111Mut() {
        log('onClickl111Mut');
        const data = this.state.data;
        data.l1.l11.l111 = {something: 'else ' + (iterator++)};
        this.setState({data: data});
    }
    @autobind
    onClickl111State() {
        log('onClickl111State');
        this.state.data.l1.l11.l111 = {something: 'else ' + (iterator++)};
        this.setState(this.state);
    }
    @autobind
    onClickl111Deep() {
        log('onClickl111Deep');
        const state = deepcopy(this.state);
        state.data.l1.l11.l111 = {something: 'else ' + (iterator++)};
        this.setState(state);
    }
    @autobind
    onClickl111Set() {
        log('onClickl111Set');
        this.setState({
            data: {
                l0: {
                    l00: {
                        l001 : {},
                        l002 : {}
                    },
                    l01: {
                        l011 : {},
                        l012 : {}
                    }
                },
                l1: {
                    l10: {},
                    l11: {
                        l111 : {},
                        l112 : {}
                    },
                    l13: {},
                }
            }
        })
    }
    @autobind
    onToggleSCU() {
        window.mode = ( window.mode + 1 ) % 3
        this.setState({});
    }
    componentDidUpdate() {
        log('mode: %s', modes[window.mode]);
    }
    render() {
        log('render base');
        return (
            <div>
                <div className="panel">
                    <button onClick={this.onClickl133}>change l033 helper</button>
                    <br/>
                    <button onClick={this.onClickl111}>change l111 helper</button>
                    <br/>
                    <button onClick={this.onClickl111Mut}>change l111 by mutating and setState(data: data)</button>
                    <br/>
                    <button onClick={this.onClickl111State}>change l111 by mutating state - deasn't work</button>
                    <br/>
                    <button onClick={this.onClickl111Deep}>change l111 deepcopy</button>
                    <br/>
                    <button onClick={this.onClickl111Set}>change l111 set new data</button>
                    <br/>
                    <button onClick={this.onToggleSCU}>toggle ShouldComponentUpdate</button> {modes[window.mode]}
                </div>
                <div className="data">
                    <Node data={this.state.data} />
                </div>
            </div>
        );
    }
}