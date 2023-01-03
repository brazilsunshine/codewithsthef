<template>
    <div class="toggle-wrapper">
        <label class="toggle">
            <input
                type="checkbox"
                :checked="(mode === 'dark') ? 'checked' : false"
                @change="$emit('toggle')"
            />
            <!-- Emit an event to the wrapper/parent component which is Nav.vue -->
            <span class="toggler round"></span>
        </label>
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

<style scoped>
    .toggle {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggler {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: black;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    .toggler:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background: white;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    input:checked + .toggler {
        background: #8c4bff;
    }

    input:focus + .toggler {
        box-shadow: 0 0 2px #2196F3;
    }

    input:checked + .toggler:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .toggler.round {
        border-radius: 34px;
    }

    .toggler.round:before {
        border-radius: 50%;
    }
</style>
