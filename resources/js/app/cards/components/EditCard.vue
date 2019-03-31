<template>
    <modal :show="show" @close="close">

        <div class="edit-card">

            <div class="modal-header">
                <h3 class="modal-title">Edit Card</h3>
            </div>

            <div class="modal-body">
                card details
            </div>

        </div>

    </modal>
</template>

<script>
    import Modal from '../../../components/Modal.vue';

    export default {
        components: {Modal},
        props: {
            show: {
                type: Boolean
            },
            value: {
                type: Object
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
            close() {
                this.$emit('close');
            }
        }
    }
</script>
