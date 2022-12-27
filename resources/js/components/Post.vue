<template>
    <div class="p30">
        <div>
            <p class="text-lg font-semibold">
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
                            h-7 transition duration-150 ease-in px-3"
            >
                <i class="fa-solid fa-plus in-button"></i>
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
    name: "Posts",
    props: [
        'post'
    ],
    computed: {
        auth () {
            return this.$store.state.user.auth;
        },

        getTitle()
        {
            return this.post['title_' + this.$i18n.locale];
        },

        getDescription ()
        {
            return this.post['description_' + this.$i18n.locale];
        }
    },
    methods: {
        /**
         * Making a commit to update show and set it to true and hide show the modal;
         */
        toggleOptionsModal ()
        {
            // this.spamModal = !this.spamModal;
            this.$store.commit('showModal', {
                innerComponent: 'OptionsModal', // inner component is the component 'inside the model'
                title: 'Options'
            });
        },
    },
}
</script>

<style scoped>
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
