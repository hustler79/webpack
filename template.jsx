
var React = require('react');
var ReactDOM = require('react-dom');

var Sandbox = React.createClass({
    propTypes: {
        leave: React.PropTypes.bool,
        appearTimeout: React.PropTypes.number
    },
    onClick: function () {
        alert('onClick event')
    },
    render: function () {
        return (
        );
    }
});

ReactDOM.render(<App />, document.getElementById('app'));