var glob      = require("glob");
var path      = require("path");
var colors    = require('colors');

function findentries(root) {
    const list = glob.sync(root + "/**/*.entry.{js,jsx}");
    let tmp, entries = {};

    for (let i = 0, l = list.length; i < l; i++) {
        tmp = path.parse(list[i]);
        tmp = path.basename(tmp.name, path.extname(tmp.name));
        entries[tmp] = list[i];
    }
    return entries;
}

module.exports = {
    config: false,
    setup: function (setup) {
        if (setup && !this.config) {
            this.config = require(setup);
        }
    },
    entry: function () {

        var root = this.con('js.entries');

        if (!root) {
            throw "First specify root path for entry";
        }

        if (Object.prototype.toString.call( root ) !== '[object Array]') {
            root = [root];
        }

        var t, i, tmp = {};

        root.forEach(function (r) {

            t = findentries(r);

            for (i in t) {

                if (tmp[i]) {
                    throw "Entry file key '"+i+"' generated from file '"+t[i]+"' already exist";
                }

                tmp[i] = t[i];
            }
        });

        return tmp;
    },
    con: function (key, from) {

        if (!from) {

            if (!this.config) {
                throw "first call utils.setup()";
            }

            from = this.config;
        }

        if (key) {

            key = key + '';

            if (key.indexOf('.') > -1) {
                var tkey, keys = key.split('.');
                try {
                    while (tkey = keys.shift()) {
                        from = this.con(tkey, from);
                    }
                }
                catch (e) {
                    throw "Can't find data under key: " + key;
                }

                return from;
            }

            if ( ! from[key]) {
                throw "Can't find data under key: " + key;
            }

            return from[key];
        }

        return from;
    }
};


