<template>
    <jet-form-section @submitted="store">
        <template #title>
            Create User
        </template>

        <template #description>
            Create a new user.
        </template>

        <!-- Validation Errors -->
        <jet-validation-errors class="mb-4 mt-4" />

        <template #form>
            <div class="col-span-6">
                <jet-label for="name" value="Name" />
                <jet-input id="name" placeholder="Name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-6">
                <jet-label for="email" value="Email" />
                <jet-input id="email" placeholder="Email" type="text" class="mt-1 block w-full" v-model="form.email" autofocus />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
            <div class="col-span-6">
                <jet-label for="password" value="Password" />
                <jet-input id="password" placeholder="Password" type="password" class="mt-1 block w-full" v-model="form.password" autofocus />
                <jet-input-error :message="form.errors.password" class="mt-2" />
            </div>
            <div class="col-span-6">
                <jet-label for="password_confirmation" value="Confirmation" />
                <jet-input id="password_confirmation" placeholder="Confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autofocus />
                <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="col-span-6" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>

                    <jet-input-error :message="form.errors.terms" class="mt-2" />
                </jet-label>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                User created.
            </jet-action-message>
            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetCheckbox,
            JetValidationErrors
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },
        methods: {
            store() {
                this.form.post(route('users.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset()
                    }
                });
            },
        },
    }
</script>
