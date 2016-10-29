<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<p>Używasz setInterval i się nie przejmujesz sprzątaniem</p>

<a href="https://facebook.github.io/react/docs/reusable-components.html#mixins">https://facebook.github.io/react/docs/reusable-components.html#mixins</a>

<div id="app"></div>

<script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

<script type="text/babel">

    function log(l) {try {console.log(l);}catch (e) {}}

    var SetIntervalMixin = {
        componentDidMount: function () {
            log('componentDidMount from mixin')
        },
        componentWillMount: function() {
            this.intervals = [];
        },
        setInterval: function() {
            this.intervals.push(setInterval.apply(null, arguments));
        },
        componentWillUnmount: function() {
            this.intervals.forEach(clearInterval);
        }
    };

    var TickTock = React.createClass({
        mixins: [SetIntervalMixin], // Use the mixin
        getInitialState: function() {
            return {seconds: 0};
        },
        componentDidMount: function() {
            log('componentDidMount from component')
            this.setInterval(this.tick, 1000); // Call a method on the mixin
        },
        tick: function() {
            this.setState({seconds: this.state.seconds + 1});
        },
        render: function() {
            return (
                <p>
                    React has been running for {this.state.seconds} seconds.
                </p>
            );
        }
    });

    ReactDOM.render(
        <TickTock />,
        document.getElementById('app')
    );


</script>
</body>
</html>