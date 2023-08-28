export const mutations = {
    /**
     *
     */
    fileNameChange (state, payload)
    {
        state.blogPhotoName = payload;
    },

    /**
     *
     */
    createBlogPhotoFileURL (state, payload)
    {
        state.blogPhotoFileURL = payload;
    },

    /**
     *
     */
    openOrClosePhotoPreview (state)
    {
        state.blogPhotoPreview = !state.blogPhotoPreview;
    },

    /**
     * RootContainer has been created
     *
     * Reset application state.
     */
    resetState (state)
    {
        state.blogPhotoName = '';
        state.blogPhotoPreview = '';
        state.blogPhotoFileURL = '';
        state.blogTitle = '';
        state.blogHTML = '';
    },

    /**
     * Update the blogTitle from v-model="blogTitle"
     */
    updateBlogTitle (state, payload)
    {
        state.blogTitle = payload;
    },

    /**
     * Update the blogHTML from v-model="blogHTML"
     */
    updateBlogHTML (state, payload)
    {
        state.blogHTML = payload;
    },

    /**
     *
     */
    setPaginatedPosts (state, payload)
    {
        state.paginated = payload;
    },

    /**
     * Admin clicked on the OptionsModal.vue
     */
    setPost (state, payload)
    {
        state.post = payload;
    },

    /**
     * Admin edited post title
     */
    setEditedPostTitle (state, payload)
    {
        state.editPostTitle = payload;
    },

    /**
     * Admin edited post description
     */
    setEditedPostDescription (state, payload)
    {
        state.editPostDescription = payload;
    },

    /**
     * Set paginated posts to become filtered posts
     */
    serFilteredPosts (state, payload)
    {
        state.paginated = payload;
    },

    /**
     *
     */
    setTags (state, payload)
    {
        state.tags = payload;
    }
}

