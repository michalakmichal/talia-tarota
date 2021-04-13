<template>
    <div>
        <div class="content">
            <img v-for="image in images" :src="image.url" :key="image.id" /> 
        </div>
        <div class="title"> {{ name }} </div>
    </div>  
</template>

<script>

    export default {
        props:
        {
            name: String,
            images: Array
        }
    }
</script>
<style lang="scss" scoped>
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

</style>