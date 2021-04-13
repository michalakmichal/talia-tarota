<template>
    <div class="bar">
        <div id="equipment"> 
        <div class="slots-wrapper">
            <div v-for="slot in slots" class="slot" :key="slot.name" ref="slots"> 
                <div class="content" :style="'background-color:'+slot.color"> {{slot.name}} </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import {gsap} from 'gsap';
    export default {
        data()
        {
            return {
                message: null,
                slots: [{
                    name: 'lorem'
                },{
                    name: 'ipsum'
                },{
                    name: 'dolor'
                },{
                    name: 'sit'
                },{
                    name: 'amet'
                },{
                    name: 'asd'
                },{
                    name: 'lorem'
                },{
                    name: 'ipsum'
                },{
                    name: 'dolor'
                },{
                    name: 'sit'
                },{
                    name: 'amet'
                },{
                    name: 'asd'
                },{
                    name: 'lorem'
                },{
                    name: 'ipsum'
                },{
                    name: 'dolor'
                },{
                    name: 'sit'
                },{
                    name: 'amet'
                },{
                    name: 'asd'
                },{
                    name: 'lorem'
                },{
                    name: 'ipsum'
                }]
            };
        },
        mounted() {
            console.log('Component mounted.');
            this.users=[];
            window.Echo.channel('channel')
            .listen('hello', (e) => {
                this.users.push(e);
                this.$nextTick( () => {
                    console.log(this.$refs.users);
                    gsap.fromTo(this.$refs.users[this.users.length-1], {opacity: 0}, {
                    opacity: 1,
                    duration: 5
                });
                });
                /*gsap.to(this.$refs.users[0], {
                    opacity: 0,
                    duration: 5
                });*/
            });
        }
    }
</script>
<style lang="scss" scoped>
.bar
{
    width: 20vw;
    height: 100%;
    background: red;
}
#equipment
{
    width: 100%;
    height: 50%;

    background: blue;
    .slots-wrapper
    {
        width: 100%;
        display: flex;
        flex-flow: row wrap;
        align-items: flex-start;
    }
    .slot
    {
        text-align: center;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: red;
        width: 20%;
        border-radius: 50%;
    }
    .slot:after
    {
        content: "";
        display: block;
        padding-bottom: 100%;

    }
}
</style>