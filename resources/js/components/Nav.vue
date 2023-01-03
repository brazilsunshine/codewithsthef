<template>
    <div>
        <div class="text-gray-900">
            <nav
                class="flex flex-col md:flex-row items-center justify-between px-4 py-3"
            >
                <div class="flex flex-col-mob items-center space-x-4">
                    <div class="pt-mob-6 ">
                        <router-link to="/" class="text-xl p-2 font-size-mob">
                            codewithsthef
                        </router-link>
                    </div>
                    <div v-if="auth && is('superadmin')" class="pt-mob-6 hov hover:bg-gray-200 rounded-full
                            h-7 transition duration-150 ease-in p2-15">
                        <router-link to="/admin/add-admin">
                            Add admin <i class="fa-solid fa-user-plus" />
                        </router-link>
                    </div>
                    <div v-if="auth && is('admin')" class="pt-mob-6 hov hover:bg-gray-200 rounded-full
                            h-7 transition duration-150 ease-in p2-15">
                        <router-link to="/admin/create-post">
                            Create a blog <i class="fa-solid fa-plus" />
                        </router-link>
                    </div>
                    <div v-if="auth" class="pointer hov hover:bg-gray-200 rounded-full
                            h-7 transition duration-150 ease-in p2-15" @click="logout">
                        <p>Logout <span><i class="fa-solid fa-right-from-bracket" /></span></p>
                    </div>
                </div>
                <div>
                    <ul class="flex padding-mob-1">
                        <li class="p7">
                            <Languages />
                        </li>
                    </ul>
                </div>
            </nav>
            <hr />
        </div>
    </div>
</template>

<script>
import Languages from "./Languages";
export default {
    name: "Nav",
    components: {
        Languages
    },
    computed: {
        /**
         * Return True if the user is logged in.
         */
        auth ()
        {
            return this.$store.state.user.auth;
        },
    },
    methods: {
        /**
         * Post request to logout
         */
        async logout ()
        {
            await axios.post('/api/logout')

                .then(response => {
                    console.log('logout', response);

                    this.$store.commit('logout');

                    // Push the user to the path /home
                    if (this.$route.path !== '/')
                    {
                        this.$router.push("/");
                    }

                    alert('You have logged out!');

                })
                .catch(error => {
                    console.log('logout', error);
                });
        },
    },
}
</script>

<style scoped>
    .fa-instagram {
        font-size: 36px;
        padding-right: 20px;
    }

    .fa-github {
        font-size: 33px;
        padding-right: 20px;
    }

    .fa-youtube{
        font-size: 33px;
        padding-right: 10px;
    }

    .p7 {
        padding: 7px;
    }
    .p2-15 {
        padding: 2px 15px;
    }

    .p2 {
        padding: 2px;
    }

</style>
