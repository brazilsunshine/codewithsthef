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
     * Set paginated posts to become my payload;
     */
    setPaginatedPosts (state, payload)
    {
        state.paginated = payload;
    }
}
