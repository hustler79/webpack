<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <a href="https://facebook.github.io/react/docs/reusable-components.html">https://facebook.github.io/react/docs/reusable-components.html</a>

    <div id="app"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script type="text/babel">
        function log(l) {try {console.log(l);}catch (e) {}}

        var Avatar = React.createClass({
            propTypes: {
                test: React.PropTypes.string,
                bool: React.PropTypes.bool.isRequired,

                // https://facebook.github.io/react/docs/reusable-components.html#single-child
                children: React.PropTypes.element.isRequired
            },
            getDefaultProps: function() {
                return {
                    bool: true
                };
            },
            render: function() {
                // wyciągam te które nie mogą być przekazane dalej
                // https://facebook.github.io/react/warnings/unknown-prop.html
                // g(The unknown-prop warning will fire if you attempt to render a DOM element with a prop that is not recognized by React as a legal DOM)


                // g(Destructuring assignment)
                // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment
                const { test, bool, ...rest } = this.props;

                // g(Rest and Spread Properties)
                var { x, y, ...z } = { x: 1, y: 2, a: 3, b: 4 }; // https://facebook.github.io/react/docs/transferring-props.html#rest-and-spread-properties-...
//                x; // 1
//                y; // 2
//                z; // { a: 3, b: 4 }

                return (
                    <div {...rest}> {/* JSX Spread Attributes  */}
                        {this.props.children}
                        {this.props.bool && <span>bool = true</span>}
                    </div>
                );
            }
        });

        ReactDOM.render(
            <Avatar test="Engineering" className="add-this-class" data-test="testval">
                <span>Must be children</span>
            </Avatar>,
            document.getElementById('app')
        );


    </script>
</body>
</html>