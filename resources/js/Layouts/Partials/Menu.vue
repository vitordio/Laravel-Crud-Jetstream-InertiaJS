<template>
    <!-- Mobile menu -->
    <div class="bg-gray-800 text-gray-100 flex justify-between md:hidden">
        <!-- Logo -->
        <div class="h-16 w-full flex items-center">
            <jet-application-logo-white />
        </div>

        <button
            class="mobile-menu-button p-4 focus:outline-none focus:bg-gray-700"
            @click="sideBarHandler()"
        >
            <svg
                class="h-5 w-5"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <div
        class="
            sidebar
            bg-kpmg-blue
            text-blue-100
            w-64
            space-y-6
            py-7
            px-4
            absolute
            inset-y-0
            left-0
            transform
            -translate-x-full
            md:relative md:translate-x-0
            transition
            duration-200
            ease-in-out
        "
    >
        <a href="#" class="text-white flex items-center space-x-2 px-2">
            <div class="h-16 w-full flex items-center">
                <jet-application-logo-white />
            </div>
        </a>

        <!-- Navigation -->
        <Navigation />

        <div class="hidden sm:flex sm:items-center">
            <!-- Profile settings Dropdown -->
            <jet-profile-dropdown />

            <!-- Teams dropdown settings -->
            <jet-teams-dropdown />
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    import JetApplicationLogoWhite from '@/Jetstream/ApplicationLogoWhite.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetTeamsDropdown from '@/Jetstream/TeamsDropdown.vue'
    import JetProfileDropdown from '@/Jetstream/ProfileDropdown.vue'
    import Navigation from './Navigation.vue'

    export default defineComponent({
        components: {
            JetNavLink,
            JetApplicationLogoWhite,
            JetTeamsDropdown,
            JetProfileDropdown,
            Navigation,
            Link,
        },

        data() {
            return {
                moved: true,
            }
        },

        methods: {
            sideBarHandler() {
                const btn = document.querySelector(".mobile-menu-button");
                const sidebar = document.querySelector(".sidebar");

                btn.addEventListener("click", () => {
                    sidebar.classList.toggle("-translate-x-full");
                });
            },
        },
    });
</script>
