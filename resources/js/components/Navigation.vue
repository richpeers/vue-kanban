<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
        <div class="container-fluid">

            <router-link :to="{name: 'home'}" class="navbar-brand">
                <span class="nmc-circle">
                    <i class="fas fa-ban text-danger"></i>
                </span>
                NoMoreCans
            </router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul v-if="!user.authenticated" class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link :to="{ name: 'login' }" class="nav-link">Login</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link :to="{ name: 'register' }" class="nav-link">Register</router-link>
                    </li>
                </ul>

                <ul v-if="user.authenticated" class="navbar-nav">
                    <li>
                        <router-link :to="{name: 'dashboard', params: {hashId: user.data.hashId}}" class="nav-link">Boards</router-link>
                    </li>

                    <li>
                        <a href="#" @click.prevent="signout" class="nav-link">Logout</a>
                    </li>
                    <!--<li class="nav-item dropdown">-->
                    <!--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--{{ user.data.name }} <span class="caret"></span>-->
                    <!--</a>-->

                    <!--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">-->

                    <!--<a href="#" @click.prevent="signout" class="dropdown-item">Logout</a>-->
                    <!--</div>-->
                    <!--</li>-->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                user: 'auth/user'
            }),
            brandLink() {
                return this.user.authenticated ? {name: 'dashboard', params: {hashId: this.user.data.hashId}} : {name: 'home'}
            }
        },
        methods: {
            ...mapActions({
                logout: 'auth/logout'
            }),
            signout() {
                this.logout().then(() => {
                    this.$router.replace({name: 'home'})
                })
            }
        }
    }
</script>
