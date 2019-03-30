<template>
    <div class="columns">
        <draggable
                v-model="columns"
                handle=".column-title"
                :forceFallback="forceFallback"
                ghostClass="column-sortable-ghost"
                dragClass="column-sortable-drag"
        >
            <column
                    v-for="(column, index) in columns"
                    :key="'columns-' + index"
                    :index="index"
                    v-model="columns[index]"
            ></column>
        </draggable>

        <create-column></create-column>

    </div>
</template>

<script>
    import Column from './Column';
    import {mapActions} from 'vuex';
    import CreateColumn from "./CreateColumn";

    export default {
        name: "Columns",
        components: {CreateColumn, Column},
        props: {
            value: {
                type: Array,
                default() {
                    return []
                }
            }
        },
        data: () => ({
            errors: []
        }),
        computed: {
            forceFallback() {
                return !!window.navigator.userAgent.match(/firefox/i);
            },
            columns: {
                get() {
                    return this.value
                },
                set(value) {
                    let boardId = this.$store.state.boards.board.id;

                    this.orderColumns({
                        payload: {board_id: boardId, value}
                    })

                }
            }
        },
        methods: {
            ...mapActions({
                deleteColumn: 'boards/deleteColumn',
                orderColumns: 'boards/orderColumns'
            }),
            addColumn() {
                this.createColumn({
                    payload: this.form,
                    context: this
                }).then(() => {
                    this.close()
                })
            }
        }
    }
</script>