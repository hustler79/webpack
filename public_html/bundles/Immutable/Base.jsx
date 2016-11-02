'use strict';

import React from 'react';
import update from 'update';
import {autobind} from 'core-decorators';

import Node from 'immutable/Node';

export default class Base extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            data: {
                l0: {
                    l00: {
                        l001 : {},
                        l002 : {},
                        l003 : {},
                    },
                    l01: {
                        l011 : {},
                        l012 : {},
                        l013 : {},
                    }
                },
                l1: {
                    l10: {},
                    l11: {
                        l111 : {},
                        l112 : {},
                        l113 : {},
                    },
                    l12: {},
                    l13: {},
                }
            }
        };
    }
    @autobind
    onClickl033() {
        log('onClickl033');
        const newData = update(this.state.data, {
            l0: {
                l01: {
                    l013: {$set: {cos: 'innego'}}
                }
            }
        });
        log({data: newData});
        this.setState({data: newData}, function () {
            log('after')
            log(this.state)
        });
    }
    render() {
        return (
            <div>
                <button onClick={this.onClickl033}>to l033</button>
                <Node data={this.state.data} />
            </div>
        );
    }
}