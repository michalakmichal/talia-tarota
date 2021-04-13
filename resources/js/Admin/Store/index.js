import Vue from 'vue'
import Vuex from 'vuex'

import session from './modules/session'
import offer from './modules/offer'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    session,
    offer
  }
})