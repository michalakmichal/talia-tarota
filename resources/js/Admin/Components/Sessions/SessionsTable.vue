<template>
<div id="sessions-table-wrapper">
    <div @click="show">  Zamówienia </div>
    <div class="table"  v-if="sessions"> 
        <div class="row"> 
            <div class="col"> <span> Id </span> </div>
            <div class="col"> <span> Rodzaj </span> </div>
            <div class="col"> Status </div>
            <div class="col"> Data </div>
            <div class="col">  </div>
        </div>
        <session v-for="session in sessions" :key="session.id"
         v-bind="session" 
         :state="sessionState(session.id)"
         :type="sessionType(session.id)"/> 
    </div>
</div>
</template>
<script>
//import { mapGetters, mapActions } from 'vuex';
import { attachAdminStore } from '../../Mixins/common.js';
import { mapGetters, mapActions} from 'vuex';
import Session from './Session.vue';

export default {
    //mixins: [ attachAdminStore ],
    components:
    {
        Session
    },
    computed: {
        ...mapGetters({sessions: 'admin/session/sessions', 
        sessionState:'admin/session/sessionState',
        sessionType: 'admin/session/sessionType'})
    },
    methods:
    {
        ...mapActions({getSessions: 'admin/session/getSessions'}),
        show()
        {
            console.log("SESJE:", this.sessions);
        }
    },
    async mounted()
    {
        console.log("z tabeli", this.$store);
        await this.getSessions();
        console.log("sesje po :::: ", this.sessions);

    }
}
</script>
<style lang="scss">
.table
{
    display: flex;
    flex-direction: column;
    word-break: break-word;
    margin-top: 1vw;
    font-size: 1vw; 
    .row
    {
        display: flex;
        flex-direction: row;
        border-radius: 0.4em;
        //border-bottom: 0.2vw solid rgb(255,255,255,0.1);
        .col:nth-of-type(1)
        {
            flex: 1;
            justify-content: center;
           // border-right: 0.2vw solid rgb(255,255,255,0.1);
        }
        .col:nth-of-type(2)
        {
            flex: 3;

        }
        .col:nth-of-type(3)
        {
            flex: 3;
        }
         .col:nth-of-type(4)
        {
            flex: 2;
        }
        .col:nth-of-type(5)
        {
            flex: 2;
        }
    }
    .row:first-of-type
    {
        background: rgb(255,255,255,0.1);
        font-weight: bold;
    }
}
</style>