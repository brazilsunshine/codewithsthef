<template>
    <div class="container-mob">
        <div class="mt-3">
            <a
                href="/"
                class="flex items-center font-semibold hover:underline pointer"
            >
                <i class="fas fa-chevron-left"></i>
                <span class="ml-2">
                    All posts
                </span>
            </a>
        </div>
        <div>
            <div>
                <p
                    class="text-lg font-semibold"
                    style="text-align: center; margin-top: 1em;"
                >
                    {{ getTitle }}
                </p>
            </div>
            <div class="cover-photo">
                <img :src="post.cover_photo" class="cover-photo-mob" alt=""/>
            </div>
            <div v-if="auth && is('admin')">
                <button
                    @click.stop="toggleOptionsModal"
                    class="relative bg-gray-100 hover:bg-gray-200 rounded-full
                            h-7 transition duration-150 ease-in px-3 mt30-mob"
                >
                    <i class="fas fa-plus in-button"></i>
                </button>
            </div>



            <div class="mb-4">
                <div
                    class="flex views-mob"
                    style="width: 6%; margin: 9px 48%; color: cornflowerblue;"
                >
                    <p class="text-sm">
                        {{ post.view_count }} views
                    </p>
                    <i class="far fa-eye" />
                </div>
                <p
                    class="description description-mob"
                    v-html="getDescription"
                >
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostShow",
    computed: {
        /**
         * Return the authenticated user
         */
        auth () {
            return this.$store.state.user.auth;
        },

        /**
         * get slug from routes.js
         */
        slug ()
        {
            return this.$route.params.slug;
        },

        /**
         * get current lang from routes.js
         */
        lang ()
        {
            return this.$route.params.lang;
        },

        /**
         * Get post from vuex
         */
        post ()
        {
            return this.$store.state.posts.post;
        },

        /**
         * Get the title with the current language. ex: this.post.title_pt or this.post.title_en
         */
        getTitle ()
        {
            return this.post['title_' + this.$i18n.locale];
        },

        /**
         * Get the title with the current language. ex: this.post.description_pt or this.post.description_en
         */
        getDescription ()
        {
            return this.post['description_' + this.$i18n.locale];
        },
    },

    methods: {
        /**
         * Making a commit to make this post available in Vuex so I can use on others components
         *
         * Making a commit to update show and set it to true and hide show the modal;
         */
        toggleOptionsModal ()
        {
            this.$store.commit('setPost', this.post);

            this.$store.commit('showModal', {
                innerComponent: 'OptionsModal', // inner component is the component 'inside the model'
                title: 'Options'
            });
        },
    }
}
</script>

<style scoped>
    i {
        padding: 2px 4px;
        color: cornflowerblue;
    }

    .description {
        width: 50%;
        text-align: center;
        margin: 0 auto;
    }

    .p3em {
        padding: 3em;
    }

    img {
        max-width: 55%;
        height: auto;
        border-radius: 20px;
    }

    .cover-photo {
        display: flex;
        justify-content: center;
        padding-top: 25px;
    }

    .read-more-btn {
        margin-top: 1em;
        background-image: linear-gradient(to right, rgba(100, 9, 76, 0.87) 0%, rgb(255, 121, 198) 51%, rgba(100, 9, 76, 0.87) 100%);
        font-size: 14px;
        cursor: pointer;
        border-radius: 20px;
        padding: 12px 24px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
    }

    .read-more-btn:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    .dark .read-more-btn {
        margin-top: 1em;
        background-image: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
        font-size: 14px;
        cursor: pointer;
        border-radius: 20px;
        padding: 12px 24px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
    }

    .dark .read-more-btn:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    @media screen and (max-width: 687px) {
        .description-mob {
            width: 100%;
            text-align: center !important;
        }

        .views-mob {
            width: auto !important;
            margin: auto !important;
            padding: 1em;
        }

        .container-mob {
            margin: 0;
            width: 100% !important;
            padding: 1em !important;
        }
    }
</style>
