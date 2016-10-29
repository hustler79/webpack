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
source: <a href="https://facebook.github.io/react/docs/thinking-in-react.html#step-4-identify-where-your-state-should-live">https://facebook.github.io/react/docs/thinking-in-react.html#step-4-identify-where-your-state-should-live</a>

    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/15.3.2/react-dom.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react-router/2.8.1/ReactRouter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>

    <script type="text/babel">

        var ProductCategoryRow = React.createClass({
            render: function() {
                return (<tr><th colSpan="2">{this.props.category}</th></tr>);
            }
        });

        var ProductRow = React.createClass({
            render: function() {
                var name = this.props.product.stocked ?
                    this.props.product.name :
                    <span style={{color: 'red'}}>
                        {this.props.product.name}
                    </span>;
                return (
                    <tr>
                        <td>{name}</td>
                        <td>{this.props.product.price}</td>
                    </tr>
                );
            }
        });

        var ProductTable = React.createClass({
            render: function() {
                var rows = [];
                var lastCategory = null;
                this.props.products.forEach(function(product) {
                    if (product.name.indexOf(this.props.filterText) === -1 || (!product.stocked && this.props.inStockOnly)) {
                        return;
                    }
                    if (product.category !== lastCategory) {
                        rows.push(<ProductCategoryRow category={product.category} key={product.category} />);
                    }
                    rows.push(<ProductRow product={product} key={product.name} />);
                    lastCategory = product.category;
                }.bind(this));
                return (
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>{rows}</tbody>
                    </table>
                );
            }
        });

        var SearchBar = React.createClass({
            handleChange: function() {
                this.props.onUserInput(
                    this.refs.filterTextInput.value,
                    this.refs.inStockOnlyInput.checked
                );
            },
            render: function() {
                return (
                    <form>
                        <input
                            type="text"
                            placeholder="Search..."
                            value={this.props.filterText}
                            ref="filterTextInput"
                            onChange={this.handleChange}
                        />
                        <p>
                            <input
                                type="checkbox"
                                checked={this.props.inStockOnly}
                                ref="inStockOnlyInput"
                                onChange={this.handleChange}
                            />
                            {' '}
                            Only show products in stock
                        </p>
                    </form>
                );
            }
        });

        var FilterableProductTable = React.createClass({
            getInitialState: function() {
                return {
                    filterText: '',
                    inStockOnly: false
                };
            },

            handleUserInput: function(filterText, inStockOnly) {
                this.setState({
                    filterText: filterText,
                    inStockOnly: inStockOnly
                });
            },

            render: function() {
                return (
                    <div>
                        <SearchBar
                            filterText={this.state.filterText}
                            inStockOnly={this.state.inStockOnly}
                            onUserInput={this.handleUserInput}
                        />
                        <ProductTable
                            products={this.props.products}
                            filterText={this.state.filterText}
                            inStockOnly={this.state.inStockOnly}
                        />
                    </div>
                );
            }
        });

        var PRODUCTS = [
            {category: 'Sporting Goods', price: '$49.99', stocked: true, name: 'Football'},
            {category: 'Sporting Goods', price: '$9.99', stocked: true, name: 'Baseball'},
            {category: 'Sporting Goods', price: '$29.99', stocked: false, name: 'Basketball'},
            {category: 'Electronics', price: '$99.99', stocked: true, name: 'iPod Touch'},
            {category: 'Electronics', price: '$399.99', stocked: false, name: 'iPhone 5'},
            {category: 'Electronics', price: '$199.99', stocked: true, name: 'Nexus 7'}
        ];

        ReactDOM.render(
            <FilterableProductTable products={PRODUCTS} />,
            document.getElementById('app')
        );

    </script>
</body>
</html>