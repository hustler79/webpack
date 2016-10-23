http://webpack.github.io/docs/usage.html
oraz
http://webpack.github.io/docs/tutorials/getting-started/

npm install -g yarn
yarn install

npm run prod        -- production mode (don't uglify and don't generate sourcefiles)
webpack             -- run without gulp (faster version of 'npm run prod'
npm run dev         -- dev mode (uglify and generate sourcefiles)
npm run info        -- more info
npm run analyze     -- generate analyze file
    https://webpack.github.io/analyse/
    https://chrisbateman.github.io/webpack-visualizer/



node node_modules/webpack/bin/webpack.js  ./entry.js bundle.js --progress --colors
# jest też watch ale gówniany na maksa
node node_modules/webpack/bin/webpack.js  ./entry.js bundle.js --progress --colors --watch

build react examples:
    http://moduscreate.com/optimizing-react-es6-webpack-production-build/


obczaić:
    webpack --watch --progress --config webpack.dev
    webpack --config webpack.prod

https://www.youtube.com/playlist?list=PLRk95HPmOM6PN-G1xyKj9q6ap_dc9Yckm





