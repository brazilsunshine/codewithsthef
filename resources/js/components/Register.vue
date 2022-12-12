<template>
    <div class="signup-container">
        <div class="bg-white border-2 border-blue rounded-xl mt-16 ">
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
                                style="padding-left: 2.5em"
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
                    <!-- EMAIL -->

                    <div class="md:flex">
                        <p class="font-semibold ml-2 flex-1">Email</p>
                    </div>

                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em"
                                id="email"
                                type="email"
                                placeholder="Email"
                                required
                                v-model="email"
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
                <div>
                    <!-- PASSWORD CONFIRMATION -->
                    <p class="font-semibold ml-2">Password Confirmation</p>
                    <div class="flex items-center w-full">
                        <div class="relative w-full">
                            <input
                                class="w-full bg-gray-100 border-none rounded-xl placeholder-gray-400 px-4 py-2"
                                style="padding-left: 2.5em"
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

    methods: {
        async submit ()
        {
            this.processing = true;

            if (this.password !== this.password_confirmation)
            {
                alert("Passwords do not match =(")

                this.password_confirmation = '';

                return '';
            }

            await this.$store.dispatch('REGISTER', {
                name: this.name,
                username: this.username,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            });
        },
    },
}
</script>

<style scoped>
.signup-container {
    margin: auto;
    width: 35em;
}
</style>
