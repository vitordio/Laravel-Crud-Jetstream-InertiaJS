<template>
    <img class="w-full" :src="logo_src" :alt="logo_alt">
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            logo_src: {
                type: String,
                default: '/images/logo_white.png',
            },
            logo_alt: {
                type: String,
                default: 'Logo',
            },
        }
    })
</script>
