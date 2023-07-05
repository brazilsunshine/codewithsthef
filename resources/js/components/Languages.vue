<template>
    <div>
        <div>
            <div
                @click.prevent="langsOpen = !langsOpen"
                ref="elementToMonitor"
                v-click-outside="handleClickOutside"
            >
                <button
                    class="button is-small" aria-haspopup="true"
                >
                    <!-- Current Language -->
                    <img
                        :src="getFlag(this.$i18n.locale)"
                        class="lang-flag-small"
                    />
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
    directives: {
        'click-outside': {
            bind: function (el, binding, vnode) {
                el.clickOutsideEvent = function (event) {
                    // Check if clicked element is outside the bound element and its children
                    if (!(el === event.target || el.contains(event.target))) {
                        // Call the provided method when a click outside occurs
                        vnode.context[binding.expression](event);
                    }
                };
                // Attach the event listener
                document.addEventListener('click', el.clickOutsideEvent);
            },
            unbind: function (el) {
                // Remove the event listener when the directive is unbound
                document.removeEventListener('click', el.clickOutsideEvent);
            }
        }
    },
    data ()
    {
        return {
            button: 'dropdown navbar-item pointer',
            isDropdownOpen: true,
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

        // /**
        //  *
        //  */
        // toggleOpen ()
        // {
        //     this.$store.commit('toggleLangsButton');
        // },

        handleClickOutside(event)
        {
            if (!this.$refs.elementToMonitor.contains(event.target))
            {
                this.isDropdownOpen = false;
            }
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
        margin-bottom: 3px;
    }

    .lang-flag-small {
        max-height: 21px !important;
        max-width: 31px;
    }

    img {
        border-radius: 30px;
    }
</style>
