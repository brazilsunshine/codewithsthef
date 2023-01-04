<template>
    <div class="pointer">
        <input
            id="theme-toggle"
            type="checkbox"
            :checked="(mode === 'dark') ? 'checked' : false"
            @change="$emit('toggle')"
        />
        <label class="pointer" for="theme-toggle"><span></span></label>
    </div>
</template>

<script>
export default {
    name: "ToggleMode",
    props: [
        'mode',
    ],
}
</script>

<style lang="scss" scoped>
    #theme-toggle {
        display: none;

        & + label {
            font-size: 1rem;
            display: flex;
            height: 2em;
            width: 4em;
            border-radius: calc(2em / 2);
            background-size: auto 8em;
            background-position: bottom;
            background-image: linear-gradient(180deg, #021037 0%, #20206A 19%, #4184B1 66%, #62E7F7 100%);
            transition: 0.2s;
            border: .125em solid hsl(207, 30%, 95%);
            overflow: hidden;

            span {
                background: #fffad8;
                border-radius: 50%;
                height: 2em;
                width: 2em;
                transform: translateX(-0.125em) scale(.65);
                transition: 0.2s;
                cursor: pointer;
                box-shadow: 0 0 .25em .0625em #fbee8d, 0 0 2em 0 #FFEB3B, inset -.25em -.25em 0 0 #fbee8e, inset -.3125em -.3125em 0 .625em #fff5b2;
                margin-top: -0.125em;
            }
        }

        &:checked {
            font-size: 1rem;

            & + label {
                background-position: top;
                border-color: hsl(207, 30%, 50%);

                span {
                    background: transparent;
                    transform: translateX(calc(100% - .125em)) scale(.65);
                    box-shadow: inset -.1875em -.1875em 0 0 #fbe7ef, inset -.5625em -.5625em 0 0 #fffff7;
                }
            }
        }
    }
</style>
