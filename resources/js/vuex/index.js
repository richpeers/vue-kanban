import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import boards from '../app/boards/vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        boards: boards
    }
})
