import './bootstrap';

import { createApp } from 'vue';

import * as bootstrap from 'bootstrap';

import './src/style/scss/global.scss'

import app from './src/pages/app.vue'

window.bootstrap = bootstrap;

const App = createApp(app)
App.mount("#app")
