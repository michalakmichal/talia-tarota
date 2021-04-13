<template>
<div id="recent-articles">
    <h1> Ostatnie artykuły: </h1>
    <div id="articles-wrapper">
        <div class="article"> 
            <img src="https://picsum.photos/200/300/"/> 
                <div class="title">  title  </div>
                    <div class="description">  Lorem ipsum dolor sit amet.  </div>
         </div>
        <div class="article"> 
            <img src="https://picsum.photos/200/300/"/> 
                <div class="title">  title  </div>
                    <div class="description">  Lorem ipsum dolor sit amet.  </div>
         </div>
        <div class="article"> 
            <img src="https://picsum.photos/200/300/"/> 
                <div class="title">  title  </div>
                    <div class="description">  Lorem ipsum dolor sit amet.  </div>
         </div>
        <div class="article"> 
            <img src="https://picsum.photos/200/300/"/> 
                <div class="title">  title  </div>
                    <div class="description">  Lorem ipsum dolor sit amet.  </div>
         </div>
    </div>
</div>
</template>

<script>

    export default {
        props:
        {
        },
        data()
        {
            return {
              //  name: 'Król Monet' //String
            };
        },
        methods:
        {
            init()
            {
               
                
            }
        },
        mounted() {
        }
    }
</script>
<style lang="scss" scoped>
    h1
    {
        margin: 0 !important;
        font-size: 1.6vw;

    }
    #recent-articles
    {
        margin-top: 2vw;
    }
    #articles-wrapper{

        display: flex;
        flex-flow: row wrap;
        margin-top: 0.5vw;
        .article
        {
            padding: 0 1vw;   
            margin: 1vw 0;
            text-align: center;
            width: 25%;
            box-sizing: border-box;

            img
            {
                width: 10vw;
                margin-bottom: 1vw;
            }
            .title
            {
                font-size: 1.4vw;
                margin-bottom: 0.5vw;
            }
        }

  
    }
</style>