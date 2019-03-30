<template>
    <div class="column-wrapper create-column-wrapper">
        <div class="column" :class="{'create-column': !showForm}">

            <form v-if="showForm" role=form class="create-column-form" @submit.prevent="submit">

                <input class="form-control form-control-sm" v-model="title" ref="title" placeholder="Enter Column Name">

                <button type="submit" class="btn btn-success btn-sm mr-1">Add</button>
                <button type="button" class="btn btn-danger btn-sm" @click.prevent="showForm = false">Cancel</button>

            </form>

            <div v-else class="btn btn-primary btn-block" @click="edit">
                Add Column
            </div>
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