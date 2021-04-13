<template>
<div class="card-wrapper">
   <div class="name"> {{ name }} </div>
    <img class="card" :src="`/img/tarot/${id}.jpg`"/> 
</div>
</template>

<script>

    export default {
        props:
        {
            id: Number,
            name: String
        }
    }
</script>
<style lang="scss" scoped>
.card-wrapper
{
    width: 10%;
    box-sizing: border-box;
    position: relative;
    padding: 0.2vw;
    display: flex;
    flex-direction: column;
    .name
    {
        width: 100%;
        background: rgba(255,255,255,0.8);
        font-weight: bold;
        font-size: 1vw;
        padding: 0.2vw;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align:center;
        flex: 1;
    }
}
.card
{
    width: 100%;
    background-size: cover;
    color: white;
    text-align: center;
    box-sizing: border-box;
}

</style>