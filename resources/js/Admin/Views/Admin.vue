<template>
<div style="display:flex">
    <div id="left-column" ref="left-column">
        <Sidebar />
    </div>
    <div id="page-content">
     <router-view> </router-view>
    </div>
</div>
</template>

<script>
import { gsap } from 'gsap';
import axios from 'axios';
//import { mapGetters, mapMutations, mapActions} from 'vuex';
import Sidebar from '../Components/Sidebar/Sidebar.vue';
import { attachAdminStore } from '../Mixins/common.js';

export default
{
    mixins: [ attachAdminStore ],
    components: {
        Sidebar
    },
    computed:
    {
        ___store ()
        {
            return this.$store;

        }
    },
    mounted()
    {
    }
}
   
</script>
<style lang="scss" scoped>
#chart
{


}
#page-content{
    padding: 4vw 6vw;
    flex: 1;
}
</style>