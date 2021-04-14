<template>
    <div id="card-view">
    <router-link :to="{path: '/offer/1/wrozba-ogolna'}" class="offer-tab" id="general"> 
            <div class="content">
                <img src="/img/card_1.svg"/> 
            </div>
    </router-link>
    <div v-html="description"> </div>
    </div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
import { createNamespacedHelpers } from 'vuex';
const {mapGetters, mapMutations, mapActions} = createNamespacedHelpers('common');

//import {session} as api from '../Repository/index';
export default {
    props:['id','name'],
        components: {
        },
        data()
        {
            return {
                description: String
            };
        },
        computed: {
        },
        methods:
        {
            ...mapActions(['session/addSession']),
            /*addSession()
            {
                this.$store.dispatch('session/addSession', );
            }*/
            async getCard()
            {
                try
                {
                    let response = await axios.get(`/api/cards/${this.id}`);
                    this.description = response.data.description;
                }catch(err)
                {
                    alert(err);
                }
            }
        },
        mounted()
        {
            this.getCard();
        }


}
</script>
<style lang="scss" scoped>
#card-view
{
    padding-top: 2vw;
    font-size: 1.2vw;
    #offer-form
    {
        margin-top: 1vw;
    }
    .offer-tab
    {

        background: #808080;
        margin: 1%;
        margin-right: 2vw;
        width: 23%;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 1vw;
        color: white;
        text-decoration: none;
        float: left;
        
        .content{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 15vw;
        position: relative;
        }
        img
        {
            width: 50%;
            max-height: 100%;
        }
    }

    > #content
    {
        flex: 1;
        padding: 1vw;
    }
    h2:first-of-type{
        margin-top: 0;
    }
}
</style>