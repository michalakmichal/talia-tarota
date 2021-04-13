<template>
    <div class="notification" ref="notif">
        <div class="content">
            <div> {{user_name}} wysłał/a wiadomość. </div>
                <div class="sent_at"> {{sent_at}}  </div> 
        </div>
    </div>
</template>

<script>
import {gsap} from 'gsap';
    export default {
        props:
        {
            quantity: Number,
            session_id: Number,
            user_name: String,
            sent_at: null
        },
       async mounted() {
            gsap.timeline().fromTo(this.$refs['notif'], {xPercent: -50, opacity: 0}, {
                opacity: 1,
                duration: 1,
                xPercent: 0,
                //stagger: 0.4
            });
           
        }
    }
</script>
<style lang="scss" scoped>
.notification
{
    .sent_at
    {
        font-size: 0.8vw;
    }
}


</style>