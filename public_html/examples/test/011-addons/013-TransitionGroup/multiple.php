<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .example-enter {
            opacity: 0.4;
        }
        .example-enter.example-enter-active {
            opacity: 1;
            transition: opacity 500ms ease-in;
        }
        .example-leave {
            opacity: 1;
        }
        .example-leave.example-leave-active {
            opacity: 0.4;
            transition: opacity 300ms ease-in;
        }
    </style>
</head>
<body>

    <a
        href="https://facebook.github.io/react/docs/animation.html"
        target="_blank"
    >
        React provides a ReactTransitionGroup add-on component as a low-level API for animation
    </a>

    <div id="app"></div>

<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-with-addons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>

    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}}

        var list = 'One|Two|Three'.split('|');

        var TodoList = React.createClass({
            i: 0,
            getInitialState: function() {
                return {items: ['hello', 'world', 'click', 'me']};
            },
            handleAdd: function() {
                var newItems = this.state.items.concat([list[this.i]]);
                this.setState({items: newItems});

                this.i = (this.i+1) % list.length;
            },
            handleRemove: function(i) {
                var newItems = this.state.items.slice();
                newItems.splice(i, 1);
                this.setState({items: newItems});
            },
            render: function() {
                var items = this.state.items.map(function(item, i) {
                    return (
                        <Div key={item} onClick={this.handleRemove.bind(this, i)}>
                            {item}
                        </Div>
                    );
                }.bind(this));
                return (
                    <div>
                        <button onClick={this.handleAdd}>Add Item</button>
                        <React.addons.TransitionGroup
                            component="div"   // see: https://facebook.github.io/react/docs/animation.html#rendering-a-different-component
                            className="class-for-parent"
                            transitionName="example"
                            transitionEnterTimeout={2500} // transitionEnter={false}
                            transitionLeaveTimeout={2300}>
                            {items}
                        </React.addons.TransitionGroup>
                    </div>
                );
            }
        });

        var Div = React.createClass({
            // example: http://stackoverflow.com/a/31378680
            show: function(callback) {
                var node = ReactDOM.findDOMNode(this);
                TweenMax.fromTo(node, 2, {
                    width: 400,
                    height: 23,
                    backgroundColor: '#0cc',
                    scale: 0.2,
                    opacity: 0,
                    rotation: -180
                }, {
                    width: 400,
                    height: 23,
                    backgroundColor: '#0cc',
                    scale: 1,
                    opacity: 1,
                    rotation: 0,
                    ease: Expo.easeInOut,
                    onComplete: callback,
                    onCompleteScope: this
                });
            },
            hide: function(callback) {
                var node = ReactDOM.findDOMNode(this);
                TweenMax.to(node, 2, {
                    width: 400,
                    height: 23,
                    backgroundColor: '#cc0',
                    scale: 0.2,
                    opacity: 0,
                    ease: Expo.easeInOut,
                    onComplete: callback,
                    onCompleteScope: this
                });
            },
            // podnosza sie gdy komponent jest montowany na starcie
            // z zasady bez animacji
            componentDidAppear: function () {
                log('componentDidAppear');
            },
            componentWillAppear: function (callback) {
                log('componentWillAppear');
                this.show(callback);
            },

            // odpalają się wtej kolejnosći zaczynając od componentDidMount
            // podnoszone są jak komponent jest dynamicznie umieszczany w dom
            componentDidMount: function () {
                log('componentDidMount');
            },

            componentWillEnter: function (callback) {
                log('componentWillEnter');
                this.show(callback);
            },
            componentDidEnter: function () {
                log('componentDidEnter');
            },
            componentWillLeave: function (callback) {
                log('componentWillLeave');
                this.hide(callback);
            },
            componentDidLeave: function () {
                log('componentDidLeave');
            },


            render: function () {
                return (
                    <div {...this.props}>
                        {this.props.children}
                    </div>
                );
            }
        });

        ReactDOM.render(
            <TodoList />,
            document.getElementById('app')
        );


    </script>
</body>
</html>