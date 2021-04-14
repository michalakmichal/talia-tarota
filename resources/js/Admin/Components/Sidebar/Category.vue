<template>
    <div>
        <router-link :to="{path: '/admin'}" class="category">
        Dashboard
        </router-link>
        <router-link :to="{path: '/admin/offers'}" class="category">
        Oferta
        </router-link>
        <router-link :to="{path: '/admin/sessions'}" class="category">
        Zamówienia
        </router-link>
        <div class="category">
        Tarot
        </div>
        <div class="category">
        Blog
        </div>
        <div class="category">
        Uzytkownicy
        </div>
        <div class="category">
        Zaawansowane
        </div>
    </div>
</template>
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