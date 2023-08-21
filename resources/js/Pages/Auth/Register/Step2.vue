<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import validatePassword from '@/Utils/validatePassword';

const form = useForm('userRegisterStep2', {
    email: '',
    password: '',
    passwordConfirm: '',
});

const page = usePage();

const nextStep = () => {
    
    form.clearErrors()

    if(!form.email) {
        page.props.errors.email = 'Email é obrigatório'
        return;
    }

    if(!form.password) {
        page.props.errors.password = 'Senha é obrigatório'
        return;
    }

    if(!form.passwordConfirm) {
        page.props.errors.passwordConfirm = 'Confirmação de senha é obrigatório'
        return;
    }

    if(!validatePassword(form.password)) {
        page.props.errors.password = 'Senha inválida'
        return;
    }

    if(form.password != form.passwordConfirm) {
        page.props.errors.passwordConfirm = 'As senhas não conferem'
        return;
    }

    emit("nextStep")
};

const emit = defineEmits(["nextStep"])
</script>
<template>
    <div class="p-12 pt-8">

        <div class="mb-8">
            <h1 class="font-bold text-xl">
                Cadastro: Conta
            </h1>
            <p class="text-gray-600">
                Próximo: Endereço
            </p>
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="email" value="Email" />
            <TextInput
                id="email"
                v-model="form.email"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="email"
            />
            <InputError class="mt-2" :message="$page.props.errors.email" />
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
            <InputError class="mt-2" :message="$page.props.errors.password" />
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
            <InputError class="mt-2" :message="$page.props.errors.passwordConfirm" />
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4" @click="nextStep()">
                Próximo
            </PrimaryButton>
        </div>
    </div>
</template>