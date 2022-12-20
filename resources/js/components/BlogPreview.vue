<template>
    <div class="post-view pl-50-mob">
        <div class="container quillWrapper">
            <h2>
                {{ this.blogTitle }}
            </h2>
            <img :src="blogCoverPhoto" alt="" />
            <div class="post-content" v-html="blogHTML">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogPreview",
    computed: {
        blogTitle ()
        {
            return this.$store.state.posts.blogTitle;
        },
        blogCoverPhoto ()
        {
            return this.$store.state.posts.blogPhotoFileURL;
        },
        blogHTML ()
        {
            return this.$store.state.posts.blogHTML;
        },
    },
}
</script>

<style scoped>
    .post-view {
        display: flex;
        min-height: 100%;
        justify-content: center;
        width: 130%;
    }

    .container {
        max-width: 1000px;
    }

    .ql-editor {
        padding: 0;
    }

    h2 {
        margin: 30px 0;
        font-weight: 300;
        font-size: 32px;
    }

    img {
        width: 50%;
        margin-bottom: 32px;
    }




</style>
