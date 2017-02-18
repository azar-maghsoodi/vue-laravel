import Vue from 'vue'
import {
  getHeader,
  getUserPrivateMessages
} from './../../config'

const state = {
  notifications: [],
  messagesRec: [],
  messagesSent: [],
  message: {
    subject: '',
    message: '',
    sender: ''
  }
}

const mutations = {
  SET_MESSAGES_REC (state, messages) {
    state.messagesRec = messages
  }
}
const actions = {
  setUserMessagesRec: ({commit}) => {
    let postData = {}
    // const authUser = JSON.parse(window.localStorage.getItem('authUser'))
    return Vue.http.post(getUserPrivateMessages, postData, {headers: getHeader()})
      .then(response => {
       // Vue.$logger('info', 'setUserMessageRec response', response)
        commit('SET_MESSAGES_REC', response.body.data)
      })
  }
}
export default {
  state, mutations, actions
}
