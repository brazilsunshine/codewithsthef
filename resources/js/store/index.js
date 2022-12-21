import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import { errors } from './modules/errors'
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
        errors,
        user,
        posts,
    }
});

