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

        var Avatar = React.createClass({
            render: function() {
                return (
                    <div>
                        <PagePic pagename={this.props.pagename} />
                        <PageLink pagename={this.props.pagename} />
                    </div>
                );
            }
        });

        var PagePic = React.createClass({
            render: function() {
                return (
                    <img src={'https://graph.facebook.com/' + this.props.pagename + '/picture'} />
                );
            }
        });

        var PageLink = React.createClass({
            render: function() {
                return (
                    <a href={'https://www.facebook.com/' + this.props.pagename}>
                        {this.props.pagename}
                    </a>
                );
            }
        });

        ReactDOM.render(
            <Avatar pagename="Engineering" />,
            document.getElementById('app')
        );


    </script>
</body>
</html>