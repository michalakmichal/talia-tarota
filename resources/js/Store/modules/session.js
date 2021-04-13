import axios from 'axios'
import Vue from 'vue';
export default {
  namespaced: true,

  state: {
    sessions: null,
    sessions_loaded: false
  },
  getters:
  {
    sessions (state) {
      return state.sessions;
    },
    sessions_loaded (state) {
       return state.sessions_loaded;
    },
    session_state: state => id => {
      let index = state.sessions.findIndex(s => s.id == id);
      console.log(state.sessions);
      console.log(state.sessions.find(index));
      return state.sessions.find(index);
    },
  },
  mutations: {
    SET_USER_SESSIONS (state, value) {
      state.sessions = value;
    },
    SET_SESSIONS_LOADED (state, value) {
      state.sessions_loaded = value;
    },
    SET_SESSION_STATE (state, payload) {
      console.log("pay", payload);
      let index = state.sessions.findIndex(s => s.id == payload.id);
      console.log(state.sessions[index]);
      Vue.set(state.sessions[index], 'state_id', payload.state_id);
      //Vue.set(state.sessions, index, {state_id: payload.state_id});
    },
    DELETE_SESSION (state, id)
    {
      let index = state.sessions.findIndex(s => s.id == id);
      state.sessions.splice(index, 1);
    },
    ADD_SESSION(state, session) {
      state.sessions.push(session);
    }
  },
  actions: {
    async getUserSessions({state, dispatch, commit, rootState}) {
        try
        {
         // alert('fetching');
          //console.log('fetching');
          let response = await axios.get(`/api/users/${rootState.common.auth.user.id}/sessions`);
          let data = response.data;
         /* data.sessions = data.sessions.map(session=>{
            session.users.map(user => {
              user.activity_state= false;
              return user;
            });
          return session;}); */
          
          commit('SET_USER_SESSIONS', data.sessions);
          console.log("Przechwycone sesje", data.sessions);
          commit('common/user/SET_USERS', data.unique_users, {root: true});
          //commit('common/user/SET_USER_LIST', data.unique_users, {root: true});
          //let users = await  dispatch('common/user/getUsers', data.unique_users, {root: true});
         // commit('user/SET_USERS', users,  {root: true}); // return this value and call from proper module
          if(!state.sessions_loaded) commit('SET_SESSIONS_LOADED',true);
        }
        catch(err)
        {   
            alert(err);
        }
    },
    async changeState({state, dispatch, commit, rootState}, payload)
    {
        try
        {
          let response = await axios.put(`/api/sessions/${payload.id}`,
          {
            state_id: payload.state_id
          });
          //commit('session/SET_SESSION_STATE', payload, {root: true});
        }
        catch(err)
        {
            alert(err);
        }
    },
    async addSession({commit, rootState}, payload) {
      try
      {
        //DO TAKIEJ ZMIENNEJ DODAĆ GETTER ALBO PRZYPISAĆ I DAĆ KRÓTSZĄ NAZWĘ ZMINNEJ
        let response = await axios.post(`/api/sessions`, {
          data: {...payload, user_id: rootState.common.auth.user.id}
        });
        console.log(response.data);
      }
      catch(err)
      {   
          alert(err);
      }
    },
    async deleteSession({commit}) {
      //commit('SET_USER_SESSIONS', id);
      /*
      try
      {
        let response = await axios.get(`/api/users/${rootState.auth.user.id}/sessions`);
        console.log(response.data);
        commit('SET_USER_SESSIONS', response.data);
      }
      catch(err)
      {   
          alert(err);
      }*/
    }
  }
}