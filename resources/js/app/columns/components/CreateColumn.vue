<template>
    <div class="column-wrapper">
        <div class="column" :class="{'create-column': !showForm}">

            <form v-if="showForm" role=form class="create-column-form" @submit.prevent="submit">

                <input class="form-control mb-3" v-model="title" ref="title" placeholder="Enter Column Name">

                <button type="submit" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-danger" @click.prevent="showForm = false">Cancel</button>

            </form>

            <button v-else class="btn-primary btn-lg btn-block" type="button" @click="edit">
                Add Column
            </button>
        </div>
    </div>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "CreateColumn",
        data: () => ({
            title: '',
            showForm: false
        }),
        methods: {
            ...mapActions({
                createColumn: 'boards/createColumn',
            }),
            edit() {
                this.showForm = true;
                this.$nextTick(() => this.$refs.title.focus())
            },
            submit() {
                this.createColumn({
                    payload: {title: this.title},
                    context: this
                }).then(() => {
                    this.title = '';
                    this.showForm = false;
                })
            }
        }
    }
</script>