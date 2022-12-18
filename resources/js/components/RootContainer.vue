<template>
    <div>
        <Nav />

        <BlogCoverPreview v-show="this.$store.state.posts.blogPhotoPreview" />

        <router-view />
    </div>
</template>

<script>
import Nav from './Nav'
import BlogCoverPreview from "./BlogCoverPreview";
export default {
    name: "RootContainer",
    components: {
        BlogCoverPreview,
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
