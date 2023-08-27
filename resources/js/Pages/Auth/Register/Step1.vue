<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { vMaska } from 'maska';
import validateCPF from '@/Utils/validateCPF';
import validatePhone from '@/Utils/validatePhone';

const form = useForm('userRegisterStep1', {
    name: '',
    cpf: '',
    certificate: '',
    birthdate: '',
    phone: '',
    terms: false,
});

const page = usePage();

function nextStep() {

    emit('resetForm', form.data())

    if(!validateCPF(form.cpf)) {
        page.props.errors.cpf = 'CPF inválido'
        return;
    }

    if(!form.name) {
        page.props.errors.name = 'Nome é obrigatório'
        return;
    }

    if(!form.birthdate) {
        page.props.errors.birthdate = 'Data de nascimento é obrigatório'
        return;
    }

    if(!form.certificate) {
        page.props.errors.certificate = 'Certificado EY Institute é obrigatório'
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

    emit('nextStep')
};

const emit = defineEmits(['nextStep', 'resetForm'])
</script>
<template>
    <div class="p-12 pt-8">

        <div class="mb-8">
            <h1 class="font-bold text-xl">
                Cadastro: Dados básicos
            </h1>
            <p class="text-gray-600">
                Próximo: Conta
            </p>
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="cpf" value="CPF" />
            <TextInput
                id="cpf"
                v-model="form.cpf"
                type="tel"
                class="mt-1 block w-full rounded-full"
                required
                v-maska 
                data-maska="[
                    '###.###.###-##'
                ]"
                autocomplete="cpf"
            />
            <InputError class="mt-2" :message="$page.props.errors.cpf" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="name" value="Nome" />
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
            <InputLabel class="mb-2" for="birthdate" value="Data de nascimento" />
            <TextInput
                id="birthdate"
                v-model="form.birthdate"
                type="date"
                class="mt-1 block w-full rounded-full"
                required
                autocomplete="birthdate"
            />
            <InputError class="mt-2" :message="$page.props.errors.birthdate" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="certificate" value="Certificado EY Institute" />
            <TextInput
                id="certificate"
                v-model="form.certificate"
                type="text"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.certificate" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="phone" value="Celular" />
            <TextInput
                id="phone"
                v-model="form.phone"
                type="tel"
                class="mt-1 block w-full"
                required
                v-maska 
                data-maska="(##) #####-####"
                autocomplete="phone"
            />
            <InputError class="mt-2" :message="$page.props.errors.phone" />
        </div>

        <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
            <InputLabel class="mb-2" for="terms">
                <div class="flex items-center">
                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                    <div class="ml-2">
                        I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy Policy</a>
                    </div>
                </div>
                <InputError class="mt-2" :message="$page.props.errors.terms" />
            </InputLabel>
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4" @click="nextStep">
                Próximo
            </PrimaryButton>
        </div>
    </div>
</template>