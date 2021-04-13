import axios from 'axios'

export default {
  namespaced: true,

  state: {
    users: [],
    userList: null //nazywać zmienne w cammelCase na frotnendzie
  },
  getters:
  {
    user: state => id => {
      let index = state.users.findIndex(s => s.id == id);
      return state.users[index];
    },
    users: state => {
      return state.users;
    },
    usersByList: state => list => {
    let sorted = state.users.filter(user=>{
        return list.findIndex(list => list.id==user.id );
      });
      console.log("SORTED: ", sorted);
      return sorted;
    },
    userList (state) {
      return state.userList;
    }
  },
  mutations: {
    SET_USERS (state, value) {
      state.users = value;
    },
    SET_USER_LIST (state, value) {
      state.userList = value;
    },
    DELETE_USER(state, id){
      //let index = state.users.findIndex(s => s.id == id);
      //state.users.splice(index, 1);
    },
    SET_ACTIVE_USERS(state, list)
    {
      state.usersByList(list).map(user => {
        user['activity_state'] = true;
        return user;
      });
    }
  },
  actions:
  {
    /*
      Get users from list of their ids
    */
      async getUsers({state, commit, rootState}) {
        try
        {
          //alert("users");
          let response = await axios.get(`/api/users/sessions`, {
            params:
            {
              list: state.userList
            }
          });
          let data = response.data.map(user => { 
            user['activity_state'] = true; 
            return user; });
          console.log("uzytkownicy:", data);
          commit('SET_USERS', data);
          console.log("uzytkownicy 2:", state.users);
          /*let data = response.data;
          data.sessions = data.sessions.map(session=>{
            session.users.map(user => {
              user.activity_state= false;
              return user;
            });
          return session;});
          commit('SET_USER_SESSIONS', data.sessions);
          console.log("Przechwycone sesje", data.sessions);
          commit('user/SET_USERS', data.unique_users, {root: true});
          if(!state.sessions_loaded) commit('SET_SESSIONS_LOADED',true);*/
        }
        catch(err)
        {   
            alert(err);
        }
    }
  }
}
