<template>
    <div class="message">
        <div class="wrapper">
        {{ /* zbędne session.users.length!=0 ?  session.users[0].name  : "" */ }}
            <span class="content"> {{ content }} </span>
            <div class="time-sent"> 16.30 </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:
        {
            id: Number,
            content: String,
            user: Object,
            type: Object
        }
    }
</script>
<style lang="scss" scoped>
.message
    {
        padding: 0;
        margin: 2%;
        text-decoration: none;
        text-align: center;
        color: inherit;
        //background: red;
        .user-miniature
        {
            display: inline-block;
            position:relative;
            width: 8%;
        }
        .user-miniature:after
        {
            content: "";
            display: block;
            padding-bottom: 100%;
        }
        .time-sent{
            margin-top: 1%;
            color: #7C7C7C;
            text-align: left;
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
        .image
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
            width: 92%;
            padding: 0 2%;
            box-sizing: border-box;
            word-break: break-word;
            .content
            {
                display: inline-block;
                padding: 1vw;
                border-radius: 1rem;
                background: cornflowerblue;
                color: white;
            }
        }
    }

</style>