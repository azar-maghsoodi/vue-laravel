import Vue from 'vue'
import Vuex from 'vuex'

import userStore from './components/user/userStore'
import privateMessageStore from './components/private-message/privateMessageStore'

Vue.use(Vuex)
const debug = process.env.MODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    userStore, privateMessageStore
  },
  strict: debug
})
