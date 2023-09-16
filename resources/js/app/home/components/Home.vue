<template>
    <div class="banner">
        <div class="banner-progress">
            <video controls muted autoplay loop poster="/img/progress.png">
                <source src="/img/rec.mp4" type="video/mp4" />
            </video>
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
