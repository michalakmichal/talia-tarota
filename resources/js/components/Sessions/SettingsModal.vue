<template>
  <div id="settings-modal"> 
    <form  @submit.prevent="changeState({id: id, state_id: Number(formData.state_id)})" style="color: white"> 
        <!-- <select :value="stateId" > -->
        <select v-model="formData.state_id">
             <option v-for="(state, id) in states" :value="id" :key="id"> {{ state.title}}  </option> 
        </select>
        <div style="text-align: left; padding: 1vw 0; box-sizing: border-box;">
            <input type="checkbox" value="send-email" name="send-email"/>
            <label for="send-email"> Wyślij uzytkownikowi maila z powiadomieniem </label>
        </div>
        <input type="submit"/>
    </form>
  </div>
</template>
<script>
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');

    export default {
        props:
        {
            id: Number,
            state_id: Number
        },
        data()
        {
            return {
                toggled: false,
                states: {
                    '1' : {
                    'title': 'Oczekiwanie na potwierdzenie', //w bazie danych tez zmienic z name na title
                    'class': 'title-waiting'
                    },
                    '2' : {
                    'title': 'Do rozpoczęcia', //w bazie danych tez zmienic z name na title
                    'class': 'title-accepted'
                    },
                    '3' : {
                    'title': 'W trakcie', //w bazie danych tez zmienic z name na title
                    'class': 'title-started'
                    },
                    '4' : {
                    'title': 'Zakończona', //w bazie danych tez zmienic z name na title
                    'class': 'title-ended'
                    }
                },
                formData:
                {
                    state_id: this.state_id,
                }
            };
        },
        computed:
        {
            /*
            notifications()
            {
                return this.sessionNotifications(this.id);
            }
            */
        },
        methods:
        {
            ...mapActions({
                changeState: 'session/changeState' 
            })
        }
    }
</script>
<style lang="scss" scoped>
#settings-modal
{
    position: absolute;
    width: 25vw;
    background: #2a2a2a;
    z-index: 10;
    padding: 2vw;
    border-radius: 0.5rem;
    bottom: 0;
    right: 0;
    transform: translate(100%, 50%);
    select{
        outline: none;
        border: none;
            padding: 1vw;
            box-sizing: border-box;
            width: 100%;

        option{
        }
    }
}
.dark-mode .session-type
{
    color: white;
}
</style>