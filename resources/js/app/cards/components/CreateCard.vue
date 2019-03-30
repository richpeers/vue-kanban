<template>
    <div class="create-card" :class="{'create-card': !showForm}">

        <form v-if="showForm" role=form class="create-card-form" @submit.prevent="submit">

            <div class="can-card">
                <textarea class="form-control mb-3" v-model="title" rows="3" ref="title" placeholder="Enter card name .."></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-sm mr-1">Add</button>
            <button type="button" class="btn btn-danger btn-sm" @click.prevent="showForm = false">Cancel</button>
        </form>

        <a v-else href="#" class="ml-2" @click.prevent="edit">
            Add a card ..
        </a>

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
                this.$nextTick(() => {
                    this.$emit('scroll-down');
                    this.$refs.title.focus()
                })
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