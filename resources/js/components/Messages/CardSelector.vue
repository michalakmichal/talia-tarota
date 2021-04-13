<template>
    <div class="card-selector"> 
    <Card v-for= "card in cards" 
          :key= "card.id" 
          v-bind= "card" 
          @click.native= "toggleCard(card.id)"
          :class=" selectedCardList.find( i => i==card.id ) ? 'selected' : ' '  "/>
    </div>
</template>
<script>
import Card from '../../components/Card.vue';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters } = createNamespacedHelpers('common');


    export default {
        props:
        {
            id: Number,
            selectedCardList: Array
        },
        components:
        {
            Card
        },
        computed:
        {
            ...mapGetters( {
            cards: 'card/cards'
            })
        },
        methods:
        {
            ...mapActions({
            getCards: 'card/getCards'
            }),
            toggleCard(id)
            {
                let updatedList;
                if(this.selectedCardList.find(i=> i==id)) updatedList = this.selectedCardList.filter(i=> i!=id);
                else {
                    updatedList = this.selectedCardList.filter(i=> i!=id);
                    updatedList.push(id);
                }
                this.$emit('update:selectedCardList', updatedList);
                //this.$emit('cardSelected', this._selectedCardList);
            }
        },
        mounted() {
            this.getCards();
        }
    }
</script>
<style lang="scss" scoped>
.card-selector{
width: 100%;
height: 90%;
position: absolute;
bottom: 10%;
background: #333131;
overflow: scroll;
display: flex;
flex-flow: row wrap;
//align-items: flex-start;
.selected {
    border: 0.2vw solid green;
}
}
</style>