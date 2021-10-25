<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                    ? 'block py-2.5 px-4 rounded transition duration-200 hover:bg-kpmg-medium_blue hover:text-white border-2 border-kpmg-medium_blue mt-1'
                    : 'block py-2.5 px-4 rounded transition duration-200 hover:bg-kpmg-medium_blue hover:text-white mt-1'
            }
        }
    })
</script>
