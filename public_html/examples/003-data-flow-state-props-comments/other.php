<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>React Tutorial</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.1/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.1/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
    <script src="https://unpkg.com/jquery@3.1.0/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/remarkable@1.6.2/dist/remarkable.min.js"></script>
</head>
<body>
    <div id="app"></div>
    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}}

        var CommentBox = React.createClass({
            focus: function () {
                this._input.focus(); // doesn't work
            },
            onSubmit: function (e) {
                e.preventDefault();
                log('onSubmit')
            },
            render: function() {
                return (
                    <div className="commentBox">
                        <span disabled >No value in attribute? - default true</span>

                        <h3 disabled={true}>Hello, world! I am a CommentBox.</h3>

                        <form onSubmit={this.onSubmit}>
                            <label htmlFor="input">
                                <input
                                    type="text"
                                    name="input"
                                    defaultValue="placeholder"
                                    autoComplete="off"
                                    ref={(r) => this._input = r}
                                />
                            </label>
                            <button onClick={this.focus}>focus</button>

                            <span dangerouslySetInnerHTML={{__html: 'use of <b>dangerouslySetInnerHTML</b>'}} />
                        </form>

                        <input type="text" ref={(r) => this._text = r}/>
                    </div>
                );
            },
            componentDidMount: function () {
                this._text.focus();
                log('componentDidMount')
            }
        });

        ReactDOM.render(<CommentBox />, document.getElementById('app'));
    </script>
</body>
</html>