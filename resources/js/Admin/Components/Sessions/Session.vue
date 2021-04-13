<template>
   <div class="row"> 
        <div class="col"> <span class="id-wrapper"> {{ id ? id : "" }} </span> </div>
        <div class="col"> <!-- <img src="/img/zodiac_aries.svg" /> -->
        <img src="/img/zodiac_aries.svg" /> 
            {{ type ? type : "" }} 
         </div>
            <div class="col"> {{ state ? state.name : "" }} </div>
            <div class="col"> {{ created_at }} </div>
            <div class="col"> 
                <router-link :to="{name: 'session', params: {id} }" class="session_item">
                    <i class="fas fa-eye"></i>
                </router-link>
                <i class="fas fa-user"></i>
                <i class="fas fa-trash"></i>
            </div>
    </div>
</template>
<script>
//import { mapGetters, mapActions } from 'vuex';
import { attachAdminStore } from '../../Mixins/common.js';
import { mapGetters, mapActions} from 'vuex';

export default {
    //mixins: [ attachAdminStore ],
    props:
    {
        id: Number,
        state_id: Number,
        updated_at: String,
        created_at: String,
        state: 
        {
            type: Object,
            default: () =>
            {
                name: "..."
            }
        },
        type: String
    },
    computed: {
    },
    methods:
    {
    },
    mounted()
    {
        
        //console.log("z tabeli", this.$store);
        //await this.getSessions();
        //console.log("sesje po :::: ", this.sessions);
    }
}
</script>
<style lang="scss">
.table
{
    display: flex;
    flex-direction: column;
    word-break: break-word;
    .row
    {
        display: flex;
        flex-direction: row;
        img{
            width: 4vw;
            padding-right: 1vw;
        }
        a
        {
            text-decoration: none;
            color: inherit;
        }
        .col
        {
            display: flex;
            align-items: center;
            padding: 1vw;
            cursor: pointer;
            .id-wrapper
            {
                background: rgba(255,255,255,0.1);
                border-radius: 50%;
                border: 0.1vw solid white;
                width: 2vw;
                height: 2vw;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .fas
            {
                 transition: color 0.5s ease-in-out;
            }
            .fas:hover 
            {
                color: #136CB9;
            }
            .fa-trash:hover
            {
                color: indianred;
            }
            //border: 0.1vw rgb(255,255,255,0.1) solid;
        }
         .col:nth-of-type(4)
        {
            flex: 4;
            justify-content: center;
        }
         .col:nth-of-type(5)
        {
            justify-content: space-around;
            font-size: 1.3vw;
            background: rgba(0,0,0,0.1);
        }

    }
    .row:nth-of-type(2n)
    {
        background: rgba(0,0,0,0.3);
    }
    .row:first-of-type
    {
         .col:nth-of-type(5)
        {
            background: initial;
        }
    }
}
</style>