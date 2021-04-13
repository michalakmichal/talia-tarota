import axios from 'axios'

export default {
  namespaced: true,
  actions:
  {
    async patchOffer({commit, rootState}, payload) {
        try
        {
          let response = await axios.patch(`/api/offers/${payload.id}`, {
            data: {...payload}
          });
          console.log("Ofert update: ", response.data);
        }
        catch(err)
        {   
            alert(err);
        }
    }
  }
}
