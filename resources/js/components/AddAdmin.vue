<template>
    <div class="admin">
        <div class="container">
            <h2>
                Admin
            </h2>
            <div class="admin-info text-xs mobile-add-admin">
                <div class="add-admin-name">
                    <h2>
                        Add admin
                    </h2>
                </div>

                <div class="input input-mobile-add-admin">
                    <input
                        placeholder="Enter user email to make them admin"
                        class="br"
                        type="text"
                        id="addAdmins"
                        v-model="adminEmail"
                    />
                </div>
                <span>
                    {{ this.functionMsg }}
                </span>
                <button @click="addAdmin" class="button button-mobile-mt">Add admin</button>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";

export default {
    name: "AddAdmin",
    data ()
    {
        return {
            adminEmail: '',
            functionMsg: null,
        }
    },
    methods: {
        /**
         * Add an admin on the backend
         */
        async addAdmin ()
        {
            await axios.post('/api/admin/add-admin', {
                email: this.adminEmail
            })

            .then(response => {
                console.log('add-admin', response);

                if (response.data.success)
                {
                    Vue.$vToastify.success(`You added ${response.data.user.name} as an admin =)`);
                }
             })
            .catch(error => {
                console.log('add-admin', error);
            });
        }
    },
}
</script>

<style scoped>

    .container {
        max-width: 2000px;
        padding: 60px 25px;
    }

    h2 {
        text-align: center;
        margin-bottom: 16px;
        font-weight: 300;
        font-size: 32px;
    }

    .admin-info {
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px  rgba(0, 0, 0, 0.06);
        padding: 32px;
        background-color: #f1f1f1;
        display: flex;
        flex-direction: column;
        max-width: 600px;
        margin: 32px auto;
    }

    .dark .admin-info {
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px  rgba(0, 0, 0, 0.06);
        padding: 32px;
        background-image: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
        display: flex;
        flex-direction: column;
        max-width: 600px;
        margin: 32px auto;
        color: #443467;
    }

    span {
        font-size: 14px;
    }

    .input {
        width: 100%;
        border: transparent;
        border-radius: 20px;
        background-color: #f2f7f6;
        padding: 5px;
        height: 53px;
        display: inline-grid;
    }

    input:nth-child(1) {
        background-color: #f2f7f6;
        outline: none;
        --tw-ring-shadow: none;
        border-color: inherit;
        -webkit-box-shadow: none;
    }

    .br {
        border-radius: 20px !important;
    }

    button {
        transition: 0.5s ease-in-out all;
        align-self: center;
        margin-top: 30px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 20px;
        padding: 12px 24px;
        color: #fff;
        background-color: #303030;
        text-decoration: none;
    }

    button:hover {
        background-color: rgb(48, 48, 48, 0.7);
    }


    h2 {
        padding: 16px !important;
        margin: 20px 2px 38px;
        /*margin: 20px 2px 38px;*/
        /*top margin is 20px*/
        /*right and left margins are 2px*/
        /*bottom margin is 38px*/
    }
</style>
