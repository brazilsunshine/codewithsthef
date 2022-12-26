<template>
    <div>
        <Nav />

        <BlogCoverPreviewModal v-show="this.$store.state.posts.blogPhotoPreview" />

        <Modal
            v-show="showModal"
        />

        <router-view />
    </div>
</template>

<script>
import Nav from './Nav'
import BlogCoverPreviewModal from "./BlogCoverPreviewModal";
import Modal from "./Modal";
export default {
    name: "RootContainer",
    components: {
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
    }
}
</script>

<style scoped>

</style>
