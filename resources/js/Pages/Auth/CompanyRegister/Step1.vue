<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { vMaska } from 'maska';
import validatePhone from '@/Utils/validatePhone';
import validatePassword from '@/Utils/validatePassword';

const form = useForm('companyRegisterStep1', {
    name: 'recrutador final',
    email: 'empresa8@gmail.com',
    role: 'Recrutador',
    phone: '11954659621',
    password: 'Mwc1234_',
    password_confirmation: 'Mwc1234_',
});

const page = usePage();

function nextStep() {

    emit('resetForm', form.data())

    if(!form.name) {
        page.props.errors.name = 'Nome é obrigatório'
        return;
    }

    if(!form.email) {
        page.props.errors.email = 'Email é obrigatório'
        return;
    }

    if(!form.role) {
        page.props.errors.role = 'Cargo é obrigatório'
        return;
    }

    if(!form.phone) {
        page.props.errors.phone = 'Celular é obrigatório'
        return;
    }

    if(!validatePhone(form.phone)) {
        page.props.errors.phone = 'Celular inválido'
        return;
    }

    if(!form.password) {
        page.props.errors.password = 'Senha é obrigatório'
        return;
    }

    if(!form.password_confirmation) {
        page.props.errors.password_confirmation = 'Confirmação de senha é obrigatório'
        return;
    }

    if(!validatePassword(form.password)) {
        page.props.errors.password = 'Senha inválida'
        return;
    }

    if(form.password != form.password_confirmation) {
        page.props.errors.password_confirmation = 'As senhas não conferem'
        return;
    }

    emit("nextStep")
};

const emit = defineEmits(["nextStep", 'resetForm'])

</script>
<template>
    <div class="p-12 pt-8">

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
            <InputError class="mt-2" :message="$page.props.errors.name" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="email" value="Email corporativo:" />
            <TextInput
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                required
                autocomplete="email"
            />
            <InputError class="mt-2" :message="$page.props.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="role" value="Seu cargo:" />
            <TextInput
                id="role"
                v-model="form.role"
                type="text"
                class="mt-1 block w-full"
                required
                autocomplete="role"
            />
            <InputError class="mt-2" :message="$page.props.errors.role" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="phone" value="Celular:" />
            <TextInput
                id="phone"
                v-model="form.phone"
                type="text"
                class="mt-1 block w-full"
                required
                v-maska 
                data-maska="(##) #####-####"
                autocomplete="phone"
            />
            <InputError class="mt-2" :message="$page.props.errors.phone" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="password" value="Senha" />
            <TextInput
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="password"
            />
            <p class="text-sm text-gray-600">
                *Minimo de 8 caracteres, 1 caractere especial, 1 letra maiusucula, letras e numeros
            </p>
            <InputError class="mt-2" :message="$page.props.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="passwordConfirm" value="Confirme a senha" />
            <TextInput
                id="passwordConfirm"
                v-model="form.password_confirmation"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="passwordConfirm"
            />
            <InputError class="mt-2" :message="$page.props.errors.password_confirmation" />
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4" @click="nextStep">
                Próximo
            </PrimaryButton>
        </div>
    </div>
</template>