<template>
    <nav id="nav">
    <div id="logo"> Talia tarota</div>
    <router-link :to="{path: '/dashboard'}">Strona główna</router-link>
     <router-link :to="{path: '/cards'}">Karty</router-link>
    <router-link :to="{path: '/blog'}">Blog</router-link>
    <router-link :to="{path: '/account'}">Konto</router-link>
    <router-link :to="{path: '/settings'}">Ustawienia</router-link>
    </nav>
</template>
<style lang="scss" scoped>
#nav
{
    width: 100%;
    border-bottom: 0.1vw solid gray;
    router-link{
    }
    a{
        border-bottom: solid 0.4vw white;
        padding: 0 5%;
        padding-bottom: 1vw;
        font-size: 1.2rem;
        text-decoration: none;
        display: inline-block;
        transition-duration: 1s;
        transition-property: color background;
        
    }
    .router-link-exact-active {
        border-color: #136CB9 !important;
        color: black;
    }
    #logo{
        font-size: 2vw;
        padding-bottom: 2vw;
    }
}
.dark-mode
{
        .router-link-exact-active {
        color: white !important;
    }
}
</style>