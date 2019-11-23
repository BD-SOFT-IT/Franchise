import createClientApp from '../rbt-ems-client-d';
import renderVueComponentToString from 'vue-server-renderer/basic';

const app = createClientApp;

renderVueComponentToString(app, (err, html) => {
    console.log(html);
    if (err) {
        throw new Error(err);
    }
    dispatch(html);
});