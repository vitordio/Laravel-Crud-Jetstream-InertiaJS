<template>
    <jet-action-section>
        <template #title>
            {{ $trans().get('labels.delete_team') }}
        </template>

        <template #description>
            {{ $trans().get('labels.delete_team_text') }}
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                {{ $trans().get('labels.delete_team_description') }}
            </div>

            <div class="mt-5">
                <jet-danger-button @click="confirmTeamDeletion">
                    {{ $trans().get('labels.delete_team') }}
                </jet-danger-button>
            </div>

            <!-- Delete Team Confirmation Modal -->
            <jet-confirmation-modal :show="confirmingTeamDeletion" @close="confirmingTeamDeletion = false">
                <template #title>
                    {{ $trans().get('labels.delete_team') }}
                </template>

                <template #content>
                    {{ $trans().get('labels.delete_team_confirmation') }}
                </template>

                <template #footer>
                    <jet-secondary-button @click="confirmingTeamDeletion = false">
                        {{ $trans().get('buttons.cancel') }}
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteTeam" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ $trans().get('buttons.delete_team') }}
                    </jet-danger-button>
                </template>
            </jet-confirmation-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetActionSection from '@/Jetstream/ActionSection.vue'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        props: ['team'],

        components: {
            JetActionSection,
            JetConfirmationModal,
            JetDangerButton,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingTeamDeletion: false,
                deleting: false,

                form: this.$inertia.form()
            }
        },

        methods: {
            confirmTeamDeletion() {
                this.confirmingTeamDeletion = true
            },

            deleteTeam() {
                this.form.delete(route('teams.destroy', this.team), {
                    errorBag: 'deleteTeam'
                });
            },
        },
    })
</script>
