<template>
    <transition name="modal">
        <div
            @click.stop="close"
            class="modal-mask modal-flex"
        >
            <div
                :class="container"
            >

                <!-- Header -->
                <header
                    class="md:flex header"
                >
                    <p class="modal-title">
                        {{ title }}
                    </p>

                    <i
                        class="fa fa-times x-icon"
                        @click="close"
                    />
                </header>

                <!-- Main content -->
                <component
                    :class="inner_container"
                    :is="innerComponent"
                />
            </div>
        </div>
    </transition>
</template>

<script>
import OptionsModal from "./OptionsModal";
import EditPostModal from "./EditPostModal";


export default {
    name: 'Modal',
    components: {
        OptionsModal,
        EditPostModal,
    },
    mounted () {
        // Close modal with 'esc' key
        document.addEventListener('keydown', (e) => {
            if (e.keyCode === 27)
            {
                this.close();
            }
        });
    },
    data () {
        return {
            btn: 'button is-medium is-primary',
            processing: false
        };
    },
    computed: {
        /**
         * Show spinner when processing
         */
        button ()
        {
            return this.processing ? this.btn + ' is-loading' : this.btn;
        },

        /**
         * What container class to return
         */
        container ()
        {
            // if (this.innerComponent === 'ModalMobileSpam')
            // {
            //     return 'modal-mobile-spam-container';
            // }

            return 'modal-container mobile-modal-container';
        },

        /**
         * What inner-modal-container class to show
         */
        inner_container ()
        {
            return 'inner-modal-container';
        },

        /**
         * Shortcut for modal.innerComponent
         */
        innerComponent ()
        {
            return this.$store.state.modal.innerComponent;
        },

        /**
         * Get the title for the modal
         */
        title ()
        {
            return this.$store.state.modal.title;
        }
    },
    methods: {
        /**
         * Action to dispatch when primary button is pressed
         */
        async action ()
        {
            this.processing = true;

            await this.$store.dispatch(this.$store.state.modal.action);

            this.processing = false;
        },

        /**
         * Making a commit to update show and set it to false and hide the modal;
         */
        close ()
        {
            this.$store.commit('hideModal');
        }
    }
}
</script>

<style>
.header {
    justify-content: center;
    align-items: baseline;
    border-bottom: 1px dashed #ccc;
    padding: 20px;
}


.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.modal-enter {
    opacity: 0;
}
.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    transform: scale(1.1);
}

.inner-modal-container {
    padding: 1em 2em;
}

.modal-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    display: inline-block;
    font-family: Helvetica, Arial, sans-serif;
    position: relative;
    margin: 30px auto;
    transition: all .3s ease;
    width: 585px;
}

.modal-flex {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/*.modal-header {*/
/*    margin-bottom: 1em;*/
/*    position: relative;*/
/*    text-align: center;*/
/*}*/

.modal-mask {
    background-color: rgba(0, 0, 0, .5);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-y: scroll;
    overflow-x: hidden;
    transition: opacity .3s ease;
    text-align: center;
    z-index: 1555;
}

.top-left {
    position: absolute;
    left: 2em;
}

.top-right {
    position: absolute;
    top: 0;
    right: 1em;
    padding: .3em;
    cursor: pointer;
    z-index: 9999;
}

.transparent-container {
    background-color: transparent;
    border-radius: 10px;
    box-shadow: none;
    display: inline-block;
    font-family: Helvetica, Arial, sans-serif;
    padding: 2.5em 0;
    position: relative;
    margin: 30px auto;
    transition: all .3s ease;
    width: 585px;

    /*@media (max-width: 700px) {*/
    /*    width: 80%;*/
    /*}*/
}

.modal-headerr {
    justify-content: center;
    align-items: baseline;
    border-bottom: 1px dashed #ccc;
}
.modal-title {
    margin-right: 3px;
    font-weight: 600;
    font-size: 20px;
}

.x-icon {
    position: absolute;
    right: 11px;
    top: 8px;
    cursor: pointer;
}



.info-title {
    color: #459ef5;
    cursor: pointer;
    margin-top: 1.75em;
}

@media only screen and (max-width: 600px)
{
    .mobile-only {
        padding-bottom: 0;
    }

    .inner-modal-container  {
        padding: 1em;
    }

    .transparent-container {
        padding: 15em 0 0 0;
        width: 100%;
    }
}
</style>
