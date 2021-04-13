import axios from 'axios'

export default {
  namespaced: true,

  state: {
    authenticated: false,
    user: null,
    error: null
  },

  getters: {
    authenticated (state) {
      return state.authenticated
    },

    user (state) {
      return state.user
    },
    error (state) {
      return state.error
    },

  },

  mutations: {
    SET_AUTHENTICATED (state, value) {
      state.authenticated = value
    },

    SET_USER (state, value) {
      state.user = value
    },
    SET_ERROR (state, value) {
      state.error = value
    }
  },

  actions: {
    async signIn({commit, dispatch,state}, credentials)
    {
        commit('SET_ERROR', null);
        try
        {
          let response = await axios.get('/sanctum/csrf-cookie');
          console.log(response);
          try
          {
            let res = await axios.post('/login', credentials);
            return dispatch('auth');
          }
          catch(er)
          {
              Object.keys(er.response.data.errors).map((value) => {
                let msg =  er.response.data.errors[value][0];
                console.log(msg);
                commit('SET_ERROR', msg);
            });
          }
        }
        catch(err)
        {
          alert(err);
        }
    },
    async signOut({dispatch})
    {
      try{
          let response = await axios.post('/logout');
          return dispatch('auth');
      }
      catch(er){
        console.log(er);
      }
    },
    async auth ({ commit }) {
      try
      {
        let response =  await axios.get('/api/user');
        console.log(response);
        commit('SET_AUTHENTICATED', true)
        commit('SET_USER', response.data)

      }
      catch(er){
        commit('SET_AUTHENTICATED', false)
        commit('SET_USER', null)
        console.log(er);
      }
    }
    /*
    async getSessions() {
        try
        {
            let response = await axios.get(`/api/users/${this.user_id}/sessions`);
            console.log(response.data);
            this.sessions = response.data;
        }
        catch(err)
        {   
            alert(err);
        }
    }*/
  }
}