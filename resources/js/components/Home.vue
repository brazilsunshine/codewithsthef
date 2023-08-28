<template>
    <div>
        <div v-if="loading">
            .
        </div>
        <div v-else>
            <main class="container mx-auto flex flex-column-mob">
                <div class="mx-auto w18mob" style="width: 24.5rem;">
                    <div class="bg md:sticky md:top-8 border-2 br4 mt-16 gradient">
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
                        <div :class="{invisible: !error}" class=" md:sticky error-message">
                            <p>{{ this.errorMsg }}</p>
                        </div>
                        <p v-if="errors[0]" class="error-message">
                            {{ this.errors }}
                        </p>
                        <!--  Date Picker-->
                        <div class="date-picker-container">
                            <h1 class="date-picker-title">
                                {{  this.$t('home.filter') }}
                            </h1>
                            <div class="date-picker">
                                <datepicker
                                    v-model="startDate"
                                    valueType="YYYY-MM-DD"
                                    format="DD-MM-YYYY"
                                />
                                <span style="margin: 3px">to</span>
                                <datepicker
                                    v-model="endDate"
                                    valueType="YYYY-MM-DD"
                                    format="DD-MM-YYYY"
                                />
                                <button @click="getFilteredPosts">
                                    Filter
                                </button>
                                <button v-if="filterButtonSelected" @click="clearDates">
                                    Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>  <!-- Intro section ends here -->
                <div class="w-full md:w-175 padding-idea-on-mobile">
                    <div class="mt-16">
                        <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">

                            <!-- FIND A POST BY TITLE -->
                            <div class="w-full md:w-2/3 relative">
                                <input
                                    v-model="postTitle"
                                    @keyup="searchTitle"
                                    placeholder="Type a title to find a post"
                                    class="w-full rounded-xl px-4 py-2 pl-8"
                                >
                                <div class="absolute top-0 flex items-center h-full ml-2">
                                    <i class="fas fa-search" />
                                </div>
                            </div><!-- END FIND POST BY TITLE -->

                            <!-- FIND A POST BY TAG -->
                            <div class="w-full md:w-2/3 relative">
                                <select
                                    v-model="selectedTag"
                                    @change="GET_POSTS_BY_TAG"
                                    class="w-full rounded-xl bg-transparent px-4 py-2"
                                >
                                    <option value="0">
                                        All tags
                                    </option>
                                    <option
                                        v-for="tag in tags"
                                        :key="tag.id"
                                    >
                                        {{ tag.name }}
                                    </option>
                                </select>
                            </div> <!-- FIND A POST BY TAG -->
                        </div>
                        <p v-if="noResults" class="mt-2" style="color: rgb(98, 114, 164);">
                            Sorry, looks like no posts were found.
                        </p>
                        <!-- POST SECTION HERE -->
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
                        prev_page="PREVIOUS_POSTS_PAGE"
                        next_page="NEXT_POSTS_PAGE"
                    />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import Post from "./Post";
import PaginationButtons from "./PaginationButtons";
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import _ from "lodash";

export default {
    name: "Home",
    components: {
        PaginationButtons,
        Post,
        DatePicker
    },
    data ()
    {
        return {
            loading: true,
            startDate: null,
            endDate: null,
            error: null,
            errorMsg: null,
            filterButtonSelected: false,
            postTitle: '',
            selectedTag: 0,
        }
    },
    async mounted()
    {
        /**
         * Dispatch action to get paginated posts
         */
        await this.$store.dispatch('GET_PAGINATED_POSTS');

        /**
         * GET TAGS
         */
        await this.$store.dispatch('GET_TAGS');

        this.loading = false;
    },

    computed: {
        /**
         * Return paginated posts from vuex store
         */
        posts ()
        {
            return this.$store.state.posts.paginated.data;
        },

        /**
         * Return all tags
         */
        tags ()
        {
            return this.$store.state.posts.tags;
        },

        /**
         * Return errors
         */
        errors ()
        {
            return this.$store.state.errors.errorsObject;
        },

        /**
         * Current locale
         */
        lang ()
        {
            return this.$i18n.locale;
        },

        /**
         *
         */
        noResults ()
        {
            return this.posts && this.posts.length === 0 && this.postTitle !== '';
        },
    },
    methods: {
        /**
         * Change current language
         */
        changeLang (lang)
        {
            this.$i18n.locale = lang;

            this.$localStorage.set('codewithsthef.lang', lang);
        },

        /**
         * Dispatch action to get filtered posts
         */
        async getFilteredPosts ()
        {
            if (this.startDate && this.endDate)
            {
                await this.$store.dispatch("GET_FILTERED_POSTS", {
                    startDate: this.startDate,
                    endDate: this.endDate,
                });

                this.filterButtonSelected = true;
            }
            else
            {
                this.error = true;
                this.errorMsg = this.$t('home.valid');
                setTimeout(() =>
                {
                    this.error = false
                }, 5000);
            }
        },

        /**
         * Clear dates
         */
       async clearDates ()
        {
            this.startDate = null;
            this.endDate = null;

            // get paginated posts
            await this.$store.dispatch('GET_PAGINATED_POSTS')

            this.filterButtonSelected = false;
        },

        /**
         * Make a get request to search for a Post when the user stops typing with debounce/lodash
         */
        searchTitle: _.debounce(function ()
        {
            this.$store.dispatch('SEARCH_POST_BY_TITLE', {
                postTitle: this.postTitle,
                lang: this.lang
            })
        }, 500), // time

        /**
         *
         */
        async GET_POSTS_BY_TAG()
        {
            if (this.selectedTag)
            {
                await axios.get('/api/posts-by-tag/', {
                    params: {
                        tag: this.selectedTag
                    }
                })
                .then(response => {
                    console.log('GET_POSTS_BY_TAG', response);

                    if (response.data.success)
                    {
                        this.$store.commit('setPaginatedPosts', response.data.posts)
                    }
                 })
                .catch(error => {
                    console.log('GET_POSTS_BY_TAG', error);
                });
            }
        }
    }
}
</script>

<style scoped>
    .dark .bg {
        background: #242333;
    }

    .dark .gradient {
        border-image-source: linear-gradient(to bottom, rgb(176, 132, 255), rgba(42, 9, 15, 0));
        border-image-slice: 1;
        background-origin: border-box;
        background-clip: content-box, border-box;
    }

    .dark .date-picker-container {
        padding: 20px;
        max-width: 400px;
        margin: 0 auto;
        background: #242333; /* Light pink background */
        border: 1px solid rgb(68, 52, 103); /* Pink border */
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dark .date-picker-title {
        color: #b084ff;
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
    }

    .dark .date-picker button {
        background-color: #b084ff; /* Pink button background */
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 7px;
        font-size: 14px;
        cursor: pointer;
        margin-left: 3px;
    }

    .dark .date-picker button:hover {
        background-color: #9360f3; /* Darker pink on hover */
    }

    .date-picker button {
        background-color: #f49ac2; /* Pink button background */
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 7px;
        font-size: 14px;
        cursor: pointer;
        margin-left: 3px;
    }


    .container {
        padding-bottom: 28px;
        width: 71%;
    }

    .br4 {
        border-radius: 4px;
    }

    .date-picker-container {
        padding: 20px;
        max-width: 400px;
        margin: 0 auto;
        background-color: #ffffff; /* Light pink background */
        border: 1px solid #f49ac2; /* Pink border */
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .date-picker-title {
        color: #f49ac2; /* Pink title color */
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
    }

    .date-picker {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .date-picker button:hover {
        background-color: #f26dbb; /* Darker pink on hover */
    }

    /* Customize the datepicker letters style */
    .vue-datepicker td {
        color: #333;
    }

    .vue-datepicker .is-selected {
        background-color: #f26dbb; /* Darker pink for selected date */
        color: white;
    }

    .vue-datepicker th {
        color: #f49ac2; /* Pink header text */
        font-weight: bold;
    }

    /* Error Styling */
    .invisible {
        opacity: 0 !important;
    }

    .error-message {
        width: 100%;
        padding: 12px;
        color: #fff;
        background-color: darkred;
        opacity: 1;
        transition: .5s ease all;
    }

    input:focus:nth-child(1) {
        outline: none;
        --tw-ring-shadow: none;
        border-color: inherit;
        -webkit-box-shadow: none;
    }

    select:focus:nth-child(1) {
        outline: none;
        --tw-ring-shadow: none;
        border-color: inherit;
        -webkit-box-shadow: none;
    }

    .dark select {
        outline: none;
        --tw-ring-shadow: none;
        border-color: #b084ff;
        -webkit-box-shadow: none;
    }


    input {
        transition: .5s ease-in-out all;
        border: none;
        border-bottom: 1px solid #303030;
    }

    .dark input {
        transition: .5s ease-in-out all;
        border: none;
        border-bottom: 1px solid #b084ff; ;
        background: transparent;
    }

    input:nth-child(2) {
        opacity: 0;
        max-width: 165px;
        position: absolute;
        left: 313px;
        top: 152px;

    }
</style>
