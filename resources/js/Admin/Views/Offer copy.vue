<template>
    <div id="offer-view" v-if="offer(id)">
    <router-link :to="{path: `/offer/${id}/wrozba-ogolna`}" class="offer-tab" id="general"> 
            <div class="content">
                <img v-for="image in offer(id).images" :src="image.url" :key="image.id" /> 
            </div>
            <span class="title"> {{ offer(id).name}} </span>
    </router-link>
        <div id="content">
            <div class="price"> Cena: <span> {{ offer(id).price}} </span>  zł </div>    
            <div id="description" contenteditable ref="description" @input="descriptionChanged" v-html> {{ offer(id).description }} </div>
            
            <textarea id="description" ref="description" @input="descriptionChanged">{{offer(id).description}}</textarea>
        </div>
    </div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');


//import {session} as api from '../Repository/index';
export default {
    props:['id','name'],
        components: {
        },
        data()
        {
            return {
            };
        },
        computed: {
             ...mapGetters( {
            offer: 'offer/offer'
        })
        },
        mounted()
        {
            this.$refs['description'].style.height = this.$refs['description'].scrollHeight + "px";
            console.log("OFERTA TOOOO:", this.offer(this.id));
        },
        methods:
        {
            descriptionChanged(event)
            {
                this.$refs.description.style.height = "auto";
                this.$refs.description.style.height = this.$refs.description.scrollHeight + "px";
                
            },
           ...mapActions({addSession: 'session/addSession'})
        }

}
</script>
<style lang="scss" scoped>
#offer-view
{
    padding-top: 2vw;
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
    font-size: 1.2vw;
    
    #offer-form
    {
        margin-top: 1vw;
    }
    .price
    {
        color: black;
        background: white;
        padding: 0.5vw;
        margin-bottom: 1vw;
        display: inline-block;
        
    }
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
    > #content
    {
        flex: 1;
        padding: 1vw;
    }
    textarea{
        display: inline-block;
        width: 100%;
        background: none;
        border: none;
        overflow: auto;
        outline: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        resize: none;
        color: white;

        font-size: 1.2vw;
    }
}
</style>