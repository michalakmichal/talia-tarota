import NotFoundComponent from '../Views/NotFoundComponent';
import { castRouteParams } from '../utils';
import Vue from 'vue';
import  adminStore  from '../Admin/Store/index.js';
import store from '../Store/index.js';
const routes = 
[
    { path: '*', component: NotFoundComponent }, // Catch x404
    {
        path: '/',
        name: 'login',
        component: () => import('../Views/Login.vue'),
    },
    {
        path: '/admin',
        component: () => import('../Admin/Views/Admin.vue'),
        meta:
        {
            requiresAuth: true
        },
        beforeEnter: (to, from, next) => {
            next();
            /* alert("ENTERED");
            console.log("APKA:", window.app);
            store = adminStore;
            console.log("APKA:", store);
           /* next( (vm) => 
                {
                    alert(vm);
                    alert("DDDDONE");
                    vm.store = adminStore;
                    console.log("STOREEEEEE", vm.store);
                });*/
        },
        children:
        [
            {
                path: '/admin',
                component: () => import('../Admin/Views/Dashboard.vue'),
                name: 'home',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: 'sessions',
                component: () => import('../Admin/Views/Sessions.vue'),
                name: 'sessions',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: 'offers',
                component: () => import('../Admin/Views/Offers.vue'),
                name: 'offers',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: 'offer/:id',
                component: () => import('../Admin/Views/Offer.vue'),
                props: castRouteParams({id: 'integer'}),
                name: 'admin-offer',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: 'scrapper',
                component: () => import('../Admin/Views/Offer.vue'),
                name: 'admin-scrapper',
                meta:
                {
                    requiresAuth: true
                }
            }
        ]
    },
    {
        path: '/dashboard',
        component: () => import('../Views/ExampleComponent.vue'),
        meta:
        {
            requiresAuth: true
        },
        name: 'dashboard',
        children:
        [
            {
                path: '/dashboard',
                component: () => import('../Views/Home.vue'),
                name: 'home',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: '/account',
                component: () => import('../Views/Account.vue'),
                name: 'account',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: '/blog',
                component: () => import('../Views/Blog.vue'),
                name: 'blog',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: '/cards',
                component: () => import('../Views/Cards.vue'),
                name: 'cards',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: '/settings',
                component: () => import('../Views/Settings.vue'),
                name: 'settings',
                meta:
                {
                    requiresAuth: true
                }
            },
            {
                path: '/session/:id',
                component: () => import('../Views/Session.vue'),
                name: 'session',
                props: castRouteParams({id: 'integer'}),
                meta:
                {
                    requiresAuth: true,
                    overflowDom: true
                },
                beforeEnter (to, from, next) {
                    let id = to.params.id;
                    // check if exists + ?auth
                    next();
                },
            },
            {
                path: '/offer/:id/:name',
                component: () => import('../Views/Offer.vue'),
                name: 'offer',
                props: castRouteParams({id: 'integer'}),
                meta:
                {
                    requiresAuth: true,
                }
            },
            {
                path: '/card/:id',
                component: () => import('../Views/Card.vue'),
                name: 'card',
                props: castRouteParams({id: 'integer'}),
                meta:
                {
                    requiresAuth: true,
                }
            }
        ]
    }
    
];
export default routes;