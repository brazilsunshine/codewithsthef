import VueRouter from "vue-router"
import store from './store'

import auth from './middleware/auth'
import admin from './middleware/admin'
import middlewarePipeline from './middleware/middlewarePipeline'
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
        },
        {
            path: '/login',
            component: require('./components/Login').default
        },
        {
            path: '/create-post/admin',
            component: require('./components/CreatePost').default,
            meta: {
                middleware: [ admin, auth ],
            }
        },
        {
            path: '/blog-preview/admin',
            component: require('./components/BlogPreview').default,
            meta: {
                middleware: [ admin, auth ]
            }
        },
        {
            path: '/admin',
            component: require('./components/Admin').default,
            meta: {
                middleware: [ admin, auth]
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
