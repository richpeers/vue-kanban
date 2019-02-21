<template>
    <div>
        <p class="mt-5">{{ index }}</p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                index: null
            }
        },
        mounted() {
            axios.get('/api/posts').then((response) => {
                this.index = response.data.data
            })
        }
    }
</script>