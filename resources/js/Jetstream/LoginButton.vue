<template>
    <button :type="type" class="w-full block bg-kpmg-blue hover:bg-kpmg-medium_blue focus:bg-kpmg-medium_blue text-white font-semibold rounded-lg px-4 py-3 mt-6">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    })
</script>
