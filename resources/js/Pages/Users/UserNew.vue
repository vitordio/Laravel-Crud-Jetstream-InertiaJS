<template>
    <jet-form-section @submitted="store">
        <template #title>
            {{ $trans().get('labels.new_user') }}
        </template>

        <template #description>
            {{ $trans().get('labels.create_user') }}
        </template>

        <!-- Validation Errors -->
        <jet-validation-errors class="mb-4 mt-4" />

        <template #form>
            <div class="col-span-6">
                <jet-label for="name">{{ $trans().get('labels.name')}}</jet-label>
                <jet-input id="name" :placeholder="$trans().get('labels.name')" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-6">
                <jet-label for="email">{{ $trans().get('labels.email')}}</jet-label>
                <jet-input id="email" :placeholder="$trans().get('labels.email')" type="text" class="mt-1 block w-full" v-model="form.email" autofocus />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
            <div class="col-span-6">
                <jet-label for="password">{{ $trans().get('labels.password')}}</jet-label>
                <jet-input id="password" :placeholder="$trans().get('labels.password')" type="password" class="mt-1 block w-full" v-model="form.password" autofocus />
                <jet-input-error :message="form.errors.password" class="mt-2" />
            </div>
            <div class="col-span-6">
                <jet-label for="password_confirmation">{{ $trans().get('labels.password_confirmation')}}</jet-label>
                <jet-input id="password_confirmation" :placeholder="$trans().get('labels.password_confirmation')" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autofocus />
                <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="col-span-6" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            Eu concordo com os <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Termos de Serviço</a> e <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Política de Privacidade</a>
                        </div>
                    </div>

                    <jet-input-error :message="form.errors.terms" class="mt-2" />
                </jet-label>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                {{ $trans().get('messages.user_created')}}
            </jet-action-message>
            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $trans().get('buttons.save')}}
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
