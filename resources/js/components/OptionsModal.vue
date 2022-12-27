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
                    href="#"
                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
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
        loadEditPostModal ()
        {
            this.$store.commit('showModal', {
                title: 'Edit Post',
                innerComponent: 'EditPostModal'
            })
        }
    }
}
</script>

<style scoped>

</style>
