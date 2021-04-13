<template>
    <div>
        <router-link :to="{path: '/admin'}" class="category" ref="notif">
        Dashboard
        </router-link>
        <router-link :to="{path: '/admin/offers'}" class="category" ref="notif">
        Oferta
        </router-link>
        <router-link :to="{path: '/admin/sessions'}" class="category" ref="notif">
        Zamówienia
        </router-link>
        <div class="category" ref="notif">
        Tarot
        </div>
        <div class="category" ref="notif">
        Blog
        </div>
        <div class="category" ref="notif">
        Uzytkownicy
        </div>
        <div class="category" ref="notif">
        Zaawansowane
        </div>
    </div>
</template>

<script>
import {gsap} from 'gsap';

    export default {
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
.category
{
    padding: 1vw 2vw;
    .sent_at
    {
        font-size: 0.8vw;
    }
}
    a
    {
        text-decoration: none;
        color: inherit;
        display: block;
    }


</style>