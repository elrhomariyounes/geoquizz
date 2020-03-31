import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Vuetify from 'vuetify'
import axios from 'axios'
import * as VueGoogleMaps from 'vue2-google-maps'
 
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyC2qb5Af1j9q7pa6CeB15pXNT7itwf6h0o',
    libraries: 'places',
  },
 
 
});
Vue.use(Vuetify)

axios.defaults.baseURL='http://api.backoffice.local:19080/'


Vue.config.productionTip = false

new Vue({
    router,
    store,
    render: h => h(App),
    beforeCreate() {
      
    
        
    }
}).$mount('#app')