<template>
    <div class="create-post flex ">
        <div class="post-container">
            <div :class="{invisible: !error}" class="error-message">
                <p><span>Error</span>{{ this. errorMsg }}</p>
            </div>
            <div class="blog-info">
                <input
                    type="text"
                    placeholder="Enter Blog Title"
                    v-model="blogTitle"
                    class="margin-bottom"
                />
                <div>
                    <div class="margin-bottom">
                        <label for="upload" class="mr-2">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true">
                                Upload Cover Photo
                            </span>
                            <input type="file" id="upload" accept=".png, .jpg, .jpeg" style="display:none">
                        </label>
                        <button class="preview-button mr-2">Preview Photo</button>
                        <span>File Chosen: </span>
                    </div>
                    <div class="editor editor-mob">
                        <vue-editor :editorOptions="editorSettings" v-model="blogHTML" useCustomImageHandler/>
                    </div>
                    <div class="blog-actions">
                        <button class="button">Publish Blog</button>
                        <button class="preview preview-button" >Post Preview</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { VueEditor } from "vue2-editor/dist/vue2-editor.core.js";

export default {
    name: "CreatePost",
    components: {
        VueEditor
    },
    data ()
    {
        return {
            error: null,
            errorMsg: null,
            blogTitle: '',
            blogHTML: '',
            editorSettings: {
                // modules: {
                //     imageResize: {
                //     }
                // }
            }
        }
    },

    computed: {
        
    },
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

button {
    margin-top: 0;
}

.preview-button {
    text-decoration: none;
    color: white;
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
    height: 80vh;
    display: flex;
    flex-direction: column;
}

.quillWrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%
}

.ql-container {
    display:flex;
    flex-direction: column;
    height: 100%;
    overflow: scroll;
}

.blog-actions {
    margin-top: 32px;

}

p {
   font-size: 14px;
}

span {
    font-weight: 600;
}

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

.margin-bottom {
    margin-bottom: 20px
}

input:nth-child(2) {
    opacity: 0;
    max-width: 165px;
    position: absolute;
    left: 313px;
    top: 152px;

}

input:focus, textarea:focus, select:focus{
}

</style>
