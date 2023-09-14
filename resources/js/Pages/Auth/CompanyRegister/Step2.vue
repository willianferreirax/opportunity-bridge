<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { vMaska } from 'maska';

const form = useForm('companyRegisterStep2', {
    fantasyName: '',
    companyName: '',
    cnpj: '',
    workersNumber: '',
    companyArea: '',
    companyDescription: '',
});

const page = usePage();

const nextStep = () => {

    form.clearErrors()

    if(!form.fantasyName) {
        page.props.errors.fantasyName = 'Nome fantasia é obrigatório'
        return;
    }

    if(!form.companyName) {
        page.props.errors.companyName = 'Razão social é obrigatório'
        return;
    }

    if(!form.workersNumber) {
        page.props.errors.workersNumber = 'Número de funcionarios é obrigatório'
        return;
    }

    if(!form.companyArea) {
        page.props.errors.companyArea = 'Área de atuação é obrigatório'
        return;
    }

    if(!form.companyDescription) {
        page.props.errors.companyDescription = 'Descrição da empresa é obrigatório'
        return;
    }

    emit("nextStep")
};

const backStep = () => {
    emit("backStep")
};

const emit = defineEmits([
    "nextStep",
    "backStep"
])
</script>
<template>
    <div class="p-12 pt-8">
        <div class="mb-8">
            <h1 class="font-bold text-xl">
                Cadastro: Dados da empresa
            </h1>
            <p class="text-gray-600">
                Próximo: Endereço
            </p>
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="fantasyName" value="Nome fantasia:" />
            <TextInput
                id="fantasyName"
                v-model="form.fantasyName"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="fantasyName"
            />
            <InputError class="mt-2" :message="$page.props.errors.fantasyName" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="companyName" value="Razão social:" />
            <TextInput
                id="companyName"
                v-model="form.companyName"
                type="text"
                class="mt-1 block w-full"
                required
                autocomplete="companyName"
            />
            <InputError class="mt-2" :message="$page.props.errors.companyName" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="cnpj" value="CNPJ:" />
            <TextInput
                id="cnpj"
                v-model="form.cnpj"
                type="text"
                class="mt-1 block w-full"
                required
                v-maska 
                data-maska="[
                    '##.###.###/####-##'
                ]"
                autocomplete="cnpj"
            />
            <InputError class="mt-2" :message="$page.props.errors.cnpj" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="workersNumber" value="Número de funcionarios:" />
            <TextInput
                id="workersNumber"
                v-model="form.workersNumber"
                type="text"
                class="mt-1 block w-full"
                v-maska 
                data-maska="[
                    '##########'
                ]"
                required
                autocomplete="workersNumber"
            />
            <InputError class="mt-2" :message="$page.props.errors.workersNumber" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="companyArea" value="Área de atuação:" />
            <TextInput
                id="companyArea"
                v-model="form.companyArea"
                type="text"
                class="mt-1 block w-full"
                required
                autocomplete="companyArea"
            />

            <InputError class="mt-2" :message="$page.props.errors.companyArea" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="companyDescription" value="Descrição da empresa:" />
            <textarea id="companyDescription" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                v-model="form.companyDescription"
                required
                autocomplete="companyDescription"
            >

            </textarea>

            <InputError class="mt-2" :message="$page.props.errors.companyDescription" />
        </div>

        <div class="flex items-center justify-center mt-4">

            <PrimaryButton class="ml-4" @click="backStep()">
                Voltar
            </PrimaryButton>
            
            <PrimaryButton class="ml-4" @click="nextStep()">
                Próximo
            </PrimaryButton>
        </div>
    </div>
</template>