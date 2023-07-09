import store from "../../index";

export const actions = {
    /**
     * Get paginated posts
     */
    async GET_PAGINATED_POSTS (context)
    {
        await axios.get('/api/posts/get-paginated-posts')

        .then(response => {
            console.log('get-paginated-posts', response);

            if (response.data.success)
            {
                context.commit('setPaginatedPosts', response.data.posts)
            }

         })
        .catch(error => {
            console.log('get-paginated-posts', error);
        });
    },

    /**
     * Load the previous page of Ideas
     */
    async PREVIOUS_IDEAS_PAGE (context)
    {
        await axios.get(context.state.paginated.prev_page_url) // making a get request to my own store

        .then(response => {
            console.log('previous-ideas-page', response);

            if (response.data.success)
            {
                context.commit('setPaginatedPosts', response.data.posts);

                window.scrollTo(0,0); // scroll the page to the top
            }
        })
        .catch(error => {
            console.log('previous-ideas-page', error);
        });
    },

    /**
     * Load the next page of Ideas
     */
    async NEXT_IDEAS_PAGE (context)
    {
        await axios.get(context.state.paginated.next_page_url) // making a get request to my own store

        .then(response => {
            console.log('next-ideas-page', response);

            if (response.data.success)
            {
                context.commit('setPaginatedPosts', response.data.posts);

                window.scrollTo(0,0); // scroll the page to the top
            }
        })
        .catch(error => {
            console.log('next-ideas-page', error);
        });
    },

    /**
     * Get post by slug
     */
    async GET_POST_BY_SLUG (context, payload)
    {
        const { slug, lang } = payload;

        await axios.get(`/api/posts/${slug}/${lang}`)
        .then(response => {
            console.log('GET_POST_BY_SLUG', response);

            if (response.status === 200)
            {
                context.commit("setPost", response.data);

                window.scrollTo(0,0); // scroll the page to the top
            }
        })
        .catch(error => {
            console.log('GET_POST_BY_SLUG', error);
        });
    },
}
