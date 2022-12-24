<template>
    <div class="padding">
        <div>
            <p class="text-lg font-semibold">
                {{ getTitle }}
            </p>
        </div>

        <div class="cover-photo ">
            <img :src="post.cover_photo" class="cover-photo-mob" alt=""/>
        </div>

        <div class="text-sm">
            <div>
                <p
                    class="padding-top"
                    v-html="getDescription"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Posts",
    props: [
        'post'
    ],
    computed: {
        getTitle()
        {
            return this.post['title_' + this.$i18n.locale];
        },

        getDescription ()
        {
            return this.post['description_' + this.$i18n.locale];
        }
    },
}
</script>

<style scoped>
    .padding-top {
        padding-top: 44px;
    }

    .padding {
        padding: 30px;
    }

    img {
        max-width: 55%;
        height: auto;
        border-radius: 20px;
    }

    .cover-photo {
        display: flex;
        justify-content: center;
        padding-top: 25px;
    }
</style>
