<template>
    <div
        :class="(mode === 'dark') ? 'dark' : ''"
        style="display: grid; flex: auto;"
    >

        <Nav :mode="mode" @toggle="toggle" />

        <div >

            <BlogCoverPreviewModal
                v-show="this.$store.state.posts.blogPhotoPreview"
            />

            <Modal
                v-show="showModal"
            />

            <router-view />
        </div>

        <Footer />

    </div>
</template>

<script>
import Nav from './Nav'
import BlogCoverPreviewModal from "./BlogCoverPreviewModal";
import Modal from "./Modal";
import Footer from "./Footer";
export default {
    name: "RootContainer",
    data()
    {
        return {
            mode: 'dark',
        }
    },

    components: {
        Footer,
        Modal,
        BlogCoverPreviewModal,
        Nav
    },
    async mounted ()
    {
        /**
         * Get current language from localStorage
         */
        if (this.$localStorage.get('lang'))
        {
            this.$i18n.locale = this.$localStorage.get('lang');
        }

        /**
         * Get current theme from localStorage
         */
        if (this.$localStorage.get('theme'))
        {
            this.mode = this.$localStorage.get('theme');
        }

        /**
         * Reset the state to not be saved in the localstorage
         */
        this.$store.commit('resetState');

        /**
         * Check auth on the backend before doing anything else
         */
        await this.$store.dispatch('CHECK_AUTH');
    },

    computed: {
        /**
         * Return True to show the modal
         */
        showModal ()
        {
            return this.$store.state.modal.show;
        }
    },

    methods: {
        toggle ()
        {
            if (this.mode === "dark")
            {
                this.mode = "light"
            }
            else
            {
                this.mode = "dark"
            }

            this.$localStorage.set('theme', this.mode);
        }
    },
}
</script>

<style scoped>
    * {
        transition: background 0.3s ease-in-out;
    }

    .dark {
        background: #242333;
        color: white;
    }
</style>
