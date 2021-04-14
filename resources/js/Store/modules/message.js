import axios from 'axios'

export default {
  namespaced: true,

  state: {
    messages: null
  },
  getters:
  {
    messages (state) {
      return state.messages;
    },
  },
  mutations: {
    SET_SESSION_MESSAGES (state, value) {
      state.messages = value;
    },
    SET_MESSAGE(state, message)
    {
      //if(!state.sessions.find(session)) state.sessions.push(session);
      state.messages.push(message);
    },
  /*  SET_MESSAGE_USER(state, user)
    {
        state.message.user = user;
    }, */
    DELETE_MESSAGE (state, id)
    {
      let index = state.messages.findIndex(s => s.id == id);
      state.sessions.splice(index, 1);
    }
  },
  actions: {
    addMessage({commit, rootGetters}, message)
    {
      message.user = rootGetters['common/user/user'](message.user_id);
      console.log('message to:', message);
      commit('SET_MESSAGE', message);
    },
    async getSessionMessages({commit, rootGetters}, id) {
        try
        {
          let response = await axios.get(`/api/sessions/${id}/messages`);
          let data = response.data.map(msg=>{ 
            msg.user = rootGetters['common/user/user'](msg.user_id) ? rootGetters['common/user/user'](msg.user_id) : rootGetters['common/auth/user'];
            return msg;});
          commit('SET_SESSION_MESSAGES', data);
        }
        catch(err)
        {   
          console.log(err);
        }
    },
    async sendMessage({commit}, payload) {
      try
      {
        let response = await axios.post(`/api/sessions/${payload.session_id}/messages`, {
          data: payload
        });
        //commit('ADD_MESSAGE', response.data);
      }
      catch(err)
      {   
          alert(err.message);
      }
    },
    async deleteMessage({commit}) {
    }
  }
}