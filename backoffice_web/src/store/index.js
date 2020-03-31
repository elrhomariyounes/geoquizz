import Vue from 'vue'
import Vuex from 'vuex'

import VuexPersistence from 'vuex-persist'

const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [vuexLocal.plugin],
    state: {
        isConnect: false,
        token: '',
        user: '',
        series: '',
        photos: '',
        photo:'',
        difficulty:'',
        urlAxios:''
    },
    mutations: {
        setSession(state, data) {
            state.token = data.token;
            state.user = data.user;
            state.isConnect=true;
        },
        Logout(state) {
          state.isConnect = false;
          state.user = [];
          state.token = "";
        },
        setSeries(state, series) {
            state.series = series
        },
        setPhotos(state, photos) {
            state.photos = photos
        },
        setPhoto(state, photo) {
            state.photo = photo
        },
        setDifficulty(state, diff) {
            state.difficulty = diff
        }
    },
    actions: {},
    modules: {}
})