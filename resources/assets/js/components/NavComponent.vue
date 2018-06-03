<template>
    <div class="top-right links">
        <router-link :to="{ name: 'login' }" v-if="vars.loggedIn === false">Login</router-link>
        <router-link :to="{ name: 'register'}" v-if="vars.loggedIn === false">Register</router-link>

        <router-link :to="{ name: 'logout' }" v-if="vars.loggedIn === true">Logout</router-link>
    </div>
</template>

<script>
    import store from '../store'

    var vars = {
        loggedIn : false
    }

    export default {
        data() {
            return {
               vars
            }
        },
        mounted() {
            vars.loggedIn = store.state.isLoggedIn;
        }
    }
</script>