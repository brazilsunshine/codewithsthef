<template>
    <div>
        <div class="text-gray-900">
            <nav
                class="flex flex-col md:flex-row items-center justify-between px-4 py-3"
            >
                <div class="flex items-center space-x-4">
                    <div class="padding-mob-2">
                        <router-link to="/" class="text-xl p-2 font-size-mob">codewithsthef</router-link>
                    </div>
                </div>
                <div >
                    <ul class="flex padding-mob-1">
                        <li>
                            <a href="https://www.instagram.com/codewithsthef/">
                                <i class="fa-brands fa-instagram"></i>
                            </a>

                        </li>
                        <li>
                            <a href="https://github.com/brazilsunshine">
                                <i class="fa-brands fa-github"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/@codewithsthef">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <hr />
        </div>
    </div>
</template>

<script>
export default {
    name: "Nav"
}
</script>

<style scoped>
.fa-instagram {
    font-size: 36px;
    padding-right: 20px;
}

.fa-github {
    font-size: 33px;
    padding-right: 20px;
}

.fa-youtube{
    font-size: 33px;
}

</style>
