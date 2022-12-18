import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import { user } from './modules/user'
import { posts } from './modules/posts'

Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [
        createPersistedState({
             key: 'codewithsthef'
        })
    ],
    modules: {
        user,
        posts,
    }
});

