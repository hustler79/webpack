<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/icontrol_big_gray.css">
    <style>
        #app {
            border: 1px solid gray;
        }
        input[type="text"],
        textarea {
            width: 400px;
        }
        form > div {
            padding: 4px;
        }
        .relative {
            position: relative;
        }
        img.gender {
            position: absolute;
            top: 14px;
            left: 100px;
        }
        div.single {
            position: absolute;
            top: -2px;
            left: 142px;
            display: inline-block;
        }
        div.multiple {
            position: absolute;
            top: 14px;
            left: 103px;
            display: inline-block;
        }
        .icontrol .fake {
            margin-right: 10px;
            margin-left: 4px;
            margin-bottom: -5px;
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

        var Icheckbox = React.createClass({
            render: function () {
                return (
                    <label for="checkboxc" className="icontrol">
                        <input id="twodis" name="checkboxc" type="checkbox"
                               checked={this.props.checked}
                               onChange={this.props.onChange}
                        />
                        <span className="fake"></span>
                        checked component
                    </label>
                );
            }
        });

        var App = React.createClass({
            getInitialState: function () {
                return {
                    input: '',
                    description: 'default',
                    radio: 'female',
                    checkbox: false,
                    checkboxc: false,
                    single: '',
                    multiple: [],

                    save: false
                };
            },
            componentDidMount: function() {
                var that = this;
                ajax(this.props.url, null, function (json) {
                    setTimeout(function () {
                        that.setState(json);
                    }, 1000);
                });
            },
            onChangeInput: function (e) {
                this.setState({input: e.target.value});
            },
            onChangeDescription: function (e) {
                this.setState({description: e.target.value});
            },
            onChangeCheckbox: function (e) {
                this.setState({checkbox: e.target.checked});
            },
            onChangeComponent: function (e) {
                this.setState({checkboxc: e.target.checked});
            },
            onChangeRadio: function (e) {
                this.setState({radio: e.target.value});
            },
            onChangeSingle: function (e) {
                this.setState({
                    single: e.target.value || null
                });
            },
            onChangeMultiple: function (e) {
                var options = e.target.options;
                var value = [];
                for (var i = 0, l = options.length; i < l; i++) {
                    if (options[i].selected) {
                        value.push(options[i].value);
                    }
                }
                this.setState({
                    multiple: value
                });
            },
            onSubmit: function (e) {
                e.preventDefault();
                var that = this;
                setTimeout(function () {
                    that.setState({
                        save: true
                    });
                }, 0);
                ajax(this.props.url, this.state, function () {
                    that.setState({
                        save: false
                    });
                });
            },
            render: function () {

                log(this.state);

                return (
                    <form onSubmit={this.onSubmit}>
                        <h3>Simple form</h3>
                        <div>
                            <label htmlFor="input">
                                <input type="text" name="input" value={this.state.input} onChange={this.onChangeInput} />
                            </label>
                        </div>
                        <div>
                            <label htmlFor="description">
                                <textarea name="description" value={this.state.description} onChange={this.onChangeDescription}></textarea>
                            </label>
                        </div>
                        <div className="relative">
                            <label htmlFor="male">
                                <input type="radio" name="radio" id="male" value="male"
                                       checked={this.state.radio === 'male'} onChange={this.onChangeRadio}
                                /> male
                            </label>

                            <img className="gender" src={'img/'+this.state.radio+'.bmp'}/>
                        </div>
                        <div>
                            <label htmlFor="female">
                                <input type="radio" name="radio" id="female" value="female"
                                       checked={this.state.radio === 'female'} onChange={this.onChangeRadio}
                                /> female
                            </label>
                        </div>
                        <div>
                            <label htmlFor="checkbox">
                                <input type="checkbox" id="checkbox"
                                       checked={this.state.checkbox}
                                       onChange={this.onChangeCheckbox} /> checkbox
                            </label>
                        </div>
                        <div>
                            <Icheckbox onChange={this.onChangeComponent} checked={this.state.checkboxc}/>
                        </div>
                        <div>
                            <label for="checkboxc" className="icontrol">
                                <input id="twodis" name="checkboxc" type="checkbox"
                                       checked={this.state.checkboxc}
                                       onChange={this.onChangeComponent}
                                />
                                <span className="fake"></span>
                                checked component
                            </label>
                        </div>
                        <div className="relative">
                            <label htmlFor="single">
                                <select value={this.state.single} name="single" onChange={this.onChangeSingle}>{/* https://facebook.github.io/react/docs/forms.html#why-select-value */}
                                    <option value="">-=select=-</option>
                                    <option value="apple">Apple</option>
                                    <option value="banana">banana</option>
                                    <option value="cranberry">cranberry</option>
                                </select> single
                            </label>
                            <div className="single">
                                { (this.state.single === 'apple') && <img src={'img/apple.bmp'}/> }
                            </div>
                        </div>
                        <div className="relative">
                            <label htmlFor="multiple">
                                <select value={this.state.multiple} name="multiple" multiple={true} onChange={this.onChangeMultiple}>{/* https://facebook.github.io/react/docs/forms.html#why-select-value */}
                                    <option value="apple">Apple</option>
                                    <option value="banana">banana</option>
                                    <option value="cranberry">cranberry</option>
                                </select> multiple
                            </label>
                            <div className="multiple">
                                {this.state.multiple.map(function (i) {
                                    return <img key={i} src={'img/' + i + '.bmp'} />
                                })}
                            </div>
                        </div>
                        <div>
                            <input type="submit"
                                   value={this.state.save ? 'Saving...' : 'Submit'}
                                   disabled={this.state.save}
                            />
                        </div>
                    </form>
                );
            }
        });
        ReactDOM.render(<App url="db.php"/>, document.getElementById('app'));
    </script>
</body>
</html>