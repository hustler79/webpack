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

    <a href="https://facebook.github.io/react/docs/more-about-refs.html#a-complete-example">https://facebook.github.io/react/docs/more-about-refs.html#a-complete-example</a>

    <div id="app"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}}

        var MyComponent = React.createClass({
            componentDidMount: function () {
                log('componentDidMount')
                log(this.first)
                setTimeout(() => {
                    log('settimeout - focus does"t work')
                    this.first.focus();
                }, 1000);
            },
            handleClick: function() {
                // Explicitly focus the text input using the raw DOM API.
                if (this.myTextInput) {
                    this.myTextInput.focus();
                }
            },
            render: function() {
                // The ref attribute is a callback that saves a reference to the
                // component to this.myTextInput when the component is mounted.
                return (
                    <div>
                        <input type="text"
                               ref={(ref) => this.myTextInput = ref}
                               value="focus after click"
                        />
                        <input
                            type="button"
                            value="focus"
                            onClick={this.handleClick}
                        />
                        <input type="text" ref={(ref) => this.first = ref} value="focus here on start"/>
                    </div>
                );
            }
        });

        ReactDOM.render(
            <MyComponent />,
            document.getElementById('app')
        );


    </script>
</body>
</html>