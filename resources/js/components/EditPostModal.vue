<template>
    <div @click.stop>
        <form @submit.prevent="submit" class="space-y-4 px-4 py-6">
            <div>
                <input
                    type="text"
                    placeholder="Enter Blog Title"
                    class="margin-bottom text-sm"
                    v-model="postTitle"
                />
            </div>
            <div>
                <textarea
                    cols="30"
                    rows="4"
                    placeholder="Write your blog here..."
                    class="w-full bg-gray-100 rounded-xl text-sm px-4 py-2"
                    v-model="postDescription"
                />
            </div>
            <div class="flex items-center justify between space-x-3">
                <button>
                    Publish Post
                </button>
            </div>
        </form> <!-- END FORM -->
    </div>
</template>

<script>
import Vue from "vue";

export default {
    name: "EditPostModal",
    computed: {
        /**
         * Return the post to get the post id
         */
        post () {
            return this.$store.state.posts.post;
        },

        postTitle: {
            get () {
                return this.getTitle;
            },
            set (payload) {
                this.$store.commit("setEditedPostTitle", payload);
            }
        },

        postDescription: {
            get () {
                return this.getDescription;
            },
            set (payload) {
                this.$store.commit("setEditedPostDescription", payload);
            }
        },

        /**
         * Get the title with the current language. ex: this.post.title_pt or this.post.title_en
         */
        getTitle()
        {
            return this.post['title_' + this.$i18n.locale];
        },

        /**
         * Get the description with the current language. ex: this.post.description_pt or this.post.description_en
         */
        getDescription ()
        {
            return this.post['description_' + this.$i18n.locale];
        },

        /**
         * Get the title with the current language. ex: this.post.description_pt or this.post.description_en
         */
        getSlug ()
        {
            return this.post['slug_' + this.$i18n.locale];
        },

        /**
         * Current locale
         */
        lang ()
        {
            return this.$i18n.locale;
        },
    },
    methods: {
        async submit ()
        {
            await axios.post('/api/posts/submit-edited-post', {
                postId: this.post.id,
                title: this.$store.state.posts.editPostTitle,
                description: this.$store.state.posts.editPostDescription,
                lang: this.lang,
                slug: this.getSlug,
            })

            .then(response => {
                console.log('submit-edited-post', response);

                if (response.data.success)
                {
                    Vue.$vToastify.success("You edited your post! =)");
                }
             })
            .catch(error => {
                console.log('submit-edited-post', error);
            });
        }
    },
}
</script>

<style scoped>
    .margin-bottom {
        margin-bottom: 20px;
    }

    input:focus:nth-child(1),
    textarea:focus {
        outline: none;
        --tw-ring-shadow: none;
        border-color: inherit;
        -webkit-box-shadow: none;
    }

    input:nth-child(1) {
        min-width: 300px;
        outline: none;
    }

    input {
        transition: .5s ease-in-out all;
        padding: 10px 4px;
        border: none;
        border-bottom: 1px solid #303030;
    }

    textarea {
        transition: .5s ease-in-out all;
    }

    label,
    button,
    .preview-button {
        transition: 0.5s ease-in-out all;
        align-self: center;
        font-size: 14px;
        cursor: pointer;
        border-radius: 20px;
        padding: 12px 24px;
        color: #fff;
        background-color: #303030;
        text-decoration: none;
    }

    label:hover,
    button:hover,
    .preview-button:hover {
        background-color: rgb(48, 48, 48, 0.7);
    }
</style>
