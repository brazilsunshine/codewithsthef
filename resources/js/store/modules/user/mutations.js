export const mutations = {
    /**
     * A user has logged in or registered
     */
    setUserObject (state, payload)
    {
        state.auth = true;
        state.userObject = payload;
    },

    /**
     * A user has logged out
     */
    logout (state)
    {
        state.auth = false;
        state.userObject = null;
    },
}
