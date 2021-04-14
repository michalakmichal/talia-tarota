<template>
    <div  id="main-container" ref="main-container">
        <div ref="renderCanvas" id="render-canvas"></div>
    <div id="stars-wrapper">
        <img src="/img/aries.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/taurus.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/gemini.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/cancer.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/leo.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/virgo.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/libra.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/scorpio.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/sagittarius.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/capricorn.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/aquarius.svg" class="zodiac-star" ref="stars"/>
        <img src="/img/pisces.svg" class="zodiac-star" ref="stars"/>
    </div>
        <div id="login-wrapper">
            <span style="color: red;"> {{error}}</span>
            <form action="#" @submit.prevent="handleLogin" v-if="!authenticated">   
                <input type="email" name="email" v-model="formData.email" placeholder="Login"/> 
                <input type="password" name="password" v-model="formData.password" placeholder="Hasło"/> 
                <button type="submit"> Zaloguj się </button>
            </form>
            <a href="#" @click.prevent="handleLogout" v-else style="text-align: right; align-self: flex-end;">Wyloguj się </a>
        </div>
    </div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
import * as api from '../Repository/index';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');
import {randomInt} from '../utils.js';
import * as PIXI from 'pixi.js'
//import {session} as api from '../Repository/index';
    export default {
        data()
        {
            return {
                message: null,
                formData: 
                {
                    email: null,
                    password: null
                },
                toggled: false,
                tl: null,
                app: null,
                graphics: null,
                scale: 1, // <--
                dir: 1 // 1 obiekt
            };
        },
        computed: {
            ...mapGetters( {user: 'auth/user',
            userList: 'user/userList',
            users: 'user/users',
            authenticated: 'auth/authenticated',
            sessions: 'session/sessions',
            notifications: 'notification/sessionNotifications',
            error: 'auth/error'
            })
        },
        methods:
        {
            ...mapMutations({
            addNotification: 'notification/ADD_NOTIFICATION',
            getUserSessions: 'session/getUserSessions'
            }),
            ...mapActions({
            auth: 'auth/auth',
            signIn: 'auth/signIn',
            signOut: 'auth/signOut',
            }), 
            async init()
            {
                console.log("STORE IS:", this.$store);
                await this.auth();
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
                    this.$router.push('dashboard');
                }
                console.log(this.user);
              
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
            },
            animate()
            {

                this.graphics.clear();
                if(this.scale >= 3 || this.scale <= 0) {
                this.dir *=-1;
                }
                this.scale += 0.1*this.dir;
                // set a fill and line style
                this.graphics.lineStyle(3, 0xffffff, 1);
                
                // draw a shape
                this.graphics.moveTo(0,0);
                this.graphics.lineTo(0.16*this.scale, 1.56*this.scale);
                this.graphics.lineTo(55.16*this.scale, 7.06*this.scale);
                this.graphics.lineTo(79*this.scale, 17.14*this.scale);
                this.graphics.lineTo(87.08*this.scale, 35.48*this.scale);
                this.graphics.endFill();
                this.app.renderer.render(this.app.stage);
                requestAnimationFrame( this.animate );
            }
        },
        async created()
        {
        },
       async mounted() {

            document.documentElement.setAttribute('data-theme', 'dark');
            this.init();
            //let stage = new PIXI.Stage(0xFFFFFF, true);
            const canvas = this.$refs.renderCanvas;
            const width = canvas.offsetWidth;
            const height = canvas.offsetHeight;
            //Create a Pixi Application
           // let app = new PIXI.Application({width, height});
           // document.getElementById('render-canvas').appendChild(app.view)
            //renderCanvas.appendChild(app.view);
           // document.body.appendChild(renderer.view);
            //rendererCanvas.render(stage);
            //console.log(renderCanvas);
            this.app = new PIXI.Application({
                width, height, transparent: true, resolution: window.devicePixelRatio || 1,
            });
            canvas.appendChild(this.app.view);
            this.graphics = new PIXI.Graphics();
            this.app.stage.addChild(this.graphics);
            this.animate();


             let tl = gsap.timeline();
            /// TAMTO NA GÓRZE NA RAZIE USUNAC RACZEJ

            //STAGGER jest dla ułatwienia animowania tych samych wartości z opoznieniem dla kazdego
            //elementu
            tl.fromTo('.zodiac-star', {scale: 0, opacity: 0},{
                    duration: 1,
                    //repeat: -1,
                    scale: 1,
                    opacity: 1,
                    stagger: 0.1 // 0.1 seconds between when each ".box" element starts animating
            });/*.fromTo('.zodiac-star', { opacity: 1},{
                    duration: 1,
                    repeat: -1,
                    opacity: 0.5,
                    yoyo:true,
                    stagger: 0.1 // 0.1 seconds between when each ".box" element starts animating
            });*/


            //Tutaj foreach raczej się przyda
             const stars = document.querySelectorAll('.zodiac-star');
             console.log("gwiazdy:", stars);
             Array.from(stars).forEach(star => {
                 let tl = gsap.timeline();
                 tl.fromTo(star, { opacity: 1},{
                    duration: 2,
                    repeat: -1,
                    opacity: 0.5,
                    yoyo:true,
                    yPercent: randomInt(0,1) ? randomInt(10,30) : randomInt(-10,-30),
                     // 0.1 seconds between when each ".box" element starts animating
                     });
             });
       }
       
    }
</script>
<style lang="scss" scoped>

#main-container{
    height: 100vh;
    flex: 1;
    font-size: 1vw;
    padding: 5%;
    display: flex;
    position: relative;
    flex-flow: row wrap;
    align-items: center;
    justify-content: center;
    background: linear-gradient(0, #7EAAE6, #0d256a);
    box-sizing: border-box;
    #stars-wrapper
    {
        align-self: flex-start;
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
    .zodiac-star{
        top: 5%;
        left: 5%;
        width: 10vw;
        height: 10vw;
        padding: 1vw;
        margin-top:2vw;
        box-sizing: border-box;
        display: inline-block;
    }
    form{
    }

}
#login-wrapper{
    width: 25vw;
    box-sizing: border-box;
    
    input{
        width: 100%;
        box-sizing: border-box;
        margin: 1vw 0;
        height: 2.75vw;
        background: white;
        border: none;
        padding-left: 1vw;
    }
    button{
        width: 100%;
        background: white;
        margin: auto;
        box-sizing: border-box;
        margin-top: 2vw;
        height: 2.75vw;
        color: cornflowerblue;
        font-weight: bold;
        border: none;

    }
}
#render-canvas{
    width: 30vw;
    height: 30vh;
    display: none;
}
//end main.scss

</style>