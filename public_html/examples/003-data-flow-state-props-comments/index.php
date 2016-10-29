<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>React Tutorial</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
    <script src="https://unpkg.com/jquery@3.1.0/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/remarkable@1.6.2/dist/remarkable.min.js"></script>

    <!-- other tools vvv -->
    <script src="../lib/ajax.js"></script>
</head>
<body>
    <div id="app"></div>
    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}};

        var CommentList = React.createClass({
            render: function() {
                return (
                    <div className="commentList">
                        {this.props.data.map(function (d) {
                            return <Comment key={d.id} author={d.author}>{d.text}</Comment>
                        })}
                    </div>
                );
            }
        });

        var CommentForm = React.createClass({
            getInitialState: function () {
                return {
                    author: '',
                    text: ''
                };
            },
            onChangeAuthor: function (e) {
                this.setState({
                    author: e.target.value
                });
                log('onChangeAuthor')
            },
            onChangeText: function (e) {
                this.setState({
                    text: e.target.value
                });
                log('onChangeText')
            },
            onSubmit: function (e) {

                log('submit')

                e.preventDefault();

                var author = this.state.author.trim();

                var text = this.state.text.trim();

                if (!author || !text) {
                    return;
                }

                this.props.onCommentSubmit({
                    author: author,
                    text: text
                });

                this.setState({
                    author: '',
                    text: ''
                });

            },
            render: function() {
                return (
                    <form className="commentForm" onSubmit={this.onSubmit}>
                        <input
                            type="text"
                            name="author"
                            placeholder="Your name"
                            onChange={this.onChangeAuthor}
                            value={this.state.author}
                        />
                        <input
                            type="text"
                            name="text"
                            placeholder="Say something..."
                            onChange={this.onChangeText}
                            value={this.state.text}
                        />
                        <input
                            type="submit"
                            value="Post"
                        />
                    </form>
                );
            }
        });

        var CommentBox = React.createClass({
            getInitialState: function () {
                return {
                    data: []
                };
            },
            componentDidMount: function () {
                this.fetch();
                setInterval(this.fetch, this.props.interval);
            },
            fetch: function () {
                var that = this;
                fetch(this.props.url)
                    .then(function (resp) {
                        return resp.json()
                    })
                    .then(function (json) {
                        that.setState({
                            data: json
                        });
                    })
            },
            handleCommentSubmit: function(comment) {
                ajax(this.props.url, comment);
                this.fetch();
            },
            render: function() {
                return (
                    <div className="commentBox">
                        <h3>Comments</h3>
                        <CommentList data={this.state.data} />
                        <CommentForm onCommentSubmit={this.handleCommentSubmit} />
                    </div>
                );
            }
        });

        var Comment = React.createClass({
            rawMarkup: function() {
                var md = new Remarkable();
                var rawMarkup = md.render(this.props.children.toString());
                return { __html: rawMarkup };
            },
            render: function() {
                var md = new Remarkable();
                return (
                    <div className="comment">
                        <h2 className="commentAuthor">
                            {this.props.author}
                        </h2>
                        <span dangerouslySetInnerHTML={this.rawMarkup()} />
                    </div>
                );
            }
        });

        ReactDOM.render(<CommentBox url="db.php" interval="2000"/>, document.getElementById('app'));
    </script>
</body>
</html>