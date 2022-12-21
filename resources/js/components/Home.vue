<template>
    <div>
        <div>
            <main class="container mx-auto flex flex-column-mob">
                <div class="w-70 mx-auto">
                    <div class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl mt-16 gradient">
                        <div class="text-center px-6 py-2 pt-6">
                            <h1 class="font-semibold text-base">
                                Oii! Eu sou a Sthefane!
                            </h1>
                            <div>
                                <p class="text-sm mt-4">
                                    Eu tenho 23 anos e sou engenheira de software autodidata. Sou brasileira mas moro
                                    na Irlanda. Eu trabalho com Laravel, Vue.js, TailwindCss e estou estudando Testing.
                                    Criei esse Website com o intuito de postar blogs para dar dicas para quem tem
                                    interesse em estudar web development.
                                    Muitas vezes o termo "engenharia de software" pode parecer assustador, no entanto,
                                    como tudo nessa vida, você so precisar estudar e ter interesse que com certeza você
                                    vai conseguir!
                                    A chave para alcancar seu objetivo é manter a sua motivação.
                                    Pode demorar semanas, meses ou muito provavelmente anos, mas tudo é possível se
                                    você sair da sua zona de conforto.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-175 padding-idea-on-mobile">
                    <div class="mt-16">
                        <div
                            v-for="post in posts"
                            :key="post.id"
                        >
                            <Posts
                                :post="post"
                            />
                        </div>

                        <PaginationButtons
                            :current_page="this.$store.state.posts.paginated.current_page"
                            :next_page_url="this.$store.state.posts.paginated.next_page_url"
                            prev_page="PREVIOUS_IDEAS_PAGE"
                            next_page="NEXT_IDEAS_PAGE"
                        />


                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import Posts from "./Posts";
import PaginationButtons from "./PaginationButtons";
export default {
    name: "Home",
    components: {
        PaginationButtons,
        Posts
    },

    computed: {
        /**
         * Return paginated posts from vuex store
         */
        posts ()
        {
            return this.$store.state.posts.paginated.data;
        }
    },

    async mounted ()
    {
       await this.$store.dispatch('GET_PAGINATED_POSTS')
    }
}
</script>

<style scoped>
.container {
    width: 71%;
    padding-bottom: 28px;
}
</style>
