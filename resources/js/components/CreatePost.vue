<template>
    <div class="create-post flex">
        <p v-if="loading">
            Loading...
        </p>
        <div v-else class="post-container">
            <div :class="{invisible: !error}" class="error-message">
                <p><span>Error</span>{{ this.errorMsg }}</p>
            </div>
            <div class="blog-info">
                <form @submit.prevent="submit">
                    <input
                        type="text"
                        placeholder="Enter Blog Title"
                        v-model="blogTitle"
                        class="margin-bottom"
                    />
                    <div>
                        <div class="buttons">
                            <label for="upload" class="mr-2" style="padding: 14px;">
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
                                    @click="openPreview"
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
                    <div class="blog-actions pt-44-mob">
                        <button>Publish Blog</button>
                        <router-link class="preview-button padding-15" to="/blog-preview/admin">Post Preview</router-link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor, Quill } from 'vue2-editor';
import Vue from 'vue';

import ImageResize from 'quill-image-resize-vue';
import { ImageDrop } from 'quill-image-drop-module';

Quill.register("modules/imageDrop", ImageDrop);
Quill.register("modules/imageResize", ImageResize);

export default {
    name: "CreatePost",
    components: {
        VueEditor
    },

    data ()
    {
        return {
            loading: true,

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
            get ()
            {
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
            get ()
            {
                return this.$store.state.posts.blogHTML;
            },

            set (payload)
            {
                 this.$store.commit("updateBlogHTML", payload);
            }
        }
    },

    methods: {
        /**
         *
         */
        async submit ()
        {
            await axios.post('/api/posts/submit-blog-post', {
                title: this.blogTitle,
                description: this.blogHTML,
            })

            .then(response => {
                console.log('submit-blog-post', response);

                Vue.$vToastify.success("You created your post! =)");
             })
            .catch(error => {
                console.log('submit-blog-post', error);
            });
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
        background-color: #303030;
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
        height: 80%
    }

    .ql-container {
        display:flex;
        flex-direction: column;
        height: 50%;
        overflow: scroll;
    }

    .margin-bottom {
        margin-bottom: 20px;
    }

    p {
       font-size: 14px;
    }

    /*span {*/
    /*    font-weight: 600;*/
    /*}*/

    .blog-info {
        margin-bottom: 32px;
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

    .buttons {
        margin: 20px 0;
    }

    input:nth-child(2) {
        opacity: 0;
        max-width: 165px;
        position: absolute;
        left: 313px;
        top: 152px;

    }

        .padding-15 {
        padding: 15px;
    }
</style>
