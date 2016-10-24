// http://madole.xyz/using-webpack-to-set-up-polyfills-in-your-site/
// https://webpack.github.io/docs/shimming-modules.html
export default ((() => {
    try {
        return console.log;
    }
    catch(e) {
        return () => {}
    }
})());2