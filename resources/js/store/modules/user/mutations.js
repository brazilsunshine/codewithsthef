export const mutations = {
    /**
     * A user has logged in or registered
     */
    setUserObject (state, payload)
    {
        state.auth = true;
        state.userObject = payload;
    },
}
