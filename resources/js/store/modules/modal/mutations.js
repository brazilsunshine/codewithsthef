export const mutations = {
    /**
     *
     */
    hideModal (state)
    {
        state.show = false;
    },

    /**
     * RootContainer has been created
     *
     * Reset application state.
     */
    resetState (state)
    {
        state.innerComponent = '';
    },

    /**
     *
     */
    showModal (state, payload)
    {
        state.show = true;
        state.title = payload.title;
        state.innerComponent = payload.innerComponent;
    }
}
