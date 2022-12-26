<template>
    <div class="signup-container">
        <div class="bg-white border-2 border-blue rounded-xl mt-16">
            <div class="text-center px-6 py-2 pt-6">
                <h3 class="font-semibold text-base">
                    Login
                </h3>
            </div>
            <form
                method="post"
                @submit.prevent="login"
                class="text-sm space-y-4 px-4 py-6"
            >
                <div>
                    <!-- USERNAME -->
                    <div class="md:flex">
                        <p class="font-semibold ml-2 flex-1">Username</p>
                    </div>

                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em"
                                id="username"
                                type="text"
                                placeholder="Your awesome username"
                                required
                                v-model="username"
                            >
                            <div class="absolute top-0 flex items-center h-full" style="margin-left: 14px;">
                                <i class="fa-solid fa-at"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- PASSWORD -->
                    <p class="font-semibold ml-2">Password</p>
                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em"
                                id="password"
                                type="password"
                                placeholder="Password"
                                required
                                v-model="password"
                            >
                            <div class="absolute top-0 flex items-center h-full" style="margin-left: 14px;">
                                <i class="fa fa-key fill-current w-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between space-x-3">
                    <button
                        :class="processing ? 'is-loading' : ''"
                        :disabled="processing"
                        class="flex items-center h-11 text-xs bg-gray-00 font-semibold
                        rounded-xl border border-gray-200 hover:border-gray-400 px-6 py-3"
                    >
                        <span v-if="processing">
                            <i class="fa fa-spinner fa-spin mr-1"></i>
                        </span>
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data () {
        return {
            username: '',
            password: '',

            processing: false
        }
    },
    methods: {
        /**
         * Submit login form
         */
        async login ()
        {
            this.processing = true;

            await axios.post('/api/login', {
                username: this.username,
                password: this.password
            })

            .then(response => {
                console.log('login-success', response);


                if (response.data.success)
                {
                    this.$store.commit('setUserObject', response.data.user);
                }

                alert('You are logged in!');

                window.location.href = "/"

            })
            .catch(error => {
                console.log('login', error);
            })

            this.processing = false;
        }
    }
}
</script>

