<template>
    <div>
        <button
            class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none"
            @click="updating = true">
            Edit
        </button>

        <button
            class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
            @click="destroying = true">
            Delete
        </button>

        <jet-dialog-modal :show="updating" @close="updating = false">
            <template #title>
                Update User
            </template>

            <template #content>
                <div class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="name" value="Name" />
                        <jet-input type="text" placeholder="Name" class="mt-1 block w-full" v-model="updateForm.name" autofocus />
                        <jet-input-error :message="updateForm.errors.name" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="email" value="Email" />
                        <jet-input type="text" placeholder="Email" class="mt-1 block w-full" v-model="updateForm.email" autofocus />
                        <jet-input-error :message="updateForm.errors.email" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="password" value="Password" />
                        <jet-input type="password" placeholder="Password" class="mt-1 block w-full" v-model="updateForm.password" autofocus />
                        <jet-input-error :message="updateForm.errors.password" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="password_confirmation" value="Confirmation" />
                        <jet-input type="password" placeholder="Confirmation" class="mt-1 block w-full" v-model="updateForm.password_confirmation" autofocus />
                        <jet-input-error :message="updateForm.errors.password_confirmation" class="mt-2" />
                    </div>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="updating = false">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="update" :class="{ 'opacity-25': updateForm.processing }" :disabled="updateForm.processing">
                    Save
                </jet-button>
            </template>
        </jet-dialog-modal>

        <jet-confirmation-modal :show="destroying" @close="destroying = false">
            <template #title>
                Delete User
            </template>

            <template #content>
                Are you sure you would like to delete this User?
            </template>

            <template #footer>
                <jet-secondary-button @click="destroying = false">
                    Cancel
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click="destroy" :class="{ 'opacity-25': destroyForm.processing }" :disabled="destroyForm.processing">
                    Delete User
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>

    </div>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
    import JetDangerButton from "@/Jetstream/DangerButton";
    import JetDialogModal from "@/Jetstream/DialogModal";
    import JetFormSection from "@/Jetstream/FormSection";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from "@/Jetstream/InputError";
    import JetLabel from "@/Jetstream/Label";
    import JetSecondaryButton from "@/Jetstream/SecondaryButton";

    export default {
        components: {
            JetButton,
            JetConfirmationModal,
            JetDangerButton,
            JetDialogModal,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },
        props: [
            'user',
        ],
        data() {
            return {
                updateForm: this.$inertia.form({
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password,
                    password_confirmation: this.user.password_confirmation,
                }),
                updating: false,
                destroyForm: this.$inertia.form(),
                destroying: false,
            }
        },
        methods: {
            update() {
                this.updateForm.put(route('users.update', this.user), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.updating = false
                    }
                });
            },
            destroy() {
                this.destroyForm.delete(route('users.destroy', this.user), {
                    errorBag: 'default',
                    preserveScroll: true,
                    onSuccess: () => {
                        this.destroying = false
                        this.destroyForm.reset()
                    }
                });
            },
        },
    }
</script>
