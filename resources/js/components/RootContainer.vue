<template>
    <div :class="(mode === 'dark') ? 'dark' : ''">
        <Nav :mode="mode" @toggle="toggle" />

        <BlogCoverPreviewModal v-show="this.$store.state.posts.blogPhotoPreview" />

        <Modal
            v-show="showModal"
        />

        <router-view />

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
        if (this.$localStorage.get('codewithsthef.lang'))
        {
            this.$i18n.locale = this.$localStorage.get('codewithsthef.lang');
        }

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
