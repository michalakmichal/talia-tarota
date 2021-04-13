<template>
<div id="sessions-view">
   <sessions-table /> 
</div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
//import store from '../Store/index.js';
import { mapGetters, mapMutations, mapActions} from 'vuex';
import SessionsTable from '../Components/Sessions/SessionsTable.vue';

export default {
        components: {
            SessionsTable
        },
        data()
        {
            return {

            };
        },
        computed: {
            ...mapGetters(['admin/session/sessions'])
        },
       /* beforeRouteEnter(to, from, next)
        {
            attachAdminStore(next);
        } */
        methods:
        {
          //  ...mapActions({getSessions: 'session/getSessions', log: 'session/log'}),
        },
    
        mounted()
        {
           // console.log("PO::", this.$store);
            //this.$store.dispatch('session/log');
        }

}
</script>
<style lang="scss" scoped>
.sessions-view
{
    display: flex;
    flex-direction: column;
}
</style>