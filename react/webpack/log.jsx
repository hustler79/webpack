export default ((() => {
    try {
        return console.log;
    }
    catch(e) {
        return () => {}
    }
})());