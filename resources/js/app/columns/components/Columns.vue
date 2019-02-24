<template>
    <div class="columns">
        <column
                v-for="(column, index) in columns"
                :key="'column-' + index"
                :column="column"
        ></column>

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
            columns: {
                type: Array,
                default() {
                    return []
                }
            }
        },
        data: () => ({
            errors: []
        }),
        methods: {
            ...mapActions({
                deleteColumn: 'boards/deleteColumn'
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