<template>
    <form id="offer-view" v-if="offer(id)" @submit.prevent="save">
    <router-link :to="{path: `/offer/${id}/wrozba-ogolna`}" class="offer-tab" id="general"> 
            <div class="content">
                <img v-for="image in offer(id).images" :src="image.url" :key="image.id" /> 
            </div>
            <span class="title" v-model="formData.name"> {{ offer(id).name}} </span>
    </router-link>
        <div id="content">
            <div class="price"> Cena: <span contenteditable> {{ offer(id).price}} </span>  zł </div>    
            <div id="edit-menu">
                <button @click="add"> Nagłówek </button> 
                <button> HTML </button> 
                <button type="submit"> Zapisz </button> 
            </div>
            <div id="description" contenteditable ref="description" @focusout="descriptionChanged" v-html="description">   </div>
           
        </div>
    </form>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
import { mapActions, mapGetters, mapMutations } from 'vuex';

//import {session} as api from '../Repository/index';
//Pozbyć się tego okropnego offer(id)....... <--- getter/computed idk do 'offer' a temu zmienić nazwę na '_offer(id)'
export default {
    props:['id','name'],
        components: {
        },
        data()
        {
            return {
                description: 'null',
                // formData is used to determine, which data should be updated
                // Initially its plain object
                formData:
                {
                    name: String,
                    description: String,
                    price: Number
                }
                
            };
        },
        computed: {
             ...mapGetters( {
            offer: 'common/offer/offer',
            offersLoaded: 'common/offer/offersLoaded',
        })
        },
        methods: 
        {
            ...mapActions( {
            getOffer: 'common/offer/getOffer',
            patchOffer: 'admin/offer/patchOffer'
            }),
            add()
            {
                this.description += '<h1> Nagłówek </h1>';
            },
            descriptionChanged(event)
            {
                this.description = event.target.innerHTML;
                // at typical case (when value is intended to be watched since component mounted)
                // it should be stored as computed property / watcher and pointing to value
                this.formData.description = this.description;
            },
            save()
            {
                this.patchOffer({...this.formData, id: this.id});
            }
        },
       async mounted()
        {
            //Jeśli nie istnieje w storze: pobierz z serwera <--- moze wykorzystam mechanizm getterów i setterów,
            // będę to robił b. duzo razy, wiec trzeba to jakos zuniwersalizować
            console.log(this.$store);
            if(!this.offersLoaded)
            {
                alert('pobieram z serwera');
                await this.getOffer(this.id);
            }
            this.description = this.offer(this.id).description;
            console.log("OFERTA TOOOO:", this.offer(this.id));
        }

}
</script>
<style lang="scss" scoped>
#offer-view
{
    padding-top: 2vw;
    display: flex;
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
        margin-right: 5%;
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
    #description
    {
        word-break: break-word;
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
    #edit-menu
    {
        margin-bottom: 1vw;
    }
}
</style>