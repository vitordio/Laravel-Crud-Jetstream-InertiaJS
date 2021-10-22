<template>
    <Head :title="$trans().get('auth.forgot_password')" />

    <jet-authentication-card>
        <template #background>
            <jet-authentication-background />
        </template>

        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <template #pageTitle>
            <h1 class="text-xl md:text-2xl font-bold leading-tight mt-4">{{ $trans().get('auth.forgot_password') }}</h1>
        </template>

        <div class="mb-4 mt-4 text-sm text-gray-600">
            {{ $trans().get('auth.text_forgot_password') }}
        </div>

        <jet-validation-errors class="mb-4 mt-4" />
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <jet-label for="email">{{ $trans().get('labels.email') }}</jet-label>
                <jet-input id="email" type="email" :placeholder="$trans().get('labels.email')" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>

            <div class="flex items-center justify-end">
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ $trans().get('buttons.password_reset_link') }}
                </jet-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ $trans().get('buttons.back') }}
                </Link>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
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
            Link,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetAuthenticationBackground,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            status: String
        },

        data() {
            // console.log(window.history.back());
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    })
</script>
