import VueRouter from "vue-router"
import store from './store'

import admin from './middleware/admin'
import auth from './middleware/auth'
import superAdmin from './middleware/superAdmin'
import middlewarePipeline from './middleware/middlewarePipeline'
import PostShow from "./components/PostShow";
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/',
            component: require('./components/Home').default
        },
        {
            path: '/register',
            component: require('./components/Register').default,
            // meta: {
            //     middleware: [ admin, auth ],
            // }
        },
        {
            path: '/login',
            component: require('./components/Login').default,
            // meta: {
            //     middleware: [ admin, auth ],
            // }
        },
        {
            path: '/contact',
            component: require('./components/Contact').default,
        },
        {
            path: '/projects',
            component: require('./components/Projects').default,
        },
        {
            path: '/posts/:slug/:lang',
            name: 'post',
            component: require('./components/PostShow').default,
            props: true,
            beforeEnter: (to, from, next) => {
                const slug = to.params.slug;
                const lang = to.params.lang;

                store.dispatch('GET_POST_BY_SLUG', { slug, lang })
                .then(() => {
                    next();
                })
                .catch(e => {
                    console.log(e)
                });
            },
        },
        {
            path: '/admin/create-post',
            component: require('./components/CreatePost').default,
            meta: {
                middleware: [ admin, auth ],
            }
        },
        {
            path: '/admin/blog-preview',
            component: require('./components/BlogPreview').default,
            meta: {
                middleware: [ admin, auth ]
            }
        },
        {
            path: '/admin/add-admin',
            component: require('./components/AddAdmin').default,
            meta: {
                middleware: [ auth, superAdmin ]
            }
        },
    ]
});

router.beforeEach((to, from, next) => {

    if (! to.meta.middleware) return next();

    const middleware = to.meta.middleware

    const context = { to, from, next, store };

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    });

});

export default router;
