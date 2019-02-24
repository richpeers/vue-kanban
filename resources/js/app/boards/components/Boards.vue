<template>
    <div class="boards">

        <div v-for="board in boards" class="card border-info" @click="editBoard(board.hashId)">
            <div class="card-body text-info">
                <span>{{board.title}}</span>
            </div>
        </div>

        <div class="card border-success" @click="showCreateBoard = true">
            <div class="card-body text-success">
                Create Board
            </div>
        </div>

        <create-board
                v-if="showCreateBoard"
                :show="showCreateBoard"
                @close="showCreateBoard = false"
        ></create-board>

    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'

    export default {
        name: "Boards",
        data: () => ({
            showCreateBoard: false
        }),
        computed: {
            ...mapGetters({
                boards: 'boards/getBoards'
            })
        },
        methods: {
            ...mapActions({
                fetchBoards: 'boards/fetchBoards',
                createBoard: 'boards/createBoard',
                deleteBoard: 'boards/deleteBoard'
            }),
            editBoard(hashId) {
                this.$router.push({name: 'board', params: {hashId}})
            }
        },

        created() {
            this.fetchBoards();
        }
    }
</script>
