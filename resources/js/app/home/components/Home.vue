<template>
    <div class="banner">
        <div class="banner-progress"></div>

        <div v-if="!user.authenticated" class="home-register">
            <router-link :to="{ name: 'login' }" class="btn btn-lg btn-primary mr-4">Login</router-link>
            <router-link :to="{ name: 'register' }" class="btn btn-lg btn-primary">Register</router-link>
        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                user: 'auth/user'
            })
        }
    }
</script>
