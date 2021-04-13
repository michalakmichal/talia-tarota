<template>
    <div id="offer-view">
    <template v-if="offersLoaded">
        <router-link  v-for="offer in offers" :key="offer.id"
        :to="{name: admin ? 'admin-offer' : 'offer', 
        params: {id: offer.id, name: 'wrozba-ogolna'}}" class="offer-tab" id="general"> 
            <Offer v-bind="offer" />
        </router-link>
    </template>
        <div v-else style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
            <img src="/img/loading.gif" style="width: 50%"/>
        </div>
    </div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
import Testimonial from '../components/Testimonials/Testimonial.vue';
import Offer from '../components/Offer.vue';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common/offer');

//import {session} as api from '../Repository/index';
export default {
        components: {
            Testimonial,
            Offer
        },
        props: ['admin'],
        data()
        {
            return {
            };
        },
        computed: {
             ...mapGetters([
            'offers',
            'offersLoaded',
            ])
        },
        methods:
        {
             ...mapActions({
            getOffers: 'getOffers', //zbędnie pisać 2x 'getOffers' -> jak taka sama nazwa
            }),
        },
         mounted()
        {
            if(!this.offersLoaded) //dla kazdego tak zrobic :')
            {
                // await new Promise(resolve => setTimeout(resolve, 10000));
                this.getOffers();
                let tl = gsap.timeline();
                tl.fromTo('.offer-tab img', {scale: 0, opacity: 0},{
                        duration: 1,
                        //repeat: -1,
                        scale: 1,
                        opacity: 1,
                        stagger: 0.5 // 0.1 seconds between when each ".box" element starts animating
                });
            }
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
            width: 50%;
            max-height: 100%;
        }
        .title
        {
            font-size: 1.8vw;
            padding: 1vw;
        }
        #aries{
            width: 80%;
        }
        #pendulum{
            position: absolute;
            width: 15%;
            left: 0;
            bottom: 0;
            display: none;
        }
    }
    .offer-tab:nth-child(1)
    {
        img
        {
            transform: rotate(-10deg);
        }
        img:nth-of-type(2n)
        {
            transform: rotate(10deg);
        }
    }
}
</style>
