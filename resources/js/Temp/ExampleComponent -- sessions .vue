<template>
    <div id="main">
        <div id="left-column" v-if="authenticated">
            <div v-for="session in sessions" class="session" :key="session.name" ref="sessions"> 
                <div class="user-miniature"> 
                    <div class="content" :style="session.users[0].image ? `background-image:url(https://randomuser.me/api/portraits/women/${session.users[0].image.url}.jpg)` : ''"> {{/*user.name*/}} </div>
                    <div class="activity-state"> </div>
                </div>
                <div class="wrapper">
                {{ /* zbędne session.users.length!=0 ?  session.users[0].name  : "" */ }}
                    <span class="link"> {{ session.users[0].name }} </span>
                    <span> Wróżba ogólna </span>
                </div>
                <span class="time-sent"> 16.30 </span>
            </div>
            {{/* START */}}
            <session v-for="session in sessions" class="session" :key="session.name" :id="session.id"/>
            {{/* END */}}
        </div>
    <div  id="main-container">
        <navbar v-if="authenticated"/>
        <router-view style="padding: 2vw 0"> </router-view>
    </div>
    <span style="color: red;"> {{error}}</span>
        <form action="#" @submit.prevent="handleLogin" v-if="!authenticated">   
            <input type="email" name="email" v-model="formData.email"/> 
            <input type="password" name="password" v-model="formData.password"/> 
            <button type="submit"> Zaloguj się </button>
        </form>
        <a href="#" @click.prevent="handleLogout" v-else>Wyloguj się </a>
    </div>
</template>

<script>
import {gsap} from 'gsap';
import axios from 'axios';
import Session from './Session.vue';
import * as api from '../Repository/index';
import { mapActions, mapGetters} from 'vuex';

import Navbar from './Navbar.vue';

//import {session} as api from '../Repository/index';
    export default {
        components: {
            Session,
            Navbar
        },
        data()
        {
            return {
                message: null,
                sessions: [],
                formData: 
                {
                    email: null,
                    password: null
                }
            };
        },
        computed: {
            ...mapGetters( {user: 'auth/user',
            authenticated: 'auth/authenticated',
            user_sessions: 'session/sessions',
            error: 'auth/error'
            })
        },
        methods:
        {
            ...mapActions({
            auth: 'auth/auth',
            signIn: 'auth/signIn',
            signOut: 'auth/signOut',
            getUserSessions: 'session/getUserSessions'
            }), 
            async init()
            {
                await this.auth();
                console.log(this.authenticated);
                if(this.authenticated)
                {
                    await this.getUserSessions();
                    this.sessions = this.user_sessions;
                }
            },
            addUserToSession()
            {

            },
            async handleLogout()
            {
                try{
                    await this.signOut();
                    this.sessions=null;
                }catch(err){
                    console.log(err);
                }
            },
            async handleLogin()
            {
                console.log(this.formData);
                await this.signIn(this.formData);
                console.log("Singed in");
                if(this.authenticated)
                {
                    await this.getUserSessions();
                    this.sessions = this.user_sessions;
                }
                console.log(this.user);
                //this.getSessions();
                /*
                try
                {
                    let response = await axios.get('/sanctum/csrf-cookie');
                    try
                    {
                    let res = await axios.post('/login', this.formData);
                    this.getSessions();
                    console.log("res after login:");
                    console.log(res);
                    console.log(this.$store.getters['auth/user']);
                    }
                    catch(er)
                    {
                        Object.keys(er.response.data.errors).map((value) => {
                            this.error = er.response.data.errors[value][0];
                            console.log(this.error);
                        });
                    }
                    
                }
                catch(err)
                {
                    console.log(err.response.data);
                }*/
            },
            async getSessions()
            {
                try
                {
                    alert(this.user_id);
                    let response = await axios.get(`/api/users/${this.user_id}/sessions`);
                    console.log(response.data);
                    this.sessions = response.data;
                }
                catch(err)
                {   
                    alert(err);
                }
            },
            async addSession()
            {
                try
                {
                    let response = await axios.post(`/api/sessions`,
                    {
                        data: {
                            name : "sdadsda"

                        }
                    });
                    console.log(response);
                }
                catch(err)
                {   
                    alert(err);
                }
            }
        },
        mounted() {
            api.message.getUserSessions();
            this.init();
            //this.users=[];
            //this.addSession();
            /*window.Echo.channel('channel')
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
                //gsap.to(this.$refs.users[0], {
                //    opacity: 0,
                //   duration: 5
                //});
            }); */
        }
    }
</script>
<style lang="scss" scoped>
#main{
    width: 100%;
    min-height: 100vh;
    display: flex;
    background: #FFFFFF;
    font-size: 1vw;
}
#main-container{
    height: 90vh;
    width: 65%;
    background: #FFFFFF;
    font-size: 1vw;
    margin: 5%;
}
#left-column
{
    width: 25%;
    min-height: 100vh;
    background: #FAFAFA;
    overflow: scroll;
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
            background: rgba(255,255,255,0.8);
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
    min-height: 100vh;
}
@media(max-width: 600px)
{
    #left-column
    {
        width: 50%;
        font-size: 2vw;
    }
}
</style>