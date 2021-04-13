<template>
<div>
    <router-link :to="{name: 'session', params: {id} }" class="session_item">
        <div class="user-miniature" @click="/*DELETE_SESSION(id)*/"> 
        <div class="active-ring" v-if="state_id==3"> </div>
            <div class="content" :style="user(users[0].id) ? `background-image:url(https://randomuser.me/api/portraits/women/${user(users[0].id).image.url}.jpg)` : ''"> {{/*user.name*/}} </div>
            <div class="content" :style="`background-image:url(/img/sessions/${offer_id}.png)`"> {{/*user.name*/}} </div>
            <!-- <div class="activity-state" :class="{ 'active-state': users[0].activity_state }"> </div> -->
            <div class="notification notification-quantity" 
                 v-if = "notifications.length >= 1"  
                 @click = "toggleNotifications"> 
                    <div class="content"> {{ notifications.length }} </div>
            </div>
        </div>
        <div class="wrapper">
        {{ /* zbędne session.users.length!=0 ?  session.users[0].name  : "" */ }}
            <span class="link" style="display: none"> {{ users[0].name }} </span>
            <div class="session-type"> {{types[offer_id]}} </div>
            <div :class="states[state_id].class"> {{states[state_id].title}} </div>
            {{/* users[0].activity_state ? 'AKTYWNY' : 'NIEAKTYWNY'  */}}

        </div>
        <span class="time-sent"> 16.30 </span>
        <div class="notifications-wrapper" v-if="!toggled" ref="notifications">
                <Notification v-for="notification in notifications" 
                              :key="notification.id" 
                              v-bind="notification" 
                              />
        </div>
        
    </router-link>
    <div id="session-edit-form">
            <button id="session-edit" @click="toggleModal"> <img src="/img/SVG/session_edit.svg"/>  </button>
            <settings-modal v-if="settings_toggled" v-bind="$props"/> 
        </div>
        </div>
</template>
<script>
import {gsap} from 'gsap';
import {axios} from 'axios';
import Notification from './Notification.vue';
import SettingsModal from './SettingsModal.vue';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');

    export default {
        components: {
        Notification,
        SettingsModal
        }
        ,
        props:
        {
            id: Number,
            state_id: Number,
            offer_id: Number,
            users: Array,
        },
        data()
        {
            return {
                toggled: false,
                settings_toggled: false,
                states: {
                    '1' : {
                    'title': 'Oczekiwanie na potwierdzenie', //w bazie danych tez zmienic z name na title
                    'class': 'title-waiting'
                    },
                    '2' : {
                    'title': 'Do rozpoczęcia', //w bazie danych tez zmienic z name na title
                    'class': 'title-accepted'
                    },
                    '3' : {
                    'title': 'W trakcie', //w bazie danych tez zmienic z name na title
                    'class': 'title-started'
                    },
                    '4' : {
                    'title': 'Zakończona', //w bazie danych tez zmienic z name na title
                    'class': 'title-ended'
                    }
                },//PRZENIEŚĆ DO JAKIEGOŚ PLIKU - NIE ROBIĆ ZMIENNEJ DLA KAŻDEJ SESJI
                // do STORE session np
                types:{
                    1: 'Wrózba ogólna',
                    2: 'Karta',
                    3: 'Horoskop',
                    4: 'Oczyszczanie'
                }
            };
        },
        computed:
        {
            ...mapGetters( {
            //user: 'auth/user',
            authenticated: 'auth/authenticated',
            sessionNotifications: 'notification/sessionNotifications',
            user: 'user/user'
            }),
            notifications()
            {
                return this.sessionNotifications(this.id);
            }
        },
        methods:
        {
            ...mapActions({
            auth: 'auth/auth',
            }),
            ...mapMutations({
            DELETE_SESSION: 'session/DELETE_SESSION'
            }),
            toggleNotifications(event)
            {
                event.preventDefault();
                event.stopPropagation();
                if(!this.toggled)
                {
                    gsap.timeline().fromTo(this.$refs['notifications'], {xPercent: 0, opacity: 1}, {
                        opacity: 0,
                        duration: 1,
                        xPercent: -50,
                        onComplete: () => {this.toggled = !this.toggled}
                        //stagger: 0.4
                    });
                }
                else this.toggled = !this.toggled;
            },
            toggleModal(e)
            {
                 event.preventDefault();
                event.stopPropagation();
                this.settings_toggled=!this.settings_toggled;
                    
            }
        },
        mounted() {
            console.log(this.id);
        }
    }
</script>
<style lang="scss" scoped>
.session_item
{
     display: flex;
        align-items: flex-start;
        flex-flow: row wrap; //NA PEWNO??
        text-decoration: none;
        color: inherit;
        padding: 1vw 0;
        border: none;
        padding-bottom: 0;
        width: 100%;

}
.session // to nalezy do komponentu powyzej, w tym pliku nie ma tej klasy w kodzie
    {
        display: flex;
        align-items: flex-start;
        flex-flow: row wrap; //NA PEWNO??
        text-decoration: none;
        color: inherit;
        padding: 1vw 0;
        border-bottom: solid #1d2638 1px;
        margin: 0 5%;
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
            background: gray;
            border-radius: 50%;
        }
        .active-state
        {
             background: green;
        }
        .active-ring
        {
            position: absolute;
            width: 100%;
            height: 100%;
            background: green;
            border-radius:50%;
            animation: pulsate infinite 1.3s;
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
        .seesion-type{
            transition-duration: 1s;
            transition-property: background color;
        }
    }
 @-webkit-keyframes pulsate {
  0% {
    -webkit-transform: scale(1.1);
    opacity: 1;
  }
  100% {
    -webkit-transaaform: scale(1.2);
    opacity: 0;
  }
  }
.notification
{
    position: absolute;
    right: 5%;
    bottom: 5%;
    width: 25%;
    height: 25%;
    background: gray;
    border-radius: 50%;
    .content
    {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgb(0, 255, 255, 0.1);
        color: white;
        background-size: 100% 100%;
        border-radius: 50%;
    }
}
.notifications-wrapper
{
    width: 100%;
    text-align: center;
    .notification
    {
        position: relative;
        right: auto;
        bottom: auto;
        width: auto;
        height: auto;
        border-radius: 0;
        background: #201e1e;
       // display: inline-block;
        color: white;
        padding: 4%;
        margin-top: 4%;
    }
}
.title-waiting, .title-ended{
    color: #7C7C7C;
}
.title-accepted{
    //color: #7C7C7C;
    color: white;
    text-shadow: 0 0 0.5vw rgba(255,255,255,0.7);
}
.title-started{
    color: green; 
    font-size:1vw;
    margin-top: 0.2vw;
    text-transform: uppercase;
    //animation: glow 1s infinite alternate;
    text-shadow: 0 0 0.5vw rgba(0,180,0,0.7);
}
#session-edit-form
{
    width: 100%;
    text-align: right;
    position: relative;
}
#session-edit{
    appearance: none;
    outline: none;
    border: none;
    cursor: pointer;
    background: transparent;
    color: white;
    img
    {
        width: 1vw;
        height: 1vw;
    }
}
@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 0.25vw rgb(24, 180, 185, 0.1), 0 0 0.5vw rgb(24, 180, 185, 0.1), 0 0 0.75vw rgb(24, 180, 185, 0.1), 0 0 1vw rgb(24, 180, 185, 0.1), 0 0 1.25vw rgb(24, 180, 185, 0.1), 0 0 1.5vw rgb(24, 180, 185, 0.1), 0 0 1.75vw rgb(24, 180, 185, 0.1);
  }
  to {
    text-shadow: 0 0 0.25vw rgb(0, 255, 255, 0.1), 0 0 0.5vw rgb(0, 255, 255, 0.1), 0 0 0.75vw rgb(0, 255, 255, 0.1), 0 0 1vw rgb(0, 255, 255, 0.1), 0 0 1.25vw rgb(0, 255, 255, 0.1), 0 0 1.5vw rgb(0, 255, 255, 0.1), 0 0 1.75vw rgb(0, 255, 255, 0.1);
  }
}
.dark-mode .session-type
{
    color: white;
}
</style>