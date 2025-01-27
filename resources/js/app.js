import './bootstrap';
import axios from 'axios';

window.axios = require('axios');

// Set CSRF Token globally in Axios headers
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found!');
}