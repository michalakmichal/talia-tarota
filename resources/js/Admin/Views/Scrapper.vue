<template>
<div id="sessions-view">
    <form @submit.prevent="getCardDescription(selectedPrefix, selectedSuffix)">
        <select v-model="selectedPrefix"> 
            <option v-for="p in prefix" :key="p" :value="p"> {{ p }} </option>
        </select>
        <select  v-model="selectedSuffix"> 
            <option v-for="s in suffix" :key="s" :value="s"> {{ s }} </option>
        </select>
    <input type="submit" value="znajdź"/>
    </form>
    <div v-html="data"> </div>
</div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
//import store from '../Store/index.js';
import { mapGetters, mapMutations, mapActions} from 'vuex';
import SessionsTable from '../Components/Sessions/SessionsTable.vue';
import OfferList from '../../components/OfferList.vue';

export default {
        components: {
            SessionsTable,
            OfferList
        },
        data()
        {
            return {
                data: null,
                parser: new DOMParser(),
                removable: ['button', '.tagi', '.breadcrumbs', 'hr', '.extra-hatom-entry-title', 'img[usemap="#zamow-png"]', 'img', 'map', '.topik', 'a'],
                prefix: ['as','dwojka','trojka','czworka','piatka','szostka','siodemka','osemka','dziewiatka', 'dziesiatka', 'paz', 'rycerz', 'krolowa', 'krol'],
                suffix: ['bulaw', 'monet', 'kielichow', 'mieczy'],
                selectedPrefix: null,
                selectedSuffix: null
            };
        },
        computed: {
            ...mapGetters(['admin/session/sessions'])
        },

        methods:
        {
            async getCardDescription(prefix, suffix)
            {
               const url = `https://api.allorigins.win/get?url=${encodeURIComponent(`https://blog.otylia.pl/${prefix}-${suffix}/`)}`;
                try
                {
                    let response = await axios.get(url,
                    {
                        mode: 'no-cors',
                        headers:
                        {
                            'Access-Control-Allow-Origin': '*'
                        },
                    });
                    const text = response.data.contents;
                    const dom = await this.parser.parseFromString(text, 'text/html').body.querySelector('article .topik-space');
                    this.removable.map( item => {
                        dom.querySelectorAll(item).forEach(node => node.remove());
                    } );
                   /* dom.querySelectorAll('*').forEach(node => {
                    for (var i = node.attributes.length - 1; i >= 0; i--){
                        console.log(node.attributes[i].name);
                    node.removeAttribute(node.attributes[i].name);
                    } }); */
                    this.data = dom.innerHTML;
                    console.log("DOM", this.dom);
                    return dom.innerHTML;
                }
                catch(err)
                {
                    alert(err);
                }
            },
            async sendToDatabase(id, data)
            {
                try{
                    let response = axios.patch(`/api/cards/${id}`,
                    {
                        data: {
                            description: data
                        }
                    })
                    {
                        console.log('Card has been successfully updated.')
                    }
                }catch(err)
                {
                    alert('An error has occured during sending data', err);
                }
            }
        },
    
        async mounted()
        {
            /* ZADZIAŁA, GDY ODKOMENTUJE ///////// */
            //this.getCardDescription();
            ////////let n = 43;
            //this.suffix.forEach(s =>
            //{
               //////// for(const p of this.prefix)
               /////// {
               ///////     let data = await this.getCardDescription(p, 'mieczy');
               ///////     console.log(n, data);
               ///////     await this.sendToDatabase(n, data);
               ///////     n++;
              ///////  }
            //});
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