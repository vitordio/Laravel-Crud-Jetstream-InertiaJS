<template>
    <nav>
        <jet-nav-link
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            Dashboard
        </jet-nav-link>

        <jet-nav-link
            :href="route('users.index')"
            :active="route().current('users.index')"
        >
            Users
        </jet-nav-link>

        <jet-nav-link
            :href="route('contacts.index')"
            :active="route().current('contacts.index')"
        >
            Contacts
        </jet-nav-link>
    </nav>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'

    export default defineComponent({
        components: {
            JetNavLink,
        },
    });
</script>
