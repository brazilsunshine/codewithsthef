<template>
    <div>
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v3.75m-9.303 3.376C1.83 19.126 2.914 21 4.645 21h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 4.88c-.866-1.501-3.032-1.501-3.898 0L2.697 17.626zM12 17.25h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to delete your post? This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button @click="deletePost" type="button" class="inline-flex w-full justify-center rounded-md border border-transparent bg-red px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                    Delete
                </button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>

    </div>
</template>

<script>
import Vue from "vue";

export default {
    name: "DeletePostModal",
    computed: {
        /**
         * Return the post from Post.vue
         */
        post ()
        {
            return this.$store.state.posts.post;
        },
    },
    methods: {
        /**
         * Delete post on the backend
         */
        async deletePost ()
        {
            await axios.post('/api/posts/delete-post', {
                postId: this.post.id
            })

            .then(response => {
                console.log('delete-post', response);

                if (response.data.success)
                {
                    Vue.$vToastify.success("You deleted your post! =)");

                    window.location.href = "/"
                }
             })
            .catch(error => {
                console.log('delete-post', error);
            });
        },
    },
}
</script>

<style scoped>

</style>
