<template>
    <Head :title="$trans().get('auth.login')" />

    <!-- Login component -->
    <jet-authentication-card>
        <template #background>
            <jet-authentication-background />
        </template>

        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <template #pageTitle>
            <h1 class="text-xl md:text-2xl font-bold leading-tight mt-4">{{ $trans().get('auth.login_in_account') }}</h1>
        </template>

        <!-- Validation Errors -->
        <jet-validation-errors class="mb-4 mt-4" />
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mt-6">
            <div>
                <jet-label for="email" class="block text-gray-700">{{ $trans().get('labels.email') }} </jet-label>
                <jet-input id="email" type="email" :placeholder="$trans().get('labels.enter_email')" class="mt-1 block w-full" v-model="form.email" required autocomplete  autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" class="block text-gray-700">{{ $trans().get('labels.password') }} </jet-label>
                <jet-input id="password" type="password" :placeholder="$trans().get('labels.enter_password')" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="flex justify-between mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ $trans().get('auth.remember') }}</span>
                </label>

                <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm font-semibold text-gray-700 hover:text-kpmg-blue focus:text-kpmg-blue">
                    {{ $trans().get('auth.forgot_password') }}
                </Link>
            </div>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $trans().get('auth.login') }}
            </jet-button>
        </form>

        <div v-if="canRegister">
            <hr class="my-6 border-gray-300 w-full">
            <p class="mt-8">{{ $trans().get('auth.need_account') }}
                <Link :href="route('register')" class="text-kpmg-blue hover:text-kpmg-medium_blue font-semibold">
                    {{ $trans().get('auth.register') }}
                </Link>
            </p>
        </div>

    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetAuthenticationBackground from '@/Jetstream/BackgroundLogin.vue'
    import JetButton from '@/Jetstream/LoginButton.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetAuthenticationBackground,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            canRegister: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
