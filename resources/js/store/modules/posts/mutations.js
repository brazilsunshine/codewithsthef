export const mutations = {
    /**
     *
     */
    fileNameChange (state, payload)
    {
        console.log({ state });

        console.log({ payload });

        state.blogPhotoName = payload;
    },

    /**
     *
     */
    createBlogPhotoFileURL (state, payload)
    {
        console.log({ payload });

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
    },
}
