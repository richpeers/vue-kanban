<template>
    <div class="board">
        <div class="board-nav">
            <span>{{board.title}}</span>
        </div>


        <columns :value="board.columns"></columns>

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