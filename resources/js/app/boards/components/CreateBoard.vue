<template>
    <modal :show="show" @close="close">

        <form role="form" @submit.prevent="submit">

            <div class="modal-header">
                <h3 class="modal-title">Create Board</h3>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Board Title</label>
                    <input v-model="form.title" id="title" class="form-control"/>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input v-model="form.private" type="checkbox" :true-value="1" :false-value="0" class="custom-control-input" id="private">
                        <label class="custom-control-label" for="private">Make Private</label>
                    </div>
                </div>
            </div>

            <div class="modal-footer text-right">
                <button class="btn btn-success" type="submit">Create</button>
                <button class="btn btn-danger" type="button" @click.prevent="close">Cancel</button>
            </div>

        </form>

    </modal>
</template>

<script>
    import Modal from '../../../components/Modal.vue';
    import {mapActions} from 'vuex'

    export default {
        components: {Modal},
        props: {
            show: {
                type: Boolean
            }
        },
        data: () => ({
            form: {
                title: '',
                private: 0
            },
            errors: []
        }),
        methods: {
            ...mapActions({
                createBoard: 'boards/createBoard'
            }),
            close() {
                this.$emit('close');
            },
            submit() {
                this.createBoard({
                    payload: this.form,
                    context: this
                }).then(() => {
                    this.close()
                })
            }
        }
    }
</script>
