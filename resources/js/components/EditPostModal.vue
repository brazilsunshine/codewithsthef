<template>
    <div>
        <form @click.stop class="space-y-4 px-4 py-6">
            <div>
                <input
                    type="text"
                    placeholder="Enter Blog Title"
                    class="margin-bottom text-sm"
                />
            </div>
            <div>
                <textarea
                    cols="30"
                    rows="4"
                    class="w-full bg-gray-100 rounded-xl text-sm px-4 py-2"
                    placeholder="Describe your Idea"
                />
            </div>
            <div class="flex items-center justify between space-x-3">
                <button
                >
                    Publish Post
                </button>
            </div>
        </form> <!-- END FORM -->
    </div>
</template>

<script>
export default {
    name: "EditPostModal"
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
