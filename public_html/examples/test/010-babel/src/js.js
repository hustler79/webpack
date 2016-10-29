var MyComponent = React.createClass({
  render: function() {
    return (
      <div>
        {/* comment */}
        <span
          // comment
          id="test"
          /* comment */
          className="test" // comment
        >
          it works
        </span>
        {/* comment */}
      </div>
    );
  }
});

ReactDOM.render(
  <MyComponent />,
  document.getElementById('app')
);