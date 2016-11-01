'use strict';

import React from 'react';
import isArray from 'lodash/isArray';

export default class Grid extends React.Component {
    static PropTypes = {
        height: React.PropTypes.number.isRequired,
        width: React.PropTypes.number.isRequired,
    };
    render() {
        return (
            // https://developer.mozilla.org/en/docs/Web/SVG/Tutorial/Paths

            // https://developer.mozilla.org/en/docs/Web/SVG/Attribute/viewBox
            // https://developer.mozilla.org/en-US/docs/Web/SVG/Element/svg#Example
            // https://developer.mozilla.org/en/docs/Web/SVG/Element/line
            // <svg xmlns="http://www.w3.org/2000/svg"
            //      width="150" height="100" viewBox="0 0 3 2">
            //     <rect width="1" height="2" x="0" fill="#008d46" />
            //     <rect width="1" height="2" x="1" fill="#ffffff" />
            //     <rect width="1" height="2" x="2" fill="#d2232c" />
            // </svg>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="-10 -10 20 20"
                height={this.props.height}
                width={this.props.width}
            >
                <line x1="0" y1="-10" x2="0" y2="10" strokeWidth="1" stroke="gray"/>
                <line x1="-10" y1="0" x2="10" y2="0" strokeWidth="1" stroke="gray"/>
                {this.props.children}
            </svg>
        );
    }
}