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
                    @edit-card="editCard"
            ></column>
        </draggable>

        <create-column></create-column>

        <edit-card
                v-if="editCardData.show"
                :show="editCardData.show"
                :value="columns[editCardData.columnIndex].cards[editCardData.cardIndex]"
        ></edit-card>
    </div>
</template>

<script>
    import Column from './Column';
    import {mapActions} from 'vuex';
    import CreateColumn from "./CreateColumn";
    import EditCard from "../../cards/components/EditCard";

    export default {
        name: "Columns",
        components: {EditCard, CreateColumn, Column},
        props: {
            value: {
                type: Array,
                default() {
                    return []
                }
            }
        },
        data: () => ({
            errors: [],
            editCardData: {
                columnIndex: null,
                cardIndex: null,
                show: false
            }
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
            editCard(params) {
                this.$set(this.editCardData, 'columnIndex', params.columnIndex);
                this.$set(this.editCardData, 'cardIndex', params.cardIndex);
                this.$set(this.editCardData, 'show', true);
            },
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