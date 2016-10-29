<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
    <style>
        #app {
            border: 1px solid gray;
        }
    </style>
    <script type="text/babel">
        var App = React.createClass({
            onClick: function () {
                alert('onClick event')
            },
            render: function () {
                return (
                    <div className="parent">
                        <div className="child">
                            text at the beginning
                            <button onClick={this.onClick}>click me</button>
                            text after span
                        </div>
                        <h3>another span</h3>
                        simple text in parent
                        <span dangerouslySetInnerHTML={{__html: 'html <b>bold</b>'}}></span>
                    </div>
                );
            }
        });
        ReactDOM.render(<App />, document.getElementById('app'));
    </script>
</head>
<body>
    <a href="https://babeljs.io/repl/#?babili=false&evaluate=false&lineWrap=false&presets=react&code=%3Cdiv%20className%3D%22parent%22%3E%0A%20%20%20%20%3Cdiv%20className%3D%22child%22%3E%0A%20%20%20%20%20%20%20%20text%20at%20the%20beginning%0A%20%20%20%20%20%20%20%20%3Cbutton%20onClick%3D%7Bthis.onClick%7D%3Eclick%20me%3C%2Fbutton%3E%0A%20%20%20%20%20%20%20%20text%20after%20span%0A%20%20%20%20%3C%2Fdiv%3E%0A%20%20%20%20%3Ch3%3Eanother%20span%3C%2Fh3%3E%0A%20%20%20%20simple%20text%20in%20parent%0A%20%20%20%20%3Cspan%20dangerouslySetInnerHTML%3D%7B%7B__html%3A%20%27html%20%3Cb%3Ebold%3C%2Fb%3E%27%7D%7D%3E%3C%2Fspan%3E%0A%3C%2Fdiv%3E">online converter</a>
    <div id="app"></div>
</body>
</html>