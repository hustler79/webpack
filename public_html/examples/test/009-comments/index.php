<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        input {
            border: 1px solid black;
        }
        :focus {
            border-color: red;
        }
    </style>
</head>
<body>

    <a href="https://facebook.github.io/react/docs/jsx-in-depth.html#comments">https://facebook.github.io/react/docs/jsx-in-depth.html#comments</a>

    <div id="app"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}}

        var MyComponent = React.createClass({
            render: function() {
                return (
                    <div>
                        {/* comment */}
                        <span
                            // comment
                            id="test"
                            /* comment */
                            className="test" // comment
                        >
                            it works
                        </span>
                        {/* comment */}
                    </div>
                );
            }
        });

        ReactDOM.render(
            <MyComponent />,
            document.getElementById('app')
        );


    </script>

    <pre>
&lt;div>
    {/* comment */}
    &lt;span
        // comment
        id="test"
        /* comment */
        className="test" // comment
    >
        it works
    &lt;/span>
    {/* comment */}
&lt;/div>
    </pre>
</body>
</html>