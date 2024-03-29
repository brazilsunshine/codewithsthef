import Vue from "vue";

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
    async PREVIOUS_POSTS_PAGE (context)
    {
        await axios.get(context.state.paginated.prev_page_url) // making a get request to my own store

        .then(response => {
            console.log('previous-posts-page', response);

            if (response.data.success)
            {
                context.commit('setPaginatedPosts', response.data.posts);

                window.scrollTo(0,0); // scroll the page to the top
            }
        })
        .catch(error => {
            console.log('previous-posts-page', error);
        });
    },

    /**
     * Load the next page of Post
     */
    async NEXT_POSTS_PAGE (context)
    {
        await axios.get(context.state.paginated.next_page_url) // making a get request to my own store

        .then(response => {
            console.log('next-posts-page', response);

            if (response.data.success)
            {
                context.commit('setPaginatedPosts', response.data.posts);

                window.scrollTo(0,0); // scroll the page to the top
            }
        })
        .catch(error => {
            console.log('next-posts-page', error);
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

    /**
     * Get filtered posts
     */
    async GET_FILTERED_POSTS (context, payload)
    {
        await axios.get('api/posts/get-filtered-posts', {
            params: {
                startDate: payload.startDate,
                endDate: payload.endDate
            }
        })

        .then(response => {
            console.log('GET_FILTERED_POSTS', response);

            if (response.data.success)
            {
                context.commit('serFilteredPosts', response.data.posts)

                Vue.$vToastify.success('You have successfully filtered the posts ❤️');
            }
            else
            {
                Vue.$vToastify.info('Sorry, no posts were found for this date :(');
            }
         })
        .catch(error => {
            console.log('GET_FILTERED_POSTS', error);
        });
    },

    /**
     * Get Post by title when the guest searches
     */
    async SEARCH_POST_BY_TITLE (context, payload)
    {
        await axios.get('api/posts/get-posts-by-title', {
            params: {
                postTitle: payload.postTitle,
                lang: payload.lang
            }
        })

        .then(response => {
            console.log('SEARCH_POST_BY_TITLE', response);

            if (response.data.success)
            {
                context.commit('setPaginatedPosts', response.data.posts)
            }
         })
        .catch(error => {
            console.log('SEARCH_POST_BY_TITLE', error);
        });
    },

    /**
     * Get request to get all tags
     */
    async GET_TAGS (context)
    {
        await axios.get('/api/posts/get-tags')

            .then(response => {
                console.log('get-tags', response);

                if (response.data.success)
                {
                    context.commit('setTags', response.data.tags);
                }
            })
            .catch(error => {
                console.log('get-categories', error);
            });
    },
}
