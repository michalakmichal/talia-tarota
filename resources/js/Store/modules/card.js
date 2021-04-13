import axios from 'axios'

export default {
  namespaced: true,

  state: {
    cards: [],
    cardList: null
  },
  getters:
  {
    card: state => id => {
      let index = state.cards.findIndex(n => n.id == id);
      return state.cards[index];
    },
    cards: state => {
      return state.cards;
    },
    cardsByList: state => list => {
    let sorted = state.cards.filter( card=> {
        return list.findIndex(list => list.id==card.id );
      });
      return sorted;
    },
    cardList (state) {
      return state.cardList;
    }
  },
  mutations: {
    SET_CARDS (state, value) {
      state.cards = value;
    },
    SET_CARDS_LIST (state, value) {
      state.cardList = value;
    },
    DELETE_CARD(state, id){
      //let index = state.notifications.findIndex(s => s.id == id);
      //state.notifications.splice(index, 1);
    },
   /* SET_ACTIVE_NOTIFICATIONS(state, list)
    {
      state.notificationsByList(list).map(notification => {
        notification['activity_state'] = true;
        return notification;
      });
    },
    ADD_NOTIFICATION (state, notification) {
      state.notifications.push(notification);
      console.log(state.notifications);
    } */
  },
  actions:
  {
    async getCards({state, dispatch, commit, rootState}) {
      try
      {
        let response = await axios.get('/api/cards');
        let cards = response.data;
       /* data.sessions = data.sessions.map(session=>{
          session.users.map(user => {
            user.activity_state= false;
            return user;
          });
        return session;}); */
        
        commit('SET_CARDS', cards);
        //if(!state.sessions_loaded) commit('SET_SESSIONS_LOADED',true);
      }
      catch(err)
      {   
          alert(err);
      }
    }
  }
}
