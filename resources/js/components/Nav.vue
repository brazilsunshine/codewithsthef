<template>
    <div>
        <div class="text-gray-900">
            <nav
                class="p-none flex flex-col md:flex-row items-center justify-between px6 py-3"
            >
                <div class="flex flex-col-mob items-center">
                    <div class="m1-mob ">
                        <router-link to="/" class="name text-xl p-2 font-size-mob">
                            codewithsthef
                        </router-link>
                    </div>

                    <div class="flex">
                        <div
                            class="hov rounded-full
                            h-7 transition duration-150 ease-in p2-15"
                        >
                            <router-link
                                to="/contact"
                            >
                                Contact <i class="far fa-envelope"></i>
                            </router-link>
                        </div>

                        <div
                            class="hov rounded-full
                            h-7 transition duration-150 ease-in p2-15"
                        >
                            <router-link
                                to="/projects"
                            >
                                Projects <i class="fas fa-chevron-right"></i>
                            </router-link>
                        </div>
                    </div>


                    <div
                        v-if="auth && is('superadmin')"
                        class="hov hover:bg-gray-200 rounded-full
                            h-7 transition duration-150 ease-in p2-15"
                    >
                        <router-link to="/admin/add-admin">
                            Add admin <i class="fa-solid fa-user-plus" />
                        </router-link>
                    </div>

                    <div
                        v-if="auth && is('admin')"
                        class="hov hover:bg-gray-200 rounded-full
                            h-7 transition duration-150 ease-in p2-15"
                    >
                        <router-link to="/admin/create-post">
                            Create a blog <i class="fa-solid fa-plus" />
                        </router-link>
                    </div>

                    <div
                        v-if="auth"
                        class="pointer hov hover:bg-gray-200 rounded-full
                            h-7 transition duration-150 ease-in p2-15"
                        @click="logout"
                    >
                        <p>
                            Logout<span><i class="fa-solid fa-right-from-bracket pl9" /></span>
                        </p>
                    </div>
                </div>

                <div>
                    <ul class="flex padding-mob-1 mr-1-mob" style="position:relative;">
                        <li class="p7">
                            <ToggleMode :mode="mode" @toggle="$emit('toggle')"/>
                        </li>
                        <li
                            class="absolute flag-des flag-mob"
                        >
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
import ToggleMode from "./ToggleMode";


export default {
    name: "Nav",

    props: [
        'mode',
    ],
    components: {
        ToggleMode,
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

        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },

        closeDropdown() {
            this.isDropdownOpen = false;
        },
    },
}
</script>

<style scoped>

    .dark nav {
        background: #211a2f;
        color: white;
    }

    .hov:hover {
        background-color: rgba(218, 99, 182, 0.67);
    }

    .dark .hov:hover {
        background-color: #614385;
    }

    .dark hr {
        height: 1px;
        background-image: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
        border: none;
    }

    .dark .name {
        background: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    hr {
        height: 1px;
        background-image: linear-gradient(to right, #ff0084 0%, #33001b  51%, #ff0084  100%);
        border: none;
    }

    .name {
        background-image: linear-gradient(to right, rgba(100, 9, 76, 0.87) 0%, rgb(255, 121, 198) 51%, rgba(100, 9, 76, 0.87) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-grad {
        margin: 10px;
        padding: 15px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }

    .btn-grad:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    .p2-15 {
        padding: 2px 15px;
    }

    .pl9 {
        padding-left: 9px;
    }

    .px6 {
        padding-left: 3rem;
        padding-right: 3rem;
    }

    .flag-des {
        left: -3em;
        padding: 7px;
    }

    @media screen and (max-width: 687px) {
        .m1-mob {
            margin: 1em !important;
        }

        .mr-1-mob {
            margin-right: 3em;
        }

        .p-none {
            padding: 0;
        }

        .flag-mob {
            left: 80px;
        }
    }

</style>
