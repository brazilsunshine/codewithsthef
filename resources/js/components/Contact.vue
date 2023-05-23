<template>
    <div class="contact-us">
        <p class="fs3em name fs5em ">{{ this.$t('contact.get-in-touch')}}</p>
        <p class="text">/* {{ this.$t('contact.description')}} */</p>
        <form @submit.prevent="submitForm" class="contact-form">
            <div class="form-group">
                <input placeholder="Name" style="font-size: 0.85rem" type="text" id="name" v-model="formData.name" required>
            </div>
            <div class="form-group">
                <input placeholder="Email" style="font-size: 0.85rem" type="email" id="email" v-model="formData.email" required>
            </div>
            <div class="form-group">
                <textarea
                    placeholder="Say something nice"
                    style="font-size: 0.85rem"
                    id="message"
                    v-model="formData.message" required
                />
            </div>
            <button class="btn-gradient" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                name: '',
                email: '',
                message: ''
            }
        };
    },
    methods: {
        submitForm() {
            // Send the form data to the Laravel backend
            axios.post('/api/contact', this.formData)
                .then(response => {
                    // Handle the successful response here
                    console.log(response.data);

                    // Reset the form after successful submission
                    this.formData = {
                        name: '',
                        email: '',
                        message: ''
                    };
                })
                .catch(error => {
                    // Handle the error response here
                    console.error(error);
                });
        }
    }
};
</script>

<style scoped>
    .fs5em {
        font-size: 5em;
    }
    .name {
        background-image: linear-gradient(to right, rgba(100, 9, 76, 0.87) 0%, rgb(255, 121, 198) 51%, rgba(100, 9, 76, 0.87) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .dark .name {
        background-image: linear-gradient(to right, rgba(100, 9, 76, 0.87) 0%, rgb(95, 108, 157) 51%, rgba(100, 9, 76, 0.87) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text {
        color: rgb(98, 114, 164);
        font-size: 1rem;
        font-weight: 300;
        margin-bottom: 1em;
        padding: 0.3em;
    }

    .contact-us {
        text-align: center;
        margin: 3em;
    }

    .contact-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 2rem;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 15px;
        font-size: 1rem;
    }

    button {
        display: block;
        width: 100%;
        padding: 0.75rem;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 3px;
        font-size: 1rem;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .dark .btn-gradient {
        background-image: linear-gradient(to right, #614385 0%, #516395  51%, #614385  100%);
        align-self: center;
        font-size: 14px;
        cursor: pointer;
        border-radius: 20px;
        padding: 12px 24px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
    }

    .dark .btn-gradient:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    .btn-gradient  {
        background-image: linear-gradient(to right, rgba(100, 9, 76, 0.87) 0%, rgb(255, 121, 198) 51%, rgba(100, 9, 76, 0.87) 100%);
        align-self: center;
        font-size: 14px;
        cursor: pointer;
        border-radius: 20px;
        padding: 12px 24px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
    }

    .btn-gradient:hover {
        background-position: right center; /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    @media screen and (max-width: 687px) {
        .fs3em {
            font-size: 3rem !important;
        }

        .m1-mob {
            margin: 1em !important;
        }
    }
</style>
