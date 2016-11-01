'use strict';

import React from 'react';
import isArray from 'lodash/isArray';

export default class Grid extends React.Component {
    static PropTypes = {
        height: React.PropTypes.number.isRequired,
        width: React.PropTypes.number.isRequired,
        radius: React.PropTypes.number.isRequired,
    };
    render() {

        let
            radius = this.props.radius,
            mr = radius * 2
        ;

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
                viewBox={`-${radius} -${radius} ${mr} ${mr}`}
                height={this.props.height}
                width={this.props.width}
            >
                <line x1="0" y1={`-${radius}`} x2="0" y2={radius} strokeWidth="1" stroke="gray"/>
                <line x1={`-${radius}`} y1="0" x2={radius} y2="0" strokeWidth="1" stroke="gray"/>
                {this.props.children}
            </svg>
        );
    }
}