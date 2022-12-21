export const actions = {
    /**
     *
     */
    async CHECK_AUTH (context)
    {
        await axios.get('/api/user/check-auth')

            .then(response => {

                if (response.data.auth) // if response.data.auth is successful
                {
                    // set user
                    context.commit('setUserObject', response.data.user);
                }
                else
                {
                    // log the user out
                    context.commit('logout');
                }
            })
            .catch(error => {
                console.log('check_auth', error);
            });
    }
}
