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
                <i class="fas fa-plus in-button"></i>
            </button>
        </div>

        <div>
            <div>
                <p
                    class="padding-top"
                    v-html="processedContent"
                />
                <button
                    v-if="showReadMore"
                    @click="toggleDescription"
                    class="read-more-btn"
                >
                    {{ showFullDescription ? 'Read Less' : 'Read More' }}
                </button>
            </div>
        </div>

        <div class="mt-6">
            <div class="flex items-center text-xs text-gray-400 space-x-2" style="justify-content: center;">
                <div class="mobile-right-182 text-blue">
                    {{ post.user.name }}
                </div>
                <div>
                    &bull;
                </div>
                <div>
                    {{ post.diffForHumans }}
                </div>
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
    data ()
    {
        return {
            showFullDescription: false,
            maxLength: 200,
        };
    },
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
        },

        /**
         * Use a computed property to calculate the truncated or expanded content based on the current state
         */
        processedContent () {
            if (this.getDescription && this.getDescription.length > this.maxLength && !this.showFullDescription)
            {
                return this.getDescription.substring(0, this.maxLength) + '...';
            }
            return this.getDescription;
        },

        /**
         * ensure that the substring and length methods are only called when this.getDescription is not null.
         */
        showReadMore() {
            return this.getDescription && this.getDescription.length > this.maxLength;
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

        toggleDescription()
        {
            this.showFullDescription = !this.showFullDescription;
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

    .read-more-btn {
        margin-top: 1em;
        background-image: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
        align-self: center;
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
</style>
