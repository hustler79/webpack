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

        function Square(props) {
            return (
                <button className="square" onClick={() => props.onClick()}>
                    {props.value}
                </button>
            );
        }

        class Board extends React.Component {
            renderSquare(i) {
                return <Square value={this.props.squares[i]} onClick={() => this.props.onClick(i)} />;
            }
            render() {
                return (
                    <div>
                        <div className="board-row">
                            {this.renderSquare(0)}
                            {this.renderSquare(1)}
                            {this.renderSquare(2)}
                        </div>
                        <div className="board-row">
                            {this.renderSquare(3)}
                            {this.renderSquare(4)}
                            {this.renderSquare(5)}
                        </div>
                        <div className="board-row">
                            {this.renderSquare(6)}
                            {this.renderSquare(7)}
                            {this.renderSquare(8)}
                        </div>
                    </div>
                );
            }
        }

        class Game extends React.Component {
            constructor(...args) {
                super(...args);
                this.state = {
                    history: [Array(9).fill(null)],
                    stepNumber: 0,
                    xIsNext: true,
                };
            }
            handleClick(i) {
                var history = this.state.history.slice(0, this.state.stepNumber + 1);
                var current = history[history.length - 1];
                const squares = current.slice();
                if (calculateWinner(squares) || squares[i]) {
                    return;
                }

                squares[i] = this.state.xIsNext ? 'X' : 'O';

                this.setState({
                    history: history.concat([squares]),
                    stepNumber: history.length,
                    xIsNext: !this.state.xIsNext,
                });
            }
            jumpTo(step) {
                this.setState({
                    stepNumber: step,
                    xIsNext: (step % 2) ? false : true,
                });
            }
            render() {
                const history = this.state.history;
                const current = history[this.state.stepNumber];

                const winner = calculateWinner(current);
                let status;
                if (winner) {
                    status = 'Winner: ' + winner;
                } else {
                    status = 'Next player: ' + (this.state.xIsNext ? 'X' : 'O');
                }

                const moves = history.map((step, move) => {
                    const desc = move ?
                    'Move #' + move :
                        'Game start';
                    return (
                        <li key={move}>
                            <a href="#" onClick={() => this.jumpTo(move)}>{desc}</a>
                        </li>
                    );
                });

                return (
                    <div className="game">
                        <div>
                            <Board
                                squares={current}
                                onClick={(i) => this.handleClick(i)}
                            />
                        </div>
                        <div className="game-info">
                            <div>{status}</div>
                            <ol>{moves}</ol>
                        </div>
                    </div>
                );
            }
        }

        // ========================================

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



    </script>
    <br>

    <div id="errors"></div>
    <div id="container"></div>
</body>
</html>