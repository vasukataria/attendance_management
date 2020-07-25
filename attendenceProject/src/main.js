import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueToast from 'vue-toast-notification';
import VueAxios from 'vue-axios'



import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import axios from'./backend/axios'

Vue.config.productionTip = false
Vue.use(VueToast, {
  // One of options
  position: 'top-right',
  duration: 5000,
  height: 100
})
Vue.use(VueAxios, axios)
Vue.use(VueMaterial)
new Vue({
  router,
  axios,
  store,
  render: h => h(App)
}).$mount('#app')
