<template>
    <div id="offer-view" v-if="cards">
        <router-link v-for="card in cards" :key="card.id"
                    :to="{path: `/card/${card.id}`}" class="offer-tab" id="general"> 
            <div class="content">
                <img src="/img/card_1.svg"/> 
            </div>
             <span class="title"> {{ card.name }} </span>
        </router-link>
    </div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
import Testimonial from '../components/Testimonials/Testimonial.vue';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');

//import {session} as api from '../Repository/index';
export default {
        components: {
            Testimonial
        },
        computed:
        {
            ...mapGetters( {
            cards: 'card/cards',
            })
        },
        methods: {
            ...mapActions({
            getCards: 'card/getCards'
            }),
        },
        mounted()
        {
            this.getCards();
            let tl = gsap.timeline();
            this.$nextTick( () => {
            tl.fromTo('.offer-tab', {scale: 0, opacity: 0},{
                    duration: 1,
                    //repeat: -1,
                    scale: 1,
                    opacity: 1,
                    stagger: 0.3 // 0.1 seconds between when each ".box" element starts animating
            }); } );
        }

}
</script>
<style lang="scss" scoped>
#offer-view
{
    padding-top: 2vw;
    display: flex;
    flex-flow: row wrap;

    .offer-tab
    {

        background: #808080;
        margin: 1%;
        width: 23%;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-top: 1vw;
        color: white;
        text-decoration: none;
        
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
            max-width: 50%;
            max-height: 100%;
        }
        .title
        {
            font-size: 1.8vw;
            padding: 1vw;
        }
        #aries{
            max-width: 80%;
        }
        #pendulum{
            position: absolute;
            width: 15%;
            left: 0;
            bottom: 0;
            display: none;
        }
    }
   /* .offer-tab:nth-child(1)
    {
        img
        {
            transform: rotate(-10deg);
        }
        img:nth-of-type(2n)
        {
            transform: rotate(10deg);
        }
    }*/
}
</style>