<template>
    <Head title="Secure Area" />

    <jet-authentication-card>
        <template #background>
            <jet-authentication-background />
        </template>

        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <template #pageTitle>
            <h1 class="text-xl md:text-2xl font-bold leading-tight mt-4">Confirm password</h1>
        </template>

        <div class="mb-4 mt-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <!-- Validation Errors -->
        <jet-validation-errors class="mb-4 mt-4" />

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <jet-label for="password" class="block text-gray-700" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirm
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

        data() {
            return {
                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.confirm'), {
                    onFinish: () => this.form.reset(),
                })
            }
        }
    })
</script>
