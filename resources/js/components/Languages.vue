<template>
    <div>
        <div :class="checkOpen">
            <div class="dropdown-trigger" @click.prevent="langsOpen = !langsOpen">
                <button class="button is-small" aria-haspopup="true">
                    <!-- Current Language -->
                    <img :src="getFlag(this.$i18n.locale)" class="lang-flag-small" />
                </button>
            </div>

            <div>
                <div>
                    <div
                        v-for="lang in availableLanguages"
                        v-show="langsOpen"
                        @click="language(lang)"
                        class="hoverable flex"
                    >
                        <img :src="getFlag(lang)" class="lang-flag" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Languages",
    data ()
    {
        return {
            button: 'dropdown navbar-item pointer',
            langsOpen: false,
            dir: '/img/flags/',
            langs: [
                'en',
                'es',
                'pt',
            ],
        };
    },
    computed: {
        /**
         * Show the available language
         */
        availableLanguages ()
        {
            return this.langs.filter(lang => lang !== this.$i18n.locale); // this.$i18n is the active language
        },

        /**
         * Current locale
         */
        locale ()
        {
            return this.$i18n.locale;
        },
    },
    methods: {
        /**
         * We need it on vuex to close it whenever we click outside this component
         */
        checkOpen ()
        {
            return this.$store.state.languages.langsOpen ? this.button + ' is-active' : this.button;
        },

        /**
         * Return filepath for country flag
         */
        getFlag (lang)
        {
            return this.dir + lang.toLowerCase() + '.png';
        },

        /**
         * Change the currently active language
         */
        language (lang)
        {
            console.log({lang});

            this.$i18n.locale = lang;

            this.$localStorage.set('lang', lang);

            this.langsOpen = false;
        },

        /**
         *
         */
        toggleOpen ()
        {
            this.$store.commit('toggleLangsButton');
        }
    },
}
</script>

<style scoped>
    .flex {
        display: flex;
    }

    .hoverable {
        cursor: pointer;
    }



    .lang-flag {
        max-height: 28px;
        max-width: 30px;
        margin-bottom: 1px;
    }

    .lang-flag-small {
        max-height: 21px !important;
        max-width: 31px;
    }
</style>
