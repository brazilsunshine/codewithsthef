export const mutations = {
    /**
     *
     */
    setUserObject (state, payload)
    {
        state.auth = true;
        state.userObject = payload;
    },
}
