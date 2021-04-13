<template>
<div id="session-view">
    <div id="messages-wrapper" ref="messages-wrapper">
        <div  v-if="!loading" style="display: flex; flex-flow: column;">
            <component 
            v-for="message in messages" class="session" 
            :is="message.type.name"
            :key="message.id" v-bind="message"/>
        </div>
        <!-- oddzielny komponent do ładowania -->
        <div v-else style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
            <img src="/img/loading.gif" style="width: 50%"/>
         </div>
    </div>
    <div style="margin-top: 1%;"> 
        <message-typing v-if="user_is_typing" :user-name="typing_user" />
    </div>
    <message-input @typing="sendTypingEvent" @sendMessage="sendMessage" />
</div>
</template>

<script>
import {gsap} from 'gsap';
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');
import MessageTyping from '../components/Messages/MessageTyping.vue';
import MessageInput from '../components/Messages/MessageInput.vue';
import ScrollToPlugin from "gsap/ScrollToPlugin";
// <message v-for="message in messages" class="session" :key="message.id" v-bind="message" ref="messages"/>
//import {session} as api from '../Repository/index';
    export default {
        props: ['id'],
        components: {
            Message: () => import('../components/Messages/Message.vue'),
            Log: () => import('../components/Messages/Log.vue'),
            Error: () => import('../components/Messages/Error.vue'),
            CardMessage: () => import('../components/Messages/CardMessage.vue'),
            MessageTyping,
            MessageInput
        },
        data()
        {
            return {
                loading: false,
                channel: null,
                typing_user: null,
                user_is_typing: false,
                timer: null,
                tl: null
            };
        },
        computed: {
            ...mapGetters( {
            messages: 'message/messages',
            sessions_loaded: 'session/sessions_loaded',
            })
        },
        async beforeRouteUpdate (to, from, next) {
            // Unsubscribe previous channel
            window.Echo.leave(`session.${this.id}`);
            // Load messages from requested channel
            this.loading=true;
            await this.getSessionMessages(to.params.id);
            this.loading=false;
            /* Subscribe next channel right after component data have been loaded 
             * and DOM has been updated 
             */
            this.$nextTick( () => {
                this.connectToChannel();
            });
            // Finally, serve reloaded view to user
            next();
        },
        methods:
        {
            //...mapMutations({}),
            ...mapActions({
            getSessionMessages: 'message/getSessionMessages',
            send: 'message/sendMessage',
            addMessage: 'message/addMessage'
            }), 
            connectToChannel()
            {
                let tl = gsap.timeline();
                let self = this;
                this.channel = window.Echo.join(`session.${this.id}`);
                // Listen for client events
                this.channel.listenForWhisper('typing', (name) => {
                    //e.typing ? $('.typing').show() : $('.typing').hide()
                    // Show loading dots animation, when user is typing
                    if(!this.user_is_typing)
                    {
                        this.user_is_typing = true;
                        this.typing_user = name;
                        this.$nextTick( () => { tl.fromTo('.dot', {scale: 0, opacity: 0},{
                            duration: 0.3,
                            repeat: -1,
                            scale: 1,
                            opacity: 1,
                            stagger: 0.1 // time between each ".box" element starts animating
                        }); } );
                    }
                    // zrobić tablicę i wszystkich wyświetlić, którzy piszą
                    // 
                    clearTimeout(this.timer);
                
                    this.timer = setTimeout(() => {this.user_is_typing = false; this.tl=gsap.timeline();}, 1000);  

                });
                // Trigerred when someone has send new message on this channel
                this.channel.listen('MessageSent', async (e) => {
                    self.addMessage(e.message);
                    //ZROBIĆ STATUSY: PENDING > SENT > RECEIVED
                    gsap.to(self.$refs['messages-wrapper'], {duration: 2, scrollTo: {y: "max"}});
                    });
            },
            async sendMessage(data)
            {
                let content = data.formData.content;
                if( (content && content!="") || data.type_id == 4)
                {
                    await this.send( {  formData: data.formData,  
                                        type_id: data.type_id,
                                        session_id: this.id  });
                }
            },
            sendTypingEvent() //zrobić osobny plik z eventami dla czatu i go zaimportować :)
            {
                this.channel.whisper('typing', this.user.name);
            }
        },
        async mounted() {
            this.loading=true;
            gsap.registerPlugin( ScrollToPlugin );
            this.connectToChannel();
            await this.getSessionMessages(this.id); 
            this.loading=false;
        },
        destroyed()
        {
            window.Echo.leave(`session.${this.id}`);
        }
    }
</script>
<style lang="scss" scoped>
#session-view
{
    position: relative;
    display: flex;
    flex-flow: column;
    flex: 1;
    overflow: hidden;
    #messages-wrapper
    {
        overflow: scroll;
        overflow-x: hidden;
        flex: 1;
    }
    
}

</style>