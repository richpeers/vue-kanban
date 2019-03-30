<template>
    <div class="can-card-wrapper" @click="editCard">
        <div class="can-card">
            <div class="can-card-title">
                {{value.title}}
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex';

    export default {
        name: "Card",
        props: {
            value: {
                type: Object,
                default() {
                    return {}
                }
            }
        },
        data: () => ({}),
        computed: {
            card: {
                get() {
                    return this.value
                },
                set(value) {
                    this.$emit('input', value)
                }
            }
        },
        methods: {
            editCard() {
                this.$emit('edit-card')
            }
        }
    }
</script>