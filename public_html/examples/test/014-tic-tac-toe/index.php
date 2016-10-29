<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font: 14px "Century Gothic", Futura, sans-serif;
            margin: 20px;
        }

        ol, ul {
            padding-left: 30px;
        }

        .board-row:after {
            clear: both;
            content: "";
            display: table;
        }

        .status {
            margin-bottom: 10px;
        }

        .square {
            background: #fff;
            border: 1px solid #999;
            float: left;
            font-size: 24px;
            font-weight: bold;
            line-height: 34px;
            height: 34px;
            margin-right: -1px;
            margin-top: -1px;
            padding: 0;
            text-align: center;
            width: 34px;
        }

        .square:focus {
            outline: none;
        }

        .kbd-navigation .square:focus {
            background: #ddd;
        }

        .game {
            display: flex;
            flex-direction: row;
        }

        .game-info {
            margin-left: 20px;
        }
        #errors {
            background: #c00;
            color: #fff;
            display: none;
            margin: -20px -20px 20px;
            padding: 20px;
            white-space: pre-wrap;
        }

    </style>
</head>
<body>

    <a href="https://facebook.github.io/react/tutorial/tutorial.html">Tutorial: Intro To React - What We're Building - tic tac toe</a>

    <div id="app"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script type="text/babel">

        function log(l) {try {console.log(l);}catch (e) {}}

        class ShoppingList extends React.Component {
            render() {
                return (
                    <div className="shopping-list">
                        <h1>Shopping List for {this.props.name}</h1>
                        <ul>
                            <li>Instagram</li>
                            <li>WhatsApp</li>
                            <li>Oculus</li>
                        </ul>
                    </div>
                );
            }
        }
        /**
         * stateless functional components
         */
        function Square(props) {
            return (
                <button className="square" onClick={() => props.onClick()}>
                    {props.value}
                </button>
            );
        }

        class Board extends React.Component {
            constructor() {
                super();
                this.state = {
                    squares: Array(9).fill(null),
                    xIsNext: true,
                };
            }
            square(i) {
                return <Square value={this.state.squares[i]} onClick={() => this.handleClick(i)}/>;
            }
            handleClick(i) {
                // https://facebook.github.io/react/tutorial/tutorial.html#why-immutability-is-important
                var s = this.state.squares.slice();
                s[i] = this.state.xIsNext ? 'X' : 'O';
                this.setState((state) => ({
                    squares: s,
                    xIsNext : !state.xIsNext
                }));
            }
            render() {
                const winner = calculateWinner(this.state.squares);
                let status;
                if (winner) {
                    status = 'Winner: ' + winner;
                } else {
                    status = 'Next player: ' + (this.state.xIsNext ? 'X' : 'O');
                }
                return (
                    <div>
                        <div className="status">{status}</div>
                        <div className="board-row">
                            {this.square(0)}
                            {this.square(1)}
                            {this.square(2)}
                        </div>
                        <div className="board-row">
                            {this.square(3)}
                            {this.square(4)}
                            {this.square(5)}
                        </div>
                        <div className="board-row">
                            {this.square(6)}
                            {this.square(7)}
                            {this.square(8)}
                        </div>
                    </div>
                );
            }
        }

        class Game extends React.Component {
            render() {
                return (
                    <div className="game">
                        <div className="game-board">
                            <Board />
                        </div>
                        <div className="game-info">
                            <div>{/* status */}</div>
                            <ol>{/* TODO */}</ol>
                        </div>
                    </div>
                );
            }
        }

        ReactDOM.render(
            <Game />,
            document.getElementById('container')
        );

        function calculateWinner(squares) {
            const lines = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6],
            ];
            for (let i = 0; i < lines.length; i++) {
                const [a, b, c] = lines[i];
                if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
                    return squares[a];
                }
            }
            return null;
        }



        window.addEventListener('mousedown', function(e) {
            document.body.classList.add('mouse-navigation');
            document.body.classList.remove('kbd-navigation');
        });
        window.addEventListener('keydown', function(e) {
            if (e.keyCode === 9) {
                document.body.classList.add('kbd-navigation');
                document.body.classList.remove('mouse-navigation');
            }
        });
        window.addEventListener('click', function(e) {
            if (e.target.tagName === 'A' && e.target.getAttribute('href') === '#') {
                e.preventDefault();
            }
        });

        window.onerror = function(message, source, line, col, error) {
            var text = error ? error.stack || error : message + ' (at ' + source + ':' + line + ':' + col + ')';
            errors.textContent += text + '\n';
            errors.style.display = '';
        };

        console.error = (function(old) {
            return function error() {
                errors.textContent += Array.prototype.slice.call(arguments).join(' ') + '\n';
                errors.style.display = '';
                old.apply(this, arguments);
            }
        })(console.error);



    </script>

    <div id="errors"></div>
    <div id="container"></div>
</body>
</html>