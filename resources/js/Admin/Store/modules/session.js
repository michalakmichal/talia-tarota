import axios from 'axios'
import Vue from 'vue';

export default {
  namespaced: true,

  state: {
    sessions: null,
    states: null,
    types: null,
  },
  getters:
  {
    sessions (state) {
      return state.sessions;
    },
    // Get session state by session_id
    sessionState: state => id => {
      let index = state.sessions.find(s => s.id == id).state_id;
      return state.states.find(s=> s.id == index);
    // Nie zwracacać tutaj stanu sesji, pobrać z modułu OFFERS (zrobić...)
      //return states.ADD_SESSIONsession.offer_id];
    },
    sessionType: state => id => {
      let index = state.sessions.find(s => s.id == id).state_id;
      return state.types.find(s=> s.id == index).name; // nie brać types stąd tylko z common/offers/types chyba
    },
  },
  mutations: {
    SET_SESSIONS (state, value) {
      state.sessions = value;
    },
    /*SET_STATE_LIST(state, value)
    {
      state.stateList = value;
    },*/
   /* GET_SESSION_STATE()
    {
        SET_SESSION_STATE (state, payload) {
        console.log("pay", payload);
        let index = state.sessions.findIndex(s => s.id == payload.id);
        console.log(state.sessions[index]);
        Vue.set(state.sessions[index], 'state_id', payload.state_id);
        //Vue.set(state.sessions, index, {state_id: payload.state_id});
      }, 
    }, */
    SET_SESSIONS_LOADED (state, value) {
      state.sessions_loaded = value;
    },
    SET_SESSION_STATES(state, value)
    {
      state.states = value;
    },
    SET_SESSION_TYPES(state, value)
    {
      state.types = value;
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
      console.log("DOWANIE NOWEJ SESJI DO GLOBALNEJ TABLICY", session);
      console.log("JAKAS INNA SESJA",  state.sessions[0]);
      state.sessions.push(session);
    }
  },
  actions: {
    log()
    {
      alert("LOG");
    },
    async getSessions({state, dispatch, commit, rootState}) {
        try
        {
         // alert('fetching');
          //console.log('fetching');
          let response = await axios.get(`/api/sessions`);
          let data = response.data;
          commit('SET_SESSIONS', data.sessions);
          //check if not already set 
          //commit('SET_SESSION_TYPES', data.types);
          commit('SET_SESSION_STATES', data.states);
          commit('SET_SESSION_TYPES', data.types);
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
         // commit('session/SET_SESSION_STATE', payload, {root: true});
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
          data: {...payload, user_id: rootState.auth.user.id}
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