import axios from 'axios'

export default {
  namespaced: true,

  state: {
    offers: [],
    offerList: null,
    offersLoaded: false
  },
  getters:
  {
    offer: state => id => {
      console.log("OFRTY ZE STORE:", state.offers);
      let index = state.offers.findIndex(n => n.id == id);
      console.log("TA OFERTA TO:", state.offers[index]);
      return state.offers[index];
    },
    offers: state => {
      return state.offers;
    },
    offerList (state) {
      return state.cardList;
    },
    offersLoaded (state) {
      return state.offersLoaded;
    }
  },
  mutations: {
    SET_OFFERS (state, value) {
      state.offers = value;
    },
    SET_OFFER(state, offer)
    {
      state.offers.push(offer);
    },
    SET_OFFERS_LIST (state, value) {
      state.offerList = value;
    },
    SET_OFFERS_LOADED (state) //usunac z SESSION_LOADED_TRUE drugi parametr
    {
      state.offersLoaded = true;
    },
    DELETE_OFFER(state, id){
      //let index = state.notifications.findIndex(s => s.id == id);
      //state.notifications.splice(index, 1);
    }
  },
  actions:
  {
    async getOffers({state, dispatch, commit, rootState}) {
      try
      {
        let response = await axios.get('/api/offers');
        let offers = response.data;
        //alert(offers);
        commit('SET_OFFERS', offers);
        commit('SET_OFFERS_LOADED');
      }
      catch(err)
      {   
          alert(err);
      }
    },
    async getOffer({commit}, id) {
      try
      {
        let response = await axios.get(`/api/offers/${id}`);
        let offer = response.data;
        commit('SET_OFFER', offer);
      }
      catch(err)
      {   
          alert(err);
      }
    },
  }
}
