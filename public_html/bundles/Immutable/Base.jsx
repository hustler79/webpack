'use strict';

import React from 'react';

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
                    },
                    l02: {
                        l021 : {},
                        l022 : {},
                        l023 : {},
                    },
                    l03: {
                        l031 : {},
                        l032 : {},
                        l033 : {},
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
                },
                l2: {
                    l20: {},
                    l21: {},
                    l22: {},
                    l23: {},
                }
            }
        };
    }
    render() {
        return (
            <div>base
                <Node data={this.state.data} />
            </div>
        );
    }
}