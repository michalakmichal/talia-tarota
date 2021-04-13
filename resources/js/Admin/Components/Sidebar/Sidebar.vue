<template>
    <div class="notification" ref="notif">
     <Category/>
    </div>
</template>

<script>
import {gsap} from 'gsap';
import Category from '../Sidebar/Category.vue';

    export default {
        components:
        {
            Category
        },
        props:
        {
           
        },
        computed: {
        },
        methods:
        {

            async init()
            {
               
            }
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