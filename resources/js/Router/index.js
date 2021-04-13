import VueRouter from 'vue-router';
import routes from './routes';
import store from '../Store/index';

const router = new VueRouter({
mode: 'history',
routes
}
);
/*
router.beforeEach((to, from, next) => {
    
    const authenticated = store.getters["auth/authenticated"];
    const reqAuth = to.matched.some((record) => record.meta.requiresAuth);
    const loginQuery = { path: "/login", query: { redirect: to.fullPath } };
  
    if (reqAuth && !authenticated) {
      store.dispatch("auth/").then(() => {
        if (!store.getters["auth/authUser"]) {
          next(loginQuery);
        } else {
          next();
        }
      });
    } else {
      next(); // make sure to always call next()!
    }
});

router.beforeEach((to, from, next) => {
    const user = firebase.auth().currentUser;
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
    if (requiresAuth && !user) {
      next("/sign-in");
    } else if (requiresAuth && user) {
      next();
    } else {
      next();
    }
  });
*/
//Authentication 
  router.beforeEach(async (to, from, next) => { 
    //mocno zmienić ten kod te ify niepotrzebne chyba
    const authenticated = store.getters['/common/auth/authenticated'];
    const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
    if (requiresAuth) {  //check if route requires auth
      
        if(authenticated){
            console.log("autoryzowano"); // continue to route if user is authenticated
            next();
        }
        else 
        {
            await store.dispatch('common/auth/auth');  // auth if no data in store
            if(store.getters['common/auth/authenticated']) next() // check if api returned authenticated user
            else 
            {
            console.log("nieautoryzowano");
              next("/"); // break and redriect to /login route if user shouldn't see the page
            }
        }
    }
    else {
      await store.dispatch('common/auth/auth'); 
      if(store.getters['common/auth/authenticated'] && to.name == 'login') {
        next('dashboard')
      }
      else next(); // continue request if authentication is not required
    }
});

export default router;