require('./bootstrap');
window.Vue = require('vue');
import router from "./router";
import App from "./components/layout/Index.vue"

const app = Vue.createApp(App)
app.use(router)
app.mount('#app')
