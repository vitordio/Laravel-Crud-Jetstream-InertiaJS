<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="relative min-h-screen md:flex bg-gray-200">
            <!-- Page menu -->
            <Menu />

            <div class="container">
                <div class="w-full h-full rounded">
                    <!-- Page Heading -->
                    <div class="lg:flex lg:items-center lg:justify-between bg-white shadow py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex-1 min-w-0">
                            <slot name="header"></slot>
                        </div>
                    </div>

                    <!-- Page Content -->
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Menu from './Partials/Menu.vue';

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            JetBanner,
            Menu,
        }
    })
</script>
