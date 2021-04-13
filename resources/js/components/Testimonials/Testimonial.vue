<template>
<div class="testimonial">
   <img src="https://randomuser.me/api/portraits/men/46.jpg"/>
   <div class="content-wrapper">
        <span class="title"> <b> Witaj na stronie taliatarota.pl</b></span> <br />
        <span class="content"> Zapraszam do zapoznania się z ofertą. </span> <br />
        <span id="description"> 
            Dziś – po wielu latach praktyki – w swojej pracy łączę numerologię i wróżenie z Tarota, dzięki czemu udaje mu się uzyskać odpowiedzi na niemal każde pytanie, z jakim zwracają się do mnie moi Klienci. Moja zdolność w interpelacji rozkładów Tarota, które uzupełniam numerologia, sprawia, że jest spore zainteresowanie moimi wróżbami i wiele osób wraca do mnie, by ponownie skorzystać z moich usług. Wiedza praktyczna i teoretyczna to doskonała podstawa do tego, by prognozować przyszłość, ale to nie wszystko, by być dobrą wróżką. Odpowiadając na pytania Klientów staram się przede wszystkim wyróżniać się szczerością – moje wróżby są odzwierciedleniem tego, co pokazują karty. Zdaję sobie sprawę z tego, że każdy chciałby usłyszeć wyłącznie to, podpowiada mu serce, czego pragnie jego dusza, ale wróżby nie mają na celu poprawienia czyjegoś nastroju czy zapewnienia go, że wszystko będzie dobrze, choć Tarot pokazuje coś zupełnie innego. Swoje wróżby traktuję jako drogowskaz dla Klientów, jako źródło wskazówek, rad, przestróg i zawsze pozostawiam wybór Klientowi. To on ostatecznie decyduje, czy i w jaki sposób wykorzysta to, co przekazuje mu Tarot za moim pośrednictwem. Dlatego też każdy, kto zwraca się do mnie z prośbą o postawienie kart, może liczyć nie tylko na rzetelność, z jaką podejdę do jego spraw, ale również na prawdę i szczerość z mojej strony, nieokraszoną słodkimi słowami i złudnymi nadziejami. Ze swojej strony gwarantuję, że zawsze powiem to, co pokażą karty, a nie to, co chcesz usłyszeć. Zawsze stawiam na szczerość i prawdę, intepretując poszczególne rozkłady, choć wiem, że takie wróżby mogą w pierwszej chwili budzić przeciw w osobie, która je potem czyta.
        </span>
   </div>
</div>
</template>

<style lang="scss" scoped>
.card-wrapper
{
    width: 10%;
    box-sizing: border-box;
    position: relative;
    padding: 0.2vw;
    display: flex;
    flex-direction: column;
    .name
    {
        width: 100%;
        background: rgba(255,255,255,0.8);
        font-weight: bold;
        font-size: 1vw;
        padding: 0.2vw;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align:center;
        flex: 1;
    }
}
.card
{
    width: 100%;
    /*background: rgb(180,180,180);
    background: #323232;
    color: cornflowerblue;*/
    //background: linear-gradient(0deg, cornflowerblue, #aba7f0a6);
    background-size: cover;
    color: white;
    //border-radius: 0.4rem;
    text-align: center;
    //margin: 0.5%;
    box-sizing: border-box;
}
.testimonial{
    margin-top: 4vw;
    display: flex;
    align-items: flex-start;

    img{
        width: 10vw;
        border-radius: 10vw;
    }
    .content-wrapper{
        padding-left: 2vw;

        .title{
            font-size: 1.4vw;
        }
        .content{
            margin-top: 0.8vw;
            margin-left: 0.5vw;
            font-size: 1.2vw;
            display: inline-block;
        }
    }
}
#description{
    display: inline-block;
    margin-top: 1vw;
    margin-left: 0.5vw;
}
</style>