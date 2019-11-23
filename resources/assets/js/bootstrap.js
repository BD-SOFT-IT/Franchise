import root from 'window-or-global';

root._ = require('lodash');
root.Popper = require('popper.js').default;

root.axios = require('axios');
root.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('./prototypes');
require('./helpers');

if(typeof window !== 'undefined') {
    root.$ = root.jQuery = require('jquery');
    require('bootstrap');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
