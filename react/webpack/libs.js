var glob      = require("glob");
var path      = require("path");
var colors    = require('colors');

module.exports = {
    entry: function () {
        // https://github.com/dylansmith/node-pathinfo/blob/master/index.js
        // http://php.net/manual/en/function.pathinfo.php#refsect1-function.pathinfo-examples
        var list = glob.sync('src/**/*.entry.{js,jsx}');
        var t, tmp = {};
        for (var i = 0, l = list.length ; i < l ; i += 1 ) {
            t = list[i];
            t = path.basename(t, path.extname(t));
            t = path.basename(t, path.extname(t));
            tmp[t] = './' + list[i];
        }
        return tmp;
    },
    env: function () {
        var t, BreakException = {};
        try {
            process.argv.forEach(function (abs) {
                if (path.basename(abs) === 'webpack.js') {
                    throw BreakException
                }
            });
        } catch (e) {
            if (e === BreakException) {
                return 'prod';
            }
            else {
                throw e;
            }
        }

        return process.argv.indexOf('watch') > -1 ? 'dev' : 'prod';
    },
    envlog: function () {
        var env = this.env();
        console.log('env: '.yellow + env.red + "\n");
        return env;
    }
};


