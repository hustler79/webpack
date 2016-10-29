<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <div id="app"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script type="text/babel">
        function log(l) {try {console.log(l);}catch (e) {}}

        var App = React.createClass({
            getInitialState: function() {
                return {
                    radio: 'one'
                };
            },
            onChangeRadio: function(e) {
                e.preventDefault();
                log('onChangeRadio')
                this.setState({
                    radio: e.target.value
                });

                var that = this;
                var event = e.nativeEvent; // solution 1 - można dostać sie też do natywnego eventu który nie ginie z czasem

                e.persist(); // solution 2 - w ten sposób za chwilę nie zginie ten event, normlanie by został posprzątany
                // powyższym można sprawić że synthetic event nie zginei za chwilę

                setTimeout(function () {
                    log(event.target.value) // solution 1 : https://facebook.github.io/react/docs/events.html#syntheticevent
                    log(e.target.value) // solution 2
                    log(that.state)
                }, 10)
            },
            render: function() {
                return (
                    <div>
                        <label htmlFor="radio1">
                            <input type="radio" name="radio"
                                   id="radio1"
                                   value="one"
                                   checked={this.state.radio === 'one'}
                                   onChange={this.onChangeRadio}
                            />
                            one
                        </label>
                        <label htmlFor="radio2">
                            <input type="radio" name="radio"
                                   id="radio2"
                                   value="two"
                                   checked={this.state.radio === 'two'}
                                   onChange={this.onChangeRadio}
                            />
                            two
                        </label>
                    </div>
                );
            }
        });

        ReactDOM.render(
            <App />,
            document.getElementById('app')
        );


    </script>
</body>
</html>