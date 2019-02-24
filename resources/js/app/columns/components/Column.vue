<template>
    <div class="column-wrapper">
        <div class="column">

            <div class="column-title">
                {{column.title}}
                <div class="column-menu">
                    <i class="fas fa-ban fa-lg"></i>
                </div>
            </div>

            <card v-for="(card, index) in column.cards"
                  :key="'column-' + column.id + '-card-' + card.id"
                  :card="card"
            ></card>

            <create-card :column-id="column.id" :card-count="cardCount"></create-card>

        </div>

    </div>
</template>

<script>
    import Card from "../../cards/components/Card";
    import CreateCard from "../../cards/components/CreateCard";

    export default {
        name: "Column",
        components: {CreateCard, Card},
        props: {
            column: {
                type: Object,
                default: {}
            }
        },
        computed: {
            cardCount() {
                if (!this.column.cards) {
                    return 0
                }
                return this.column.cards.length
            }
        }
    }
</script>