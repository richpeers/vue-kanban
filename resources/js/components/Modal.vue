<template>
    <transition name="modal">
        <div class="modal-mask" @click="clickAway" v-show="show">
            <div class="modal-container":class="{'full-height': fullHeight}" @click.stop>
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            'show': {
                default: false,
            },
            'canClickAway': {
                default: true,
            },
            'fullHeight': {
                type: Boolean,
                default() {
                    return false
                }
            }
        },
        methods: {
            close: function () {
                this.$emit('close');
            }
            ,
            clickAway: function () {
                if (this.canClickAway === true) {
                    this.close();
                }
            }
        },
        mounted: function () {
            if (this.canClickAway === true) {
                document.addEventListener("keydown", (e) => {
                    if (this.show && e.keyCode === 27) {
                        this.close();
                    }
                });
            }
        }
    }
</script>
