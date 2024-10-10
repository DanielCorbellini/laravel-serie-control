import axios from 'axios';
window.axios = require(axios);

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
