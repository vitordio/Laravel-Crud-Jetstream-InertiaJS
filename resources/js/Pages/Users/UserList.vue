<template>
    <div v-if="users.total > 0">
        <jet-section-border />

        <jet-action-section class="mt-10 sm:mt-0">
            <template #title>
                Users
            </template>

            <template #description>
                All Users.
            </template>

            <template #content>
                <div class="space-y-6">
                    <div class="flex items-center justify-between" v-for="user in users.data" :key="user.id">
                        <div class="flex items-start justify-betweenr">
                            <div class="w-64">{{ user.name }}</div>
                            <div class="w-64">{{ user.email }}</div>
                            <user-item :user="user"/>
                        </div>
                    </div>
                    <pagination :links="users.links" />
                </div>
            </template>
        </jet-action-section>
    </div>
</template>

<script>
    import UserItem from './UserItem'
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import Pagination from '@/Shared/Pagination'

    export default {
        components: {
            UserItem,
            JetActionSection,
            JetSectionBorder,
            Pagination,
        },
        props: [
            'users',
        ]
    }
</script>
