import { createApp } from 'vue';
import App from './App.vue';
import HomeApp from './HomeApp.vue';
import router from './router';
import axios from 'axios';
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'

import "@mdi/font/css/materialdesignicons.min.css"

const app = createApp(App).use(Oruga).use(router);

app.mount('#app');

app.config.globalProperties.$axios = axios;
window.axios = axios;

const home = createApp(HomeApp).use(Oruga).use(router);

home.mount('#home');

home.config.globalProperties.$axios = axios;
window.axios = axios;