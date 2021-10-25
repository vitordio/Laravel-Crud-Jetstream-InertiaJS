<template>
    <Head :title="$trans().get('labels.users')" />

    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $trans().get('labels.users') }}
            </h2>
        </template>

        <div>
            <user-new />
        </div>

        <div class="mt-6 m:px-6 lg:px-8">
            <!-- Users grid -->
            <Table
                :filters="queryBuilderProps.filters"
                :search="queryBuilderProps.search"
                :columns="queryBuilderProps.columns"
                :on-update="setQueryBuilder"
                :meta="users"
            >
                <template v-slot:tableGlobalSearch="slotProps">
                    <div class="flex-grow">
                        <div class="relative">
                            <input
                                class="block w-full sm:text-sm rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300"
                                :placeholder="$trans().get('labels.search')"
                                :value="slotProps.search.global.value"
                                type="text"
                                @input="slotProps.changeGlobalSearchValue($event.target.value)"
                            />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-400"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </template>

                <template #head>
                    <tr>
                        <th v-show="showColumn('id')" @click.prevent="sortBy('id')">{{ $trans().get('labels.id') }}</th>
                        <th v-show="showColumn('name')" @click.prevent="sortBy('name')">{{ $trans().get('labels.name') }}</th>
                        <th v-show="showColumn('email')" @click.prevent="sortBy('email')">{{ $trans().get('labels.email') }}</th>
                        <th v-show="showColumn('current_team_id')" @click.prevent="sortBy('current_team_id')">Team_ID</th>
                        <th class="w-12">Ações</th>
                    </tr>
                </template>

                <template #body>
                    <tr v-for="user in users.data" :key="user.id">
                        <td v-show="showColumn('id')">{{ user.id }}</td>
                        <td v-show="showColumn('name')">{{ user.name }}</td>
                        <td v-show="showColumn('email')">{{ user.email }}</td>
                        <td v-show="showColumn('current_team_id')">{{ user.current_team_id }}</td>
                        <user-item :user="user"/>
                    </tr>
                </template>
            </Table>
        </div>
    </app-layout>
</template>

<script>
    import { Head } from '@inertiajs/inertia-vue3';
    import AppLayout from '@/Layouts/AppLayout'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import JetButton from '@/Jetstream/Button.vue'
    import UserNew from './UserNew'
    import UserItem from './UserItem'

    import { InteractsWithQueryBuilder, Tailwind2 } from '@protonemedia/inertiajs-tables-laravel-query-builder';

    export default {
        mixins: [InteractsWithQueryBuilder],
        components: {
            Head,
            AppLayout,
            JetSectionBorder,
            JetButton,
            Table: Tailwind2.Table,
            UserNew,
            UserItem
        },

        props: {
            users: Object,
        },

        data() {
            return {
                formIsVisible: false,
            }
        },

        methods: {
            showCreateForm() {
                this.formIsVisible = !this.formIsVisible;
            }
        },
    }
</script>
