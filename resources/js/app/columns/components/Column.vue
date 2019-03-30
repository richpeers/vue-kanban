<template>
    <div class="column-wrapper">
        <div class="column">

            <div class="column-title">
                <span>{{value.title}}</span>
                <div class="column-menu">
                    <i @click="archiveColumn" class="fas fa-ban fa-lg"></i>
                </div>
            </div>

            <div class="column-scroll-wrapper">
                <div class="column-scroll" ref="scroll">
                    <draggable
                            v-model="cards"
                            group="cards"
                            @start="startDrag"
                            @end="endDrag"
                            ghostClass="card-sortable-ghost"
                            dragClass="card-sortable-drag"
                    >
                        <card v-for="(card, index) in cards"
                              :key="'columns-' + value.id + '-cards-' + card.id"
                              v-model="cards[index]"
                              @edit-card="editCard(index)"
                        ></card>
                    </draggable>

                    <create-card
                            :column-id="value.id"
                            :card-count="cardCount"
                            @scroll-down="scrollDown"
                    ></create-card>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Card from "../../cards/components/Card";
    import CreateCard from "../../cards/components/CreateCard";
    import {mapActions, mapMutations} from 'vuex';

    export default {
        name: "Column",
        components: {CreateCard, Card},
        props: {
            value: {
                type: Object,
                default: {}
            },
            index: {
                type: Number
            }
        },
        data: () => ({
            drag: false,
            editCardData: {
                index: null,
                show: false
            }
        }),
        computed: {
            cards: {
                get() {
                    return this.value.cards
                }
                ,
                set(value) {
                    this.orderCards({index: this.index, value});
                }
            }
            ,
            cardCount() {
                if (!this.value.cards) {
                    return 0
                }
                return this.value.cards.length
            }
        }
        ,
        methods: {
            ...
                mapActions({
                    deleteColumn: 'boards/deleteColumn',
                    orderColumns: 'boards/orderColumns'
                }),
            ...
                mapMutations({
                    orderCards: 'boards/orderCards'
                }),
            startDrag() {
                this.drag = true;
                let element = document.getElementsByTagName('html')[0];
                element.classList.add('draggable-cursor');
            }
            ,
            endDrag() {
                this.drag = false;

                let element = document.getElementsByTagName('html')[0];
                element.classList.remove('draggable-cursor');

                this.$nextTick(function () {
                    this.orderColumns({
                        payload: {board_id: this.$store.state.boards.board.id, value: this.$store.state.boards.board.columns}
                    })
                });
            }
            ,
            scrollDown() {
                let container = this.$refs.scroll;
                container.scrollTop = container.scrollHeight;
            }
            ,
            archiveColumn() {
                this.deleteColumn({
                    payload: {
                        'id': this.value.id
                    }
                })
            }
        }
    }
</script>