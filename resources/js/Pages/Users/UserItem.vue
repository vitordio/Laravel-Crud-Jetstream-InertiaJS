<template>
    <td>
        <button
            class="cursor-pointer text-sm text-gray-400 underline focus:outline-none"
            @click="updating = true">
            <svg-icon type="mdi" :path="iconPaths.edit" title="sss"></svg-icon>
        </button>

        <button
            class="cursor-pointer ml-2 text-sm text-red-500 focus:outline-none"
            @click="destroying = true">
            <svg-icon type="mdi" :path="iconPaths.delete"></svg-icon>
        </button>
    </td>

    <div>
        <jet-dialog-modal :show="updating" @close="updating = false">
            <template #title>
                {{ $trans().get('labels.update_user') }}
            </template>

            <template #content>
                <div class="col-span-6 sm:col-span-4">
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="name">{{ $trans().get('labels.name')}}</jet-label>
                        <jet-input type="text" :placeholder="$trans().get('labels.name')" class="mt-1 block w-full" v-model="updateForm.name" autofocus />
                        <jet-input-error :message="updateForm.errors.name" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="email">{{ $trans().get('labels.email')}}</jet-label>
                        <jet-input type="text" :placeholder="$trans().get('labels.email')" class="mt-1 block w-full" v-model="updateForm.email" autofocus />
                        <jet-input-error :message="updateForm.errors.email" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="password">{{ $trans().get('labels.password')}}</jet-label>
                        <jet-input type="password" :placeholder="$trans().get('labels.password')" class="mt-1 block w-full" v-model="updateForm.password" autofocus />
                        <jet-input-error :message="updateForm.errors.password" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <jet-label for="password_confirmation">{{ $trans().get('labels.password_confirmation')}}</jet-label>
                        <jet-input type="password" :placeholder="$trans().get('labels.password_confirmation')" class="mt-1 block w-full" v-model="updateForm.password_confirmation" autofocus />
                        <jet-input-error :message="updateForm.errors.password_confirmation" class="mt-2" />
                    </div>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="updating = false">
                    {{ $trans().get('buttons.cancel') }}
                </jet-secondary-button>

                <jet-button class="ml-2" @click="update" :class="{ 'opacity-25': updateForm.processing }" :disabled="updateForm.processing">
                    {{ $trans().get('buttons.save') }}
                </jet-button>
            </template>
        </jet-dialog-modal>

        <jet-confirmation-modal :show="destroying" @close="destroying = false">
            <template #title>
                {{ $trans().get('labels.delete_user') }}
            </template>

            <template #content>
                {{ $trans().get('labels.confirmation_delete_user') }}
            </template>

            <template #footer>
                <jet-secondary-button @click="destroying = false">
                    {{ $trans().get('buttons.cancel') }}
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click="destroy" :class="{ 'opacity-25': destroyForm.processing }" :disabled="destroyForm.processing">
                    {{ $trans().get('buttons.delete') }}
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

    import SvgIcon from '@jamescoyle/vue-icon'
    import { mdiPencilCircleOutline, mdiDeleteEmptyOutline } from '@mdi/js'

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
            SvgIcon
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
                iconPaths: {
                    edit: mdiPencilCircleOutline,
                    delete: mdiDeleteEmptyOutline
                }
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
