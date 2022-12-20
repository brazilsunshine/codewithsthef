<template>
    <div class="padding">
        <div>
            <p class="text-lg font-semibold">
                {{ post.title }}
            </p>
        </div>

        <div class="text-sm">
            <div>
                <p class="padding-top">
                    {{ post.description }}
                </p>

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
