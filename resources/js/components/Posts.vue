<template>
    <div class="padding">
        <div>
            <p class="text-lg font-semibold">
                {{ post.title }}
            </p>
        </div>

<!--        <div>-->
<!--            <img :src="post.cover_photo"/>-->
<!--        </div>-->

        <div class="text-sm">
            <div>
                <p
                    class="padding-top"
                    v-html="post.description"
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
}
</script>

<style scoped>
.padding-top {
    padding-top: 44px;
}

.padding {
    padding: 30px;
}
</style>
