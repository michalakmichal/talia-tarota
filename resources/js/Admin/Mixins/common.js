import admin from '../Store/modules/index.js';

export const attachAdminStore =
{
    beforeCreate()
    {
        // Generalnie w Parent Object, dzieci dziedzicza, ale sprawdzic jak zachowa sie przy przeładowaniach strony itp
        // 'session' będzi zmienną - chcę zrobić uniwersalna funkcję dla dowolnego namespace
        // nie tylko module dla admina
        if(!this.$store.hasModule('admin')) this.$store.registerModule('admin', admin);
    },
    beforeDestroy () 
    {
        if(this.$store.hasModule('admin')) this.$store.unregisterModule('admin');
    }
    /*
    beforeUpdate() // ????
    {
        this.$store = store ;
    }*/
}