<template>
    <div class="p30">
        <div>
            <p class="text-lg font-semibold" style="text-align: center;">
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
                <i class="fa-solid fa-ellipsis in-button"></i>
            </button>
        </div>

        <div class="text-sm">
            <div>
                <p
                    class="padding-top"
                    v-html="getDescription"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",
    props: [
        'post'
    ],
    computed: {
        /**
         * Return the authenticated user
         */
        auth () {
            return this.$store.state.user.auth;
        },

        /**
         * Get the title with the current language. ex: this.post.title_pt or this.post.title_en
         */
        getTitle()
        {
            return this.post['title_' + this.$i18n.locale];
        },

        /**
         * Get the title with the current language. ex: this.post.description_pt or this.post.description_en
         */
        getDescription ()
        {
            return this.post['description_' + this.$i18n.locale];
        }
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
    },
}
</script>

<style scoped>

    .dark i {
        color: black;
    }
    .padding-top {
        padding-top: 44px;
    }

    .p30 {
        padding: 30px;
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
</style>
