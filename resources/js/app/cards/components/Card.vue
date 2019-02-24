<template>
    <div class="can-card">
        <div class="can-card-title">
            {{card.title}}
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex';

    export default {
        name: "Card",
        props: {
            card: {
                type: Object,
                default() {
                    return {}
                }
            }
        },
        data: () => ({})
    }
</script>