<template>
        <span class="glow"> {{ userName}} pisze wiadomość 
            <i class="dot"> </i>
                <i class="dot"> </i>
                    <i class="dot"> </i> 
        </span>
</template>
<script>
    export default {
        props: {  userName: String  }
    }
</script>
<style lang="scss" scoped>
.glow {
    color: white;
    text-shadow: 0 0 0.5vw rgba(255,255,255,0.7);
}
.dot {
display: inline-block;
width: 0.5vw;
height: 0.5vw;
border-radius: 50%;
background: white;
}

</style>