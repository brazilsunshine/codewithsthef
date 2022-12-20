<template>
    <div>
        <div class="text-center">
            <!--  PREVIOUS PAGE  -->
            <button
                v-show="this.current_page > 1"
                @click="previousPage"
                class="w-44 bg-gray-200 border border-gray-200 hover:border-gray-400
                          font-semibold text-xs rounded-xl transition duration-150 ease-in px-4 py-3"
            >
                Previous Page
            </button>

            <!--  NEXT PAGE  -->
            <button
                v-show="this.next_page_url"
                @click="nextPage"
                class="w-44 bg-blue text-white border border-gray-200 hover:bg-blue-hover
                          font-semibold text-xs rounded-xl transition duration-150 ease-in px-4 py-3"
            >
                Next Page
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "PaginationButtons",
    props: [
        // data
        'current_page', // current_page = this.$store.state.ideas.paginated.current_page
        'next_page_url', // next_page_url = this.$store.state.ideas.paginated.next_page_url

        // actions
        'prev_page',
        'next_page'
    ],
    methods: {
        /**
         * Load the previous page of data
         */
        previousPage () // only show this button is this.current_page is bigger than 1
        {
            this.$store.dispatch(this.prev_page);
        },
        /**
         * Load the next page of data
         */
        nextPage ()
        {
            this.$store.dispatch(this.next_page);
        }
    }
}
</script>

<style scoped>

</style>
