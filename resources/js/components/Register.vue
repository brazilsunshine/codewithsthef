<template>
    <div class="signup-container maxw350-mob">
        <div class="bg-white border-2 gradient">
            <div class="text-center px-6 py-2 pt-6">
                <h3 class="font-semibold text-base">
                    Register
                </h3>
            </div>
            <form
                method="post"
                @submit.prevent="submit"
                class="text-sm space-y-4 px-4 py-6"
            >
                <div>
                    <!-- NAME -->
                    <p class="font-semibold ml-2">Name</p>
                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em; color: #443467"
                                id="name"
                                type="text"
                                placeholder="Your full name"
                                required
                                v-model="name"
                            >
                            <div class="absolute top-0 flex items-center h-full" style="margin-left: 14px;">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- USERNAME -->
                    <div class="md:flex">
                        <p class="font-semibold ml-2 flex-1">Username</p>
                        <p v-if="errors['username']" class="show-error">
                            {{ this.errors['username'][0] }}
                        </p>
                    </div>

                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em; color: #443467"
                                id="username"
                                type="text"
                                placeholder="Your awesome username"
                                required
                                v-model="username"
                                @keydown="clearError('username')"
                            >
                            <div class="absolute top-0 flex items-center h-full" style="margin-left: 14px;">
                                <i class="fa-solid fa-at"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- EMAIL -->

                    <div class="md:flex">
                        <p class="font-semibold ml-2 flex-1">Email</p>
                        <p v-if="errors['email']" class="show-error">
                            {{ this.errors['email'][0] }}
                        </p>
                    </div>

                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em; color: #443467"
                                id="email"
                                type="email"
                                placeholder="Email"
                                required
                                v-model="email"
                                @keydown="clearError('email')"
                            >
                            <div class="absolute top-0 flex items-center h-full" style="margin-left: 14px;">
                                <i class="fa-regular fa-envelope"></i>
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
                                style="padding-left: 2.5em; color: #443467"
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
                <div>
                    <!-- PASSWORD CONFIRMATION -->
                    <p class="font-semibold ml-2">Password Confirmation</p>
                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em; color: #443467"
                                id="password_confirmation"
                                type="password"
                                placeholder="Password Confirmation"
                                required
                                v-model="password_confirmation"
                            >
                            <div class="absolute top-0 flex items-center h-full" style="margin-left: 14px;">
                                <i class="fa fa-refresh"></i>
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
                        type="submit"
                    >
                        <span v-if="processing">
                            <i class="fa fa-spinner fa-spin mr-1"></i>
                        </span>
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    data () {
        return {
            processing: false,

            // Registration
            name: '',
            username: '',
            email: '',
            password: '',
            password_confirmation: '',
        }
    },
    computed: {
        /**
         * This returns a shortcut to the errorsObject on vuex
         *
         * This object will be an object containing all the errors we received from the request
         * OR it can return null if there are no errors
         */
        errors ()
        {
            return this.$store.state.errors.errorsObject;
        }
    },

    methods: {
        /**
         * Clear an error with this key
         */
        clearError (key)
        {
            if (this.errors[key]) {
                this.$store.commit('deleteError', key);
            }
        },

        /**
         * Submit register form
         */
        async submit ()
        {
            this.processing = true;

            if (this.password !== this.password_confirmation)
            {
                alert("Passwords do not match =(")

                this.password_confirmation = '';

                return '';
            }

            await axios.post('/api/register', {
                name: this.name,
                username: this.username,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })

                .then(response => {
                    console.log('register', response);

                    if (response.data.success)
                    {
                        this.$store.commit('setUserObject', response.data.user);
                    }

                    alert('Congratulations! Your account has been created. Please verify your emails to activate login');

                    // Push the user to the path /home
                    window.location.href = "/"
                })
                .catch(error => {
                    console.log('register', error.response.data);

                    this.$store.commit('setErrorsObject', error.response.data.errors);
                });

            this.processing = false;

        },
    },
}
</script>

<style scoped>

    .dark .bg-white {
        background-image: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
    }

    .dark i {
        color: #443467;
    }

    .dark .border-2 {
        border: none;
    }

    .signup-container {
        padding: 63px 0;
    }

</style>
