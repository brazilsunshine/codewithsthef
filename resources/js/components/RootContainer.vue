<template>
    <div>
        <Nav />

        <router-view />
    </div>
</template>

<script>
import Nav from './Nav'
export default {
    name: "RootContainer",
    components: {
        Nav
    },
}
</script>

<style scoped>

</style>
