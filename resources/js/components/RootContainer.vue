<template>
    <div>
        <Nav />

        <BlogCoverPreviewModal v-show="this.$store.state.posts.blogPhotoPreview" />

        <router-view />
    </div>
</template>

<script>
import Nav from './Nav'
import BlogCoverPreviewModal from "./BlogCoverPreviewModal";
export default {
    name: "RootContainer",
    components: {
        BlogCoverPreviewModal,
        Nav
    },
    async mounted ()
    {
        /**
         * Reset the state to not be saved in the localstorage
         */
        this.$store.commit('resetState');

        /**
         * Check auth on the backend before doing anything else
         */
        await this.$store.dispatch('CHECK_AUTH');
    }
}
</script>

<style scoped>

</style>
