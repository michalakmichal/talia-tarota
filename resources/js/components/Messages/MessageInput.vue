<template>
    <form id="message-input" @submit.prevent="sendMessage"> 
        <input  id="input-message" 
                name="content" 
                v-model="formData.content" 
                placeholder="Wiadomość..." 
                @keydown="$emit('typing')"/>
        <select v-model="type_id">
            <option value="1" > Wiadomość </option> 
                <option value="2"> Informacja </option> 
                    <option value="3"> Błąd </option> 
                        <option value="4"> Karta </option> 
        </select>
        <button v-if="type_id==4" id="card-selector-btn"> Wybór kart </button>
        <button id="send-button">
            <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" height="100%">
        </button>
        <!-- Keep components local state, event if it's not rendered -->
        <keep-alive>
        <!-- <card-selector v-if="type_id==4" @cardSelected="onCardSelected" :selectedCardList="formData.selectedCardList"/> --> <!-- @cardSelected="onCardSelected"/>  -->
        <card-selector v-if="type_id==4" :selectedCardList.sync="formData.selectedCardList" />
        </keep-alive>
    </form>
</template>
<script>
    export default {
        components:
        {
            CardSelector: () => import('./CardSelector.vue')
        },
        data()
        {
            return { 
                formData:
                {
                    content: '',
                    selectedCardList: []
                },
                type_id: 1
            }
        },
        methods:
        {
            sendMessage()
            {
                this.$emit('sendMessage', { formData: this.formData, type_id: this.type_id});
                this.formData ={
                    content: '',
                    selectedCardList: []
                };
                this.type_id = 1;
            }
        }

    }
</script>
<style lang="scss" scoped>
#message-input
    {
        width: 100%;
        background: #323232;//aliceblue;
        height: 10%;
        margin-top: 1%;
        border-radius: 1.5rem;
        //padding: 1% 5%;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        overflow: hidden;
        #input-message
        {
            flex: 1;
            border: none !important;
            outline:0px;
            background: none;
            height: 100%;
            padding: 0 5%;
        }
         #input-message, select{
            transition-duration: 1s;
            transition-property: background color;
         }
        select
        {
            border-right: 1vw solid transparent !important;
            height: 100%; border: none; 
            background: rgba(0,0,0,0.1);
            color: rgb(0,0,0,0.8);
            padding: 0 1vw;  
            appearance: none; 
            border-radius: 0;
        }
        #send-button {
        border: none !important;
        outline:0px;
        display: inline-block;
        height: 100%;
        width: 10%;
        background: #186cb9;
        margin-right: 0;
        position: relative;
        }
        #send-button::after{
        font-family: 'Font Awesome 5 Free';
        content: "\f30b";
        font-weight: 900;
        position: absolute;
        color: white;
        font-size: 4vh;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        }
        #card-selector-btn{
            background: dodgerblue;
            appearance: none;
            height: 100%;
            border: none !important;
            color: wheat;
        }
    }
</style>