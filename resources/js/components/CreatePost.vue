<template>
    <div class="create-post flex">
        <p v-if="loading">
            Loading...
        </p>
        <div v-else>
            <div>
                <form @submit.prevent="submit">
                    <input
                        type="text"
                        placeholder="Enter Blog Title"
                        v-model="blogTitle"
                        @keydown="clearError('title')"
                    />
                    <div class="mt-6">
                        <div>
                            <label for="upload">
                            <span class=" glyphicon glyphicon-folder-open" aria-hidden="true">
                                Upload Cover Photo
                            </span>
                                <input
                                    type="file"
                                    ref="blogPhoto"
                                    id="upload"
                                    accept=".png, .jpg, .jpeg"
                                    style="display: none"
                                    @change="fileChange"
                                />
                            </label>
                            <div v-if="this.$store.state.posts.blogPhotoName">
                                <button
                                    @click.prevent="openPreview"
                                    class="preview-button mr-2"
                                >
                                    Preview Photo
                                </button>
                                <span class="inline-flex-mob">
                                File Chosen: {{ this.$store.state.posts.blogPhotoName }}
                            </span>
                            </div>
                        </div>
                        <div class="editor vh46-mobile">
                            <vue-editor
                                v-model="blogHTML"
                                :editorOptions="editorSettings"
                                useCustomImageHandler
                                @image-added="handleImageAdded"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="tags">
                            <input
                                v-model="tagName"
                                placeholder="Add tag to this post"
                            />
                            <span class="tag"  v-for="tag in tags" :key="tag">{{ tag }}</span>
                        </div>
                        <button class="mt-2" @click.prevent="addTagToList">
                            add tag
                        </button>
                    </div>

                    <div class="blog-actions pt-44-mob">
                        <div :class="{invisible: !error}" class="error-message">
                            <p>{{ this.errorMsg }}</p>
                        </div>
                        <p v-if="errors['title']" class="error-message">
                            {{ this.errors['title'][0] }}
                        </p>
                        <button
                            :disabled="processing"
                        >
                            Publish Blog
                        </button>
                        <router-link class="preview-button padding-15" to="/blog-preview/admin">
                            Post Preview
                        </router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { Quill, VueEditor } from 'vue2-editor';
import Vue from 'vue';

import ImageResize from 'quill-image-resize-vue';
import {ImageDrop} from 'quill-image-drop-module';

Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);

export default {
    name: "CreatePost",
    components: {
        VueEditor
    },
    data () {
        return {
            loading: true,

            processing: false, // button

            tagName: '',
            tags: [],

            // data
            file: null, // cover_photo
            error: null,
            errorMsg: null,
            editorSettings: {
                modules: {
                    imageDrop: true,
                    imageResize: {},
                },
            }
        }
    },
    created ()
    {
        this.loading = false;
    },
    computed: {
        /**
         * Using v-model to get and update the blogTitle in Vuex store
         */
        blogTitle: {
            get () {
                return this.$store.state.posts.blogTitle;
            },
            set (payload)
            {
                 this.$store.commit("updateBlogTitle", payload);
            }
        },

        /**
         * Using v-model to get and update the blogHTML in Vuex store
         */
        blogHTML: {
            get () {
                return this.$store.state.posts.blogHTML;
            },
            set (payload) {
                 this.$store.commit("updateBlogHTML", payload);
            }
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
    },

    methods: {
        /**
         * Submit cover_photo & blog post
         */
        async submit ()
        {
            this.processing = true;

            if (this.blogTitle.length !== 0 && this.blogHTML.length !==0)
            {
                if (this.$store.state.posts.blogPhotoName)
                {
                    let formData = new FormData();
                    formData.append('file', this.$refs.blogPhoto.files[0]);
                    formData.append('title', this.blogTitle);
                    formData.append('description', this.blogHTML);
                    formData.append('lang', this.lang);
                    formData.append('tags', this.tags);

                    await axios({
                        url: "/api/posts/submit-blog-post",
                        method: "POST",
                        data: formData,
                        headers: { 'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'] }
                    })

                    .then(response => {
                        console.log('submit-blog-post', response);

                        if (response.status === 200)
                        {
                            Vue.$vToastify.success("You created your post! =)");

                            this.blogTitle = ''
                            this.blogHTML = ''
                        }
                    })
                    .catch(error => {
                        console.log('submit-blog-post', error.response);

                        this.$store.commit('setErrorsObject', error.response.data.errors)
                    });
                } else {
                    this.error = true;
                    this.errorMsg = "Please ensure you uploaded a cover photo";
                    setTimeout(() =>
                    {
                        this.error = false
                    }, 5000);
                }
            } else {
                this.error = true;
                this.errorMsg = "Please ensure blog title & blog post has been filled";
                setTimeout(() =>
                {
                    this.error = false
                }, 5000);
            }
            this.processing = false;
        },

        /**
         * Image added vue-editor HTML
         */
        handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
            let formData = new FormData();
            formData.append("file", file);

            axios({
                url: "/api/posts/upload-image-blog-html",
                method: "POST",
                data: formData,
                headers: { 'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'] }
            })
            .then(result => {
                let url = result.data.url; // Get url from response

                Editor.insertEmbed(cursorLocation, "image", url);
                resetUploader();
            })
            .catch(error => {
                console.log('upload', error);
            });
        },

        /**
         *  Create a blogPhotoFileURL
         */
        fileChange () {
            this.file = this.$refs.blogPhoto.files[0]; // in <type="file" input ref="blogPhoto">

            const fileName = this.file.name;

            this.$store.commit('fileNameChange', fileName);
            this.$store.commit('createBlogPhotoFileURL', URL.createObjectURL(this.file));
        },

        /**
         * Open the photoPreview
         */
        openPreview ()
        {
            this.$store.commit('openOrClosePhotoPreview');
        },

        /**
         * Clear an error with this key
         */
        clearError (key)
        {
            if (this.errors[key]) {
                this.$store.commit('deleteError', key);
            }
        },

        /**
         * Add tag inserted my author to tags array
         */
        addTagToList()
        {
            if (this.tagName && !this.tags.includes(this.tagName))
            {
                this.tags.push(this.tagName);
                this.tagName = '';
            }
        },
    }
}
</script>

<style scoped>
    @import "~vue2-editor/dist/vue2-editor.css";

    /* Import the Quill styles you want */
    @import '~quill/dist/quill.core.css';
    @import '~quill/dist/quill.bubble.css';
    @import '~quill/dist/quill.snow.css';

    input:focus:nth-child(1) {
        outline: none;
        --tw-ring-shadow: none;
        border-color: inherit;
        -webkit-box-shadow: none;
    }

    .create-post {
        position: relative;
        height: 100%;
        justify-content: center;
        padding: 13px 23px 67px;
        max-width: 50%;
        margin: auto
    }

    .preview-button {
        text-decoration: none;
        color: white;
        margin-top: 26px;
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

    /* gradient */
    .dark label,
    button,
    .preview-button  {
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

    .dark label:hover,
    button:hover,
    .preview-button:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    /* Error Styling */
    .invisible {
        opacity: 0 !important;
    }

    .error-message {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        color: #fff;
        margin-bottom: 10px;
        background-color: darkred;
        opacity: 1;
        transition: .5s ease all;
    }

    .editor {
        height: 73vh;
        display: flex;
        flex-direction: column;
        margin-top: 43px;
    }

    .quillWrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        height: 80%;
        max-width: 100%;
    }

    .ql-container {
        display:flex;
        flex-direction: column;
        height: 50%;
        overflow: scroll;
    }

    .ql-snow .ql-editor pre.ql-syntax {
        background-color: #23241f;
        color: #f8f8f2;
        overflow: visible;
    }

    p {
       font-size: 14px;
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

    .dark input {
        transition: .5s ease-in-out all;
        padding: 10px 4px;
        border: none;
        border-bottom: 1px solid #614385;
        background: transparent;
    }

    input:nth-child(2) {
        opacity: 0;
        max-width: 165px;
        position: absolute;
        left: 313px;
        top: 152px;

    }

    .padding-15
    {
        padding: 15px;
    }

    button:disabled {
        cursor: not-allowed;
        opacity: 0.8;
    }


    /* TAGS */
    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        font-family: 'Arial', sans-serif; /* Optional: Change font as needed */
    }

    .tag {
        display: inline-block;
        background: linear-gradient(135deg, #6B77DD, #8592E0); /* Gradient background for depth */
        border-radius: 20px; /* Rounded corners */
        font-size: 13px;
        font-weight: 600; /* Bold font for better readability */
        padding: 10px 24px;
        color: #FFF;
        position: relative;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Pronounced shadow for 3D effect */
        transition: all 0.3s; /* Smooth transitions */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Slight shadow on text for depth */
    }

    .tag::before, .tag::after {
        content: "";
        position: absolute;
    }

    .tag::before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #FFF;
        left: -5px;
        top: 50%;
        transform: translateY(-50%);
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Shadow for white dot */
    }

    .tag::after {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #6B77DD; /* Color taken from gradient start */
        left: -4px;
        top: 50%;
        transform: translateY(-50%);
    }

    .tag:hover {
        transform: translateY(-5px); /* Lifts the tag slightly */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Increase shadow for lifted effect */
    }
</style>
