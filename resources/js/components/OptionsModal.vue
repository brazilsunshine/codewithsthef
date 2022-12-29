<template>
    <div>
        <ul>
            <li>
                <a
                    @click.stop="loadEditPostModal"
                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3 pointer"
                >
                    Edit Post
                </a>
            </li>
            <li>
                <a
                    @click.stop="loadDeletePostModal"
                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3 pointer"
                >
                    Delete Post
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "OptionsModal",
    methods: {
        /**
         * Load EditPostModal.vue
         */
        loadEditPostModal ()
        {
            this.$store.commit('showModal', {
                title: 'Edit Post',
                innerComponent: 'EditPostModal'
            })
        },

        /**
         * Load DeletePostModal.vue
         */
        loadDeletePostModal ()
        {
            this.$store.commit('showModal', {
                title: 'Delete post',
                innerComponent: 'DeletePostModal'
            })
        }
    }
}
</script>

<style scoped>

</style>
