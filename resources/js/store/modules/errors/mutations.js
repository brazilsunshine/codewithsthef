export const mutations = {
    /**
     * Delete error
     */
    deleteError (state, payload)
    {
        delete state.errorsObject[payload];
    },

    /**
     * Reset the state to not be saved in the localstorage
     * so the errors won't persist when the page is refreshed
     */
    resetState (state)
    {
        state.errorsObject = {};
    },

    /**
     * Submit form failed.
     */
    setErrorsObject (state, payload)
    {
        state.errorsObject = payload;
    }
}
