<template>
    <div id="account-view">
    <div style="width: 100%;">
        <div class="user-miniature"> 
                <div class="content" :style="user ? `background-image:url(https://randomuser.me/api/portraits/women/${user.id}.jpg)` : ''"> </div>
                <div class="activity-state"> </div>
        </div>
     </div>
        <form  @submit.prevent>
            <div class="row"> 
                <label for="user-name"> Imię  </label>
                    <div class="inputWrapper"> 
                        <input type="text" :value="user.name" name="user-name"/>
                    </div>
            </div>
            <div class="row"> 
                <label for="user-surname"> Nazwisko </label>
                    <div class="inputWrapper"> 
                        <input type="text" :value="user.lastname" name="user-surname"/> 
                    </div>
            </div>
            <div class="row"> 
                <label for="user-email"> Email </label>
                    <div class="inputWrapper"> 
                        <input type="email" :value="user.email" placeholder="email@example.com"/> 
                    </div>
            </div>
            <div class="row"> 
                <label for="user-name"> Hasło </label>
                    <div class="inputWrapper"> 
                        <input type="password" value="hasło"/> 
                    </div>
            </div>
            <div class="row" style="flex-flow: row-reverse;">
            <button> Zapisz </button>
            </div>
        </form>
    </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';
const { mapActions, mapGetters, mapMutations } = createNamespacedHelpers('common');


//import {session} as api from '../Repository/index';
    export default {
        data()
        {
            return {
                message: null,
                sessions: [],
                formData: 
                {
                    email: null,
                    password: null
                }
            };
        },
        computed: {
            ...mapGetters( {user: 'auth/user',
            })
        }
    }
</script>
<style lang="scss" scoped>
#account-view{
    width: 100%;
    display: flex;
    flex-flow: row wrap;
    font-size: 1vw;
    form
    {
        width: 100%;
        .row
        {
            display: flex;
            margin-bottom: 1vw;
            height: 2.5vw;
            font-size: 1rem;
            label{
                width: 25%;
                display: inline-block;
            }
            .inputWrapper
            {
                width: 100%;
                position: relative;
            }
            input{
                width: 100%;
                height: 100%;
                padding-left: 1vw;
                background: aliceblue;
                border: none;
                color: rgb(80,80,80);
                box-sizing: border-box;
            }      
            .inputWrapper:after
            {
                display: none;
                content:"";
                position: absolute;
                width: 5%;
                height: 100%;
                background: indigo;
                top: 0;
                right: 0;
            }
            input:focus {
            border: 3px solid #136CB9;
            }
            button
            {
                background: #1f73bc;
                color: white;
                border-color: transparent;
                cursor: pointer;
                transition: all 1s;
            }
            button:hover
            {
                //background: white;
                background: #1f73bc85;
               // color: #1f73bc;
                //border-color: #1f73bc;
            }
        }
    }
}
//main.scss
.inline-block{
    display: inline-block;
}
.link
{
    color: #136CB9;
    font-weight: bold;
}
//end main.scss
#container
{
    height: 100vh;
}

        .user-miniature
        {
            display: inline-block;
            position:relative;
            width: 15%;
            margin: 2.5vw 0;
        }
        .user-miniature:after
        {
            content: "";
            display: block;
            padding-bottom: 100%;
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
</style>