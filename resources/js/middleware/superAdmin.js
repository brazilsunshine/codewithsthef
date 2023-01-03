export default function admin ({ next })
{
    if (window.Laravel.jsPermissions?.roles.includes('superadmin')) return next();
    // the ? will stop the execution when a guest tries to visit the pages that are restricted to admin

    else window.location.href = '/';
}
