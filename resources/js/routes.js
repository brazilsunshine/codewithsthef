import VueRouter from "vue-router"
import store from './store'

import admin from './middleware/admin'
import auth from './middleware/auth'
import superAdmin from './middleware/superAdmin'
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
