<template>
    <router-view> </router-view>
</template>

<script>
    export default {
        name: 'app',
        methods:
        {
        },
        mounted() {
           
        }

    }
</script>
<style lang="scss" scoped>
#main{
    width: 100%;
    min-height: 100vh;
    display: flex;
    font-size: 1vw;
}

//main.scss
.inline-block{
    display: inline-block;
}
.link
{
    color: #136CB9;
    font-weight: bold;
}
//end main.scss
#container
{
    min-height: 100vh;
}

</style>