<template>
    <div id="left-column" ref="left-column" v-if="sessions">
        <div id="content">
            <div class="toggle-button" @click="toggle"> < </div>
            <div v-for="session in sessions" ref="sessions">
                <Session  class="session" :key="session.name" v-bind="session"/>
            </div>
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
            tl: null,
            toggled: true
        };
    },
    computed:
    {
        ...mapGetters( {
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
    watch:
    {   
       sessions(n, o)
        {
            let self = this;
            self.tl = null;
            
        }
    },
    async mounted(){
        // Get user sessions
        await this.getUserSessions();
        // When loaded animate show up
        let self = this;
        this.$nextTick(()=>{
            self.tl = gsap.timeline().fromTo(self.$refs['left-column'], {width: "2vw"}, {
                width: "20%",
                duration: 0.5
            }).fromTo(self.$refs.sessions, {opacity: 0}, {
            opacity: 1,
            duration: 1,
            //display: "none"
            });
        });
        
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