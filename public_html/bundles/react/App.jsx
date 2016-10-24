'use strict';

import React from 'react';
import ajax from 'lib/ajax';
import log from 'log';
import { autobind } from 'core-decorators';

export default class App extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            input: '',
            description: 'default',
            radio: 'female',
            checkbox: false,
            checkboxc: false,
            single: '',
            multiple: [],
            save: false
        }
    }
    componenDidMount() {
        var that = this;
        ajax(this.props.url, null, function (json) {
            setTimeout(function () {
                that.setState(json);
            }, 1000);
        });
    }
    @autobind
    onChangeInput(e) {
        this.setState({input: e.target.value});
    }
    @autobind
    onChangeDescription(e) {
        this.setState({description: e.target.value});
    }
    @autobind
    onChangeCheckbox(e) {
        this.setState({checkbox: e.target.checked});
    }
    @autobind
    onChangeComponent(e) {
        this.setState({checkboxc: e.target.checked});
    }
    @autobind
    onChangeRadio(e) {
        this.setState({radio: e.target.value});
    }
    @autobind
    onChangeSingle(e) {
        this.setState({
            single: e.target.value || null
        });
    }
    @autobind
    onChangeMultiple(e) {
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
    }
    @autobind
    onSubmit(e) {
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
    }
    @autobind
    render() {

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

                    <img className="gender" src={'/bundles/img/'+this.state.radio+'.bmp'}/>
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
                    {/*<Icheckbox onChange={this.onChangeComponent} checked={this.state.checkboxc}/>*/}
                </div>
                <div>
                    <label htmlFor="checkboxc" className="icontrol">
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
                        { (this.state.single === 'apple') && <img src={'/bundles/img/apple.bmp'}/> }
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
                            return <img key={i} src={'/bundles/img/' + i + '.bmp'} />
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
}


