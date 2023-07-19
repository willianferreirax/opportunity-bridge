<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import BorderButton from '@/Components/BorderButton.vue';
import NavLink from '@/Components/NavLink.vue';
import TopBar from '@/Components/TopBar.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <TopBar>
            <template #buttons>
                <Link href="">
                    <BorderButton class="text-white mr-2 text-xs md:text-base sm:p-1 md:p-2">
                        Anunciar vaga
                    </BorderButton>
                </Link>
                
                <Link :href="route('register')">
                    <BorderButton class="text-white ml-2 text-xs md:text-base sm:p-1 md:p-2">
                        
                        Cadastre-se
                        
                    </BorderButton>
                </Link>

            </template>
        </TopBar>

        <AuthenticationCard>
            <template #logo>
                <AuthenticationCardLogo />
            </template>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="p-8 md:p-12 flex flex-col justify-center items-center">
                <div class="md:w-3/4 w-full">
                    <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                    <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ey-yellow dark:focus:ring-offset-gray-800">
                        Esqueci a senha
                    </Link>
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" />
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Lembrar de mim</span>
                    </label>
                </div>

                <div class="flex items-center justify-center mt-4">

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Login
                    </PrimaryButton>

                </div>

                <div class="flex justify-center mt-3 text-sm">
                    <Link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ey-yellow ">
                        Não tem uma conta? Cadastre-se
                    </Link>
                </div>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>
