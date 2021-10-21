<template>
    <Link :href="'/'">
        <img class="w-48" :src="logo_src" :alt="logo_alt">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: {
            logo_src: {
                type: String,
                default: '/images/logo.png',
            },
            logo_alt: {
                type: String,
                default: 'Logo',
            },
        }
    })
</script>
