<template>
    <input type="checkbox" :value="value" v-model="proxyChecked"
        class="rounded border-gray-300 text-kpmg-blue shadow-sm focus:border-kpmg-blue focus:ring focus:ring-kpmg-blue focus:ring-opacity-50">
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    emits: ['update:checked'],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
})
</script>
