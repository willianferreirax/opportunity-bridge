<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import StandardSelect from '@/Components/StandardSelect.vue';

const form = useForm('companyRegisterStep1', {
    name: '',
    email: '',
    role: '',
    phone: '',
    password: '',
    passwordConfirm: '',
});

const submit = () => {


    emit("nextStep")
};

const emit = defineEmits(["nextStep"])
</script>
<template>
    <form @submit.prevent="submit" class="p-12 pt-8">

        <div class="mb-8">
            <h1 class="font-bold text-xl">
                Cadastro: Dados básicos
            </h1>
            <p class="text-gray-600">
                Próximo: Dados da empresa
            </p>
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="name" value="Seu nome:" />
            <TextInput
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="name"
            />
            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="email" value="Email corporativo:" />
            <TextInput
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="email"
            />
            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="role" value="Seu cargo:" />
            <StandardSelect
                v-model="form.role"
            >
                <option value="1">cargo 1</option>
                <option value="2">option2</option>
                <option value="3">option3</option>
            </StandardSelect>
            <InputError class="mt-2" :message="form.errors.role" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="phone" value="Celular:" />
            <TextInput
                id="phone"
                v-model="form.phone"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="phone"
            />
            <InputError class="mt-2" :message="form.errors.phone" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="password" value="Senha" />
            <TextInput
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="password"
            />
            <p class="text-sm text-gray-600">
                *Minimo de 8 caracteres, 1 caractere especial, 1 letra maiusucula, letras e numeros
            </p>
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="passwordConfirm" value="Confirme a senha" />
            <TextInput
                id="passwordConfirm"
                v-model="form.passwordConfirm"
                type="password"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="passwordConfirm"
            />
            <InputError class="mt-2" :message="form.errors.passwordConfirm" />
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4">
                Próximo
            </PrimaryButton>
        </div>
    </form>
</template>