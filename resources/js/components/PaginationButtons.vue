<template>
    <div>
        <div class="text-center">
            <!--  PREVIOUS PAGE  -->
            <button
                v-show="this.current_page > 1"
                @click="previousPage"
                class="previous-btn"
            >
                Previous Page
            </button>

            <!--  NEXT PAGE  -->
            <button
                v-show="this.next_page_url"
                @click="nextPage"
                class="next-btn"
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
        },
    }
}
</script>

<style scoped>
    .previous-btn {
        width: 11rem;
        background-color: rgba(229, 229, 229, 0.99);
        color: black;
        border-width: 1px;
        border-color: rgb(229 229 229 / var(--tw-border-opacity));
        transition-property: border;
        transition-duration: 150ms;
        transition-timing-function: ease-in;
        font-weight: 600;
        font-size: 12px;
        border-radius: 16px;
        padding: 0.75em 1em;
    }

    .previous-btn:hover {
        border-width: 1px;
        --tw-border-opacity: 1;
        border-color: rgb(163 163 163 / var(--tw-border-opacity));
    }

    .next-btn {
        width: 11rem;
        background-color: rgb(174 80 134);
        color: #FFFFFF;
        border: none;
        transition-property: background-color;
        transition-duration: 150ms;
        transition-timing-function: ease-in;
        font-weight: 600;
        font-size: 12px;
        border-radius: 16px;
        padding: 0.75em 1em;
    }

    .next-btn:hover {
        background-color: rgb(159 71 136 / 84%);
    }

    .dark .previous-btn {
        width: 11rem;
        background-color: rgba(229, 229, 229, 0.99);
        color: black;
        border-width: 1px;
        border-color: rgb(229 229 229 / var(--tw-border-opacity));
        transition-property: border;
        transition-duration: 150ms;
        transition-timing-function: ease-in;
        font-weight: 600;
        font-size: 12px;
        border-radius: 16px;
        padding: 0.75em 1em;
    }

    .dark .previous-btn:hover {
        background-color: #d7dbdd;
    }

    .dark .next-btn {
        width: 11rem;
        background-color: #614385;
        color: #FFFFFF;
        border: none;
        transition-property: background-color;
        transition-duration: 150ms;
        transition-timing-function: ease-in;
        font-weight: 600;
        font-size: 12px;
        border-radius: 16px;
        padding: 0.75em 1em;
    }

    .dark .next-btn:hover {
        background-color: rgba(97,67,133,0.69);
    }

</style>
