<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <a href="https://facebook.github.io/react/docs/working-with-the-browser.html">https://facebook.github.io/react/docs/working-with-the-browser.html</a>

    <div id="app"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}}

        var Tests = React.createClass({
            propTypes: {
                test: React.PropTypes.string,
                bool: React.PropTypes.bool.isRequired,

                // https://facebook.github.io/react/docs/reusable-components.html#single-child
                children: React.PropTypes.element.isRequired
            },
            getInitialState: function () {
                return {
                    test: 'test'
                };
            },
            componentWillMount: function () {
                log('componentWillMount');
            },
            componentDidMount: function () {
                log('componentDidMount');
            },
            componentWillUpdate: function (nextProps, nextState) { // https://facebook.github.io/react/docs/working-with-the-browser.html#updating
                log('componentWillUpdate');
            },
            componentDidUpdate: function (prevProps, prevState) {
                log('componentDidUpdate');
            },
            componentWillReceiveProps: function(nextProps) {
                log('componentWillReceiveProps, nextProps.color: '+nextProps.color+' this.props.color: '+this.props.color);

                // change state if you like according props
            },
            componentWillUnmount: function () { // https://facebook.github.io/react/docs/working-with-the-browser.html#unmounting
                log('componentWillUnmount');
            },
            shouldComponentUpdate: function (nextProps, nextState) {
                log('shouldComponentUpdate');
                return true;
            },
            getDefaultProps: function () {
                log('getDefaultProps');
                return {
                    bool: true
                };
            },
            render: function () {
                log('render');

                const {bool, color, ...props} = this.props;

                return (
                    <div {...props}>Test</div>
                );
            }
        });

        var Parent = React.createClass({
            getInitialState: function () {
                return {
                    show: true,
                    change: true
                };
            },
            onClick: function (e) {
                log('onClick')
                this.setState(prevState => ({
                    show: !prevState.show
                }));
            },
            onChange: function (e) {
                log('onClick')
                this.setState({
                    change: !this.state.change
                });
            },
            render: function () {
                var color = this.state.change ? 'red' : 'blue';
                return (
                    <div>

                        Toggle:
                        <button onClick={this.onClick}>
                            {this.state.show ? 'On' : 'Off'}
                        </button>

                        <br/>

                        Change prop:
                        <button onClick={this.onChange} style={{color:color}}>
                            {color}
                        </button>

                        {this.state.show && <Tests color={color}><span>children</span></Tests>}
                    </div>
                );
            }
        });



        ReactDOM.render(
            <Parent />,
            document.getElementById('app')
        );


    </script>
</body>
</html>