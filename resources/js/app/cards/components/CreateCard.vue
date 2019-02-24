<template>
    <div class="can-card" :class="{'create-card': !showForm}">

        <form v-if="showForm" role=form class="create-column-form" @submit.prevent="submit">
            <textarea class="form-control mb-3" v-model="title" rows="5" ref="title" placeholder="Enter Card Name"></textarea>
            <button type="submit" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-danger" @click.prevent="showForm = false">Cancel</button>
        </form>

        <button v-else class="btn-primary btn-block" type="button" @click="edit">
            Add Card
        </button>

    </div>
</template>

<script>
    import {mapActions} from 'vuex';

    export default {
        name: "CreateCard",
        props: {
            columnId: {
                type: Number
            },
            cardCount: {
                type: Number
            }
        },
        data: () => ({
            title: '',
            showForm: false
        }),
        methods: {
            ...mapActions({
                createCard: 'boards/createCard',
            }),
            edit() {
                this.showForm = true;
                this.$nextTick(() => this.$refs.title.focus())
            },
            submit() {
                this.createCard({
                    payload: {
                        'title': this.title,
                        'column_id': this.columnId,
                        'order': this.cardCount + 1,
                    },
                    context: this
                }).then(() => {
                    this.title = '';
                    this.showForm = false;
                })
            }
        }
    }
</script>