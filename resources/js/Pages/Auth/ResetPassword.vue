<template>
    <Head :title="$trans().get('auth.reset_password')" />

    <jet-authentication-card>
        <template #background>
            <jet-authentication-background />
        </template>

        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <template #pageTitle>
            <h1 class="text-xl md:text-2xl font-bold leading-tight mt-4">{{ $trans().get('auth.reset_password') }}</h1>
        </template>

        <!-- Validation Errors -->
        <jet-validation-errors class="mb-4 mt-4" />

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <jet-label for="email" class="block text-gray-700">{{ $trans().get('labels.email')}}</jet-label>
                <jet-input id="email" type="email" :placeholder="$trans().get('labels.email')" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" class="block text-gray-700">{{ $trans().get('labels.password')}}</jet-label>
                <jet-input id="password" type="password" :placeholder="$trans().get('labels.password')" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" class="block text-gray-700">{{ $trans().get('labels.password_confirmation')}}</jet-label>
                <jet-input id="password_confirmation" type="password" :placeholder="$trans().get('labels.password_confirmation')" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ $trans().get('buttons.reset_password') }}
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetAuthenticationBackground from '@/Jetstream/BackgroundLogin.vue'
    import JetButton from '@/Jetstream/LoginButton.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetAuthenticationBackground,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    })
</script>
