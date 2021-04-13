import axios from 'axios'
// ZREFRAKTORYZOWAĆ TAK, ABY LOGIKA ZOSTAŁA W TYM MIEJSCU I SĄSIEDNICH PLIKACH,
// DODAĆ KOD Z REPOZYTORIUM, API DO BAZY DANYCH Z AXIOS
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
          //DO TAKIEJ ZMIENNEJ DODAĆ GETTER ALBO PRZYPISAĆ I DAĆ KRÓTSZĄ NAZWĘ ZMINNEJ
          let response = await axios.get(`/api/sessions/${id}/messages`);
          let data = response.data.map(msg=>{ 
            msg.user = rootGetters['common/user/user'](msg.user_id) ? rootGetters['common/user/user'](msg.user_id) : rootGetters['common/auth/user'];
            // msg.user = rootGetters['users/user', msg.user_id];
            return msg;});
          console.log("DATA IS:::", data); 
          commit('SET_SESSION_MESSAGES', data);
        }
        catch(err)
        {   
            alert(err);
        }
    },
    async sendMessage({commit}, payload) {
      try
      {
        //DO TAKIEJ ZMIENNEJ DODAĆ GETTER ALBO PRZYPISAĆ I DAĆ KRÓTSZĄ NAZWĘ ZMINNEJ
        let response = await axios.post(`/api/sessions/${payload.session_id}/messages`, {
          data: payload
        });
        console.log("TO ADD::");
        console.log(response.data);
        //commit('ADD_MESSAGE', response.data);
      }
      catch(err)
      {   
          alert(err);
      }
    },
    async deleteMessage({commit}) {
    }
  }
}