<template>
    <div>
        <div>
            <main class="container mx-auto flex flex-column-mob">
                <div class="w-70 mx-auto">
                    <div class="bg-white md:sticky md:top-8 border-2 br4 mt-16 gradient">
                        <div class="text-center px-6 py-2 pt-6">
                            <h1 class="font-semibold text-base">
                                {{ this.$t('home.hello') }}
                            </h1>
                            <div>
                                <p class="text-sm mt-4">
                                    {{ this.$t('home.intro') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-175 padding-idea-on-mobile">
                    <div class="mt-16">
                        <div
                            v-for="post in posts"
                            :key="post.id"
                        >
                            <Post
                                :post="post"
                            />
                        </div>
                    </div>
                    <PaginationButtons
                        :current_page="this.$store.state.posts.paginated.current_page"
                        :next_page_url="this.$store.state.posts.paginated.next_page_url"
                        prev_page="PREVIOUS_IDEAS_PAGE"
                        next_page="NEXT_IDEAS_PAGE"
                    />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import Post from "./Post";
import PaginationButtons from "./PaginationButtons";
export default {
    name: "Home",
    components: {
        PaginationButtons,
        Post
    },

    async mounted()
    {
        await this.$store.dispatch('GET_PAGINATED_POSTS')
    },

    computed: {
        /**
         * Return paginated posts from vuex store
         */
        posts ()
        {
            return this.$store.state.posts.paginated.data;
        }
    },
    methods: {
        changeLang (lang)
        {
            this.$i18n.locale = lang;

            this.$localStorage.set('codewithsthef.lang', lang);
        }
    }

}
</script>

<style scoped>
    .container {
        width: 71%;
        padding-bottom: 28px;
    }

    .dark .bg-white {
        background: #211a2f;
    }

    .dark .gradient {
        border-image-source: linear-gradient(to bottom, rgb(68, 52, 103), rgba(42, 9, 15, 0));
        border-image-slice: 1;
        background-origin: border-box;
        background-clip: content-box, border-box;
    }

    .br4 {
        border-radius: 4px;
    }
</style>
