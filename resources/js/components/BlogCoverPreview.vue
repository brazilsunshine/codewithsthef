<template>
    <div class="modal" ref="modal">
        <div class="modal-content">
            <i
                @click="closePreview"
                class="icon fa-solid fa-x"
            />
            <img :src="this.blogCoverPhoto" alt="" />
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogCoverPreview",
    computed: {
        blogCoverPhoto ()
        {
            return this.$store.state.posts.blogPhotoFileURL;
        },
    },
    methods: {
        closePreview ()
        {
            this.$store.commit("openOrClosePhotoPreview")
        },
    },

}
</script>

<style scoped>

.modal {
    top: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 99;
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}

.modal-content {
    display: flex;
    justify-content: center;
    position: relative;
    border-radius: 12px;
    background-color: #fff;
    height: 60%;
    width: 38%;
    padding: 24px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.6);
}

.icon {
    width: 24px;
    height: auto;
    cursor: pointer;
    font-size: 13px;
    position: absolute;
    top: 9px;
    right: -5px;
    color: #303030;
}

img {
    display: block;
    width: auto;
    height: 100%;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.6);
}


</style>
