<template>
    <div id="left-column" ref="left-column">
        <div id="content">
            <div class="toggle-button" @click="toggle"> < </div>
            <Session v-for="session in sessions" class="session" :key="session.name" v-bind="session" ref="sessions"/>
        </div>
    </div>
</template>
<script>
import Session from './Session.vue';
import { gsap } from 'gsap';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');

export default
{
    components:
    {
        Session
    },
    data()
    {
        return {
            tl: null
        };
    },
    computed:
    {
        ...mapGetters( {
            authenticated: 'auth/authenticated',
            sessions: 'session/sessions'
        })
    },
    methods:
    {
        ...mapActions({
            getUserSessions: 'session/getUserSessions'
        }),
        toggle()
        {
            if(this.toggled) this.tl.reverse();
            else this.tl.play();
            this.toggled=!this.toggled;
            
        }
    },
    async mounted(){
        if(this.authenticated)
        {
            await this.getUserSessions();
            console.log("SESJE START:",this.sessions);
            //this.sessions = this.user_sessions;
            let self = this;
            this.$nextTick(()=>{
                self.tl= gsap.timeline({paused: true}).fromTo('#left-column .session', {opacity: 1}, {
                opacity: 0,
                duration: 0.5,
                //display: "none"
            }).fromTo('#left-column'/*self.$refs['left-column']*/, {width: "20%"}, {
                width: "2vw",
                duration: 0.5
            });
            });
        }
    }
}
</script>
<style lang="scss">
#left-column #content
{
    //height: 100vh;
   // overflow-y: scroll;
   // overflow-x: initial;
}
</style>