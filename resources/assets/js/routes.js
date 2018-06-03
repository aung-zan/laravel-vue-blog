import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import store from './store'
import HomeComponent from './components/HomeComponent'
import LoginComponent from './components/LoginComponent'
import RegisterComponent from './components/RegisterComponent'
import DashboardComponent from './components/DashboardComponent'
import LogoutComponent from './components/LogoutComponent'

const routes = [
    {
        path        : '/',
        redirect    : { name: 'home' }
    },
    {
        path        : '/home',
        name        : 'home',
        component   : HomeComponent,
    },
    {
        path        : '/login',
        name        : 'login',
        component   : LoginComponent,
    },
    {
        path        : '/register',
        name        : 'register',
        component   : RegisterComponent,
    },
    {
        path        : '/dashboard',
        name        : 'dashboard',
        component   : DashboardComponent,
        meta        : { requiresAuth: true }
    },
    {
        path        : '/logout',
        name        : 'logout',
        component   : LogoutComponent,
        meta        : { requiresAuth: true }
    },
]

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'login' })
        return
    }

    // if logged in redirect to dashboard
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'dashboard' })
        return
    }

    next()
});

export default router