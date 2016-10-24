'use strict';

import 'scss/react.scss';
import 'css/icontrol_big_gray.css';
import React from 'react';
import ReactDOM from 'react-dom';
import {render} from 'react-dom';
import App from 'react/App';
//
//
//
//
// // export default class CatCounter extends React.Component {
// //   constructor(props) {
// //     super(props);
// //
// //     this.state = { amount: 0 };
// //     this.sawCats = this.sawCats.bind(this);
// //   }
// //   render() {
// //     return (
// //       <div>
// //         <CatsSeen amount={this.state.amount} />
// //         <SawCat className="cat-button"
// //                 amount={this.state.amount} onClick={this.sawCats} />
// //       </div>
// //     );
// //   }
// //   sawCats(amount) {
// //     this.setState({ amount: amount + 1 });
// //   }
// // }
//
//
render(<App url="db.php"/>, document.getElementById('app'));
