<template>
    <div id="theme-selector" @click="setDarkMode">
    </div>
</template>

<script>

    export default {
        data()
        {
            return {
                name: 'Król Monet' //String
            };
        },
        methods:
        {
            setDarkMode()
            {
                document.querySelector('html').classList.toggle('dark-mode');
            }
        },
        mounted() {
        }
    }
</script>
<style lang="scss" scoped>
#theme-selector
{
    width: 2.5vw;
    height: 2.5vw;
    /*background: rgb(180,180,180);
    background: #323232;
    color: cornflowerblue;*/
    background: rgb(60,60,60);
    color: white;
    border-radius: 0.4rem;
    text-align: center;
    padding: 2%;
    margin: 0.5%;
    margin-bottom: 1vw;
    box-sizing: border-box;
    align-self: flex-end;

}
</style>