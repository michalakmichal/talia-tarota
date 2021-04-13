<template>
    <div id="main">
        <div id="left-column">
            <div v-for="user in users" class="session" :key="user.name" ref="users"> 
                <div class="user-miniature"> 
                    <div class="content" :style="'background-image:url('+user.color+')'"> {{/*user.name*/}} </div>
                    <div class="activity-state"> {{/*user.name*/}} </div>
                </div>
                <div class="wrapper">
                    <span class="link"> {{ user.name }} Kozłowski </span>
                    <span> Wróżba ogólna </span>
                </div>
                <span class="time-sent"> 16.30 </span>
            </div>
        </div>
    <Session />
    </div>
</template>

<script>
import {gsap} from 'gsap';
import {axios} from 'axios';
import Session from './Session.vue';
    export default {
        components: {
            Session
        },
        data()
        {
            return {
                message: null,
                users: [{
                    name: 'adssa'
                },{
                    name: 'adssadasd'
                },{
                    name: 'adss'
                },{
                    name: 'asd'
                },{
                    name: 'asd'
                },{
                    name: 'asd'
                }]
            };
        },
        methods:
        {
            init()
            {
               
                
            }
        },
        mounted() {
            this.init();
            this.users=[];
            window.Echo.channel('channel')
            .listen('hello', (e) => {
                e.color = 'https://randomuser.me/api/portraits/women/'+( Math.floor(Math.random() * 90) + 1 )+'.jpg';
                this.users.push(e);
                this.$nextTick( () => {
                    console.log(this.$refs.users);
                    gsap.fromTo(this.$refs.users[this.users.length-1], {opacity: 0}, {
                    opacity: 1,
                    duration: 5
                });
                });
                /*gsap.to(this.$refs.users[0], {
                    opacity: 0,
                    duration: 5
                });*/
            });
        }
    }
</script>
<style lang="scss" scoped>
#main{
    width: 100%;
    height: 100vh;
    display: flex;
    background: #FFFFFF;
    font-size: 1vw;
}
#left-column
{

    .session
    {
        padding: 0;
        display: flex;
        align-items: flex-start;
        margin: 5%;
        //background: red;
        .user-miniature
        {
            display: inline-block;
            position:relative;
            width: 25%;
        }
        .user-miniature:after
        {
            content: "";
            display: block;
            padding-bottom: 100%;
        }
        .time-sent{
            width: 15%;
            color: #7C7C7C;
        }
        .activity-state
        {
            position: absolute;
            right: 5%;
            bottom: 5%;
            width: 20%;
            height: 20%;
            background: green;
            border-radius: 50%;
        }
        .content
        {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            background-size: 100% 100%;
            border-radius: 50%;

        }
        .wrapper{
            width: 60%;
            padding: 0 5%;
            box-sizing: border-box;
            span
            {
                display: inline-block;
            }
        }
    }

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
    height: 100vh;
}

</style>