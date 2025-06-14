import './bootstrap';
import {createApp} from "vue";
import App from './App.vue'
import {createPinia} from "pinia";
import router from './router';
import {editStateClass} from '@/helpers/helpers.js'
const pinia = createPinia();

const app = createApp(App);

// Регистрация глобальной функции
app.config.globalProperties.$editStateClass = editStateClass


app.use(pinia)
    .use(router)
    .mount('#app')


