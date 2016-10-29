<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google test - title from html (means that changing by document.title doesn't work)</title>
    <style>
        .level {
            border: 1px dashed gray;
            padding: 5px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div id="app"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script src="../lib/ajax.js"></script>

    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}}

        var Router = ReactRouter.Router;
        var Route = ReactRouter.Route;
        var IndexRoute = ReactRouter.IndexRoute;
        var browserHistory = ReactRouter.browserHistory;
        var Link = ReactRouter.Link;

        var base = location.pathname.replace(/^(.*?)\/[^\/]+$/, '$1');

        var App = React.createClass({
            render() {
                return (
                    <div className="level">
                        <h3>React Router Tutorial</h3>
                        <ul role="nav">
                            <li><Link to={base + "/index.php"} onlyActiveOnIndex>Home</Link></li>
                            <li>
                                <Link to={base + "/child.php"}>Child</Link>
                                <ul>
                                    <li><Link to={base + "/child-level2.php"}>Child2</Link></li>
                                </ul>
                            </li>
                            <li><Link to={base + "/ajax.php"}>Ajax</Link></li>
                        </ul>
                        {this.props.children}
                    </div>
                )
            }
        });

        var Home = React.createClass({
            componentDidMount: function () {
                document.title = "Google test - changed by document.title"
            },
            render: function () {
                return (
                    <div className="level">
                        Homepage
                        {this.props.children}
                    </div>
                );
            }
        });

        var Child = React.createClass({
            componentDidMount: function () {
                document.querySelector('title').innerHTML = 'Google test - child 1 - changed by innerHTML';
            },
            render: function () {
                return (
                    <div className="level">
                        First level of nesting
                        <div>
                            {this.props.children}
                        </div>
                    </div>
                );
            }
        });

        var Child2 = React.createClass({
            componentDidMount: function () {
                document.querySelector('title').innerHTML = 'Google test - child 2 - changed by innerHTML';
            },
            render: function () {
                return (
                    <div className="level">
                        Second level of nesting
                        <div>
                            {this.props.children}
                        </div>
                    </div>
                );
            }
        });


        var Ajax = React.createClass({
            getInitialState: function () {
                return {
                    text: ''
                };
            },
            componentDidMount() {
                document.querySelector('title').innerHTML = 'Google test - ajax page - changed by innerHTML';

                var that = this;

                fetch('ajax.json')
                    .then(function (response) {
                        return response.json()
                    })
                    .then(function (json) {
                        that.setState(json);
                    })
                ;
            },
            render: function () {
                return (
                    <div className="level" dangerouslySetInnerHTML={{__html: this.state.text}}></div>
                );
            }
        })

        ReactDOM.render((
            <Router history={browserHistory}>
                <Route path={base + "/index.php"} component={App}>
                    <IndexRoute component={Home} />
                    <Route path={base + "/child.php"} component={Child}>
                        <Route path={base + "/child-level2.php"} component={Child2} />
                    </Route>
                    <Route path={base + "/ajax.php"} component={Ajax} />
                </Route>
            </Router>
        ), document.getElementById('app'));

    </script>
</body>
</html>