<template>
    <div id="main">
        <session-controller/>
        <div  id="main-container" ref="main-container" :class="$route.meta.overflowDom ? 'overflow-dom' : ''">
            <theme-selector />
                <span style="color: red;"> {{error}}</span>
                    <a href="#" @click.prevent="handleLogout" id="logout-button">Wyloguj się </a>
        <navbar/>
        <router-view> </router-view>
    </div>
    </div>
</template>

<script>
import ThemeSelector from '../components/ThemeSelector.vue';
import Navbar from '../components/Navbar.vue';
import SessionController from '../components/Sessions/SessionController.vue';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');

//import {session} as api from '../Repository/index';
    export default {
        components: {
            SessionController,
            Navbar,
            ThemeSelector
        },
        data()
        {
            return {
                channel: null
            };
        },
        computed: {
            ...mapGetters( {user: 'auth/user',
            authenticated: 'auth/authenticated',
            error: 'auth/error',
            })
        },
        methods:
        {
            ...mapMutations({
            addNotification: 'notification/ADD_NOTIFICATION',
            addSession: 'session/ADD_SESSION',
            setState: 'session/SET_SESSION_STATE'
            }),
            ...mapActions({
            auth: 'auth/auth',
            signOut: 'auth/signOut',
            }), 
            async init()
            {
                await this.setupSockets();

            },
            async setupSockets()
            {

                this.channel = window.Echo.private(`user.${this.user.id}`)
                .notification(
                    async (notification) => {
                        this.addNotification(notification);
                    })
                .listen('SessionCreated', async (e) =>{
                        this.addSession(e.session);
                })
                .listen('SessionStateChanged', async (e) =>{
                       this.setState({id: e.id, state_id: e.state_id}); 
                       // to wywyoła sie 2x dla wlasciciela, bo on zmienia po mutacji + otryzmuje pwoaidomienie o zmianie i tez sie zmienia, zdecydowac sie na 1 (wersja 1)
                });
            }
            ,
            async handleLogout()
            {
                try{
                    Echo.leave(`user.${this.user.id}`);
                    await this.signOut();
                    this.$router.push('/');
                }catch(err){
                    console.log(err);
                }
            }
        },
        destroyed()
        {
            Echo.leave(`user.${this.user.id}`);
        },
       async mounted() {
            document.documentElement.setAttribute('data-theme', 'dark');
            this.init();
        }
    }
</script>
<style lang="scss" scoped>

#main-container{
    min-height: 100vh;
    box-sizing: border-box;
    flex: 1;
    font-size: 1vw;
    margin: 0 auto;
    padding: 2% 5%;
    display: flex;
    flex-flow: column;
    position: relative;
}
#left-column
{
    #content
    {
        display: flex;
        flex-flow: row wrap;
        justify-content: flex-end;
        overflow-y: scroll;
    }
    .session
    {
        padding: 0;
        display: flex;
        align-items: flex-start;
        margin: 5%;
        width: 100%;
        position:relative;
        //background: red;
        opacity: 1;
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

//end main.scss
#container
{
    min-height: 100vh;
}
.overflow-dom{
    height: 90vh;
}

#logout-button
{
    text-align: right; 
    align-self: flex-end;
}
</style>