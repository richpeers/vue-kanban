<template>
    <div class="board">
        <nav class="navbar navbar-expand-sm navbar-light fixed-top">
            <div class="container-fluid">
                <span class="navbar-brand text-white">{{board.title}}</span>
            </div>
        </nav>

        <columns :columns="board.columns"></columns>

    </div>

</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import Columns from "../../columns/components/Columns";

    export default {
        name: "Board",
        components: {Columns},
        props: {
            hashId: {
                type: String
            }
        },
        computed: {
            ...mapGetters({
                board: 'boards/getBoard'
            })
        },
        methods: {
            ...mapActions({
                fetchBoard: 'boards/fetchBoard',
                deleteBoard: 'boards/deleteBoard'
            })
        },
        created() {
            this.fetchBoard({
                payload: {hashId: this.hashId}
            })
        }
    }
</script>