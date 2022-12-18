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
        this.$store.commit('resetState');
    }
}
</script>

<style scoped>

</style>
