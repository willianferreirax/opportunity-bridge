<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { vMaska } from 'maska';
import consultCep from '@/Utils/consultCep';

const form = useForm('userRegisterStep3', {
    cep: '',
    street: '',
    neighbor: '',
    city: '',
    state: '',
    number: '',
});

const page = usePage();

const nextStep = () => {

    form.clearErrors()

    if(!form.cep) {
        page.props.errors.cep = 'CEP é obrigatório'
        return;
    }

    cep = form.cep.replace(/[^\d]+/g, '');

    if(cep.length != 8) {
        page.props.errors.cep = 'CEP inválido'
        return;
    }

    if(!form.street) {
        page.props.errors.street = 'Rua é obrigatório'
        return;
    }

    if(!form.neighbor) {
        page.props.errors.neighbor = 'Bairro é obrigatório'
        return;
    }

    if(!form.city) {
        page.props.errors.city = 'Cidade é obrigatório'
        return;
    }

    if(!form.number) {
        page.props.errors.number = 'Número é obrigatório'
        return;
    }

    if(!form.state) {
        page.props.errors.state = 'Estado é obrigatório'
        return;
    }

    emit("nextStep")
};

function getAddress(cep) {
    
    cep = cep.replace(/[^\d]+/g, '');

    if(cep.length != 8) {
        return;
    }

    consultCep(cep).then((response) => {

        form.street = response.data.logradouro;
        form.neighbor = response.data.bairro;
        form.city = response.data.localidade;
        form.state = response.data.uf;
    })

}

const emit = defineEmits(["nextStep"])
</script>
<template>
    <div class="p-12 pt-8">

        <div class="mb-8">
            <h1 class="font-bold text-xl">
                Cadastro: Endereço
            </h1>
            <p class="text-gray-600">
                Próximo: Informações pessoais
            </p>
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="CEP" value="CEP:" />
            <TextInput
                id="cep"
                v-model="form.cep"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="cep"
                @change="getAddress($event.target.value)"
                v-maska 
                data-maska="#####-###"
            />
            <InputError class="mt-2" :message="$page.props.errors.cep" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="street" value="Rua:" />
            <TextInput
                id="street"
                v-model="form.street"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="street"
            />
            <InputError class="mt-2" :message="$page.props.errors.street" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="neighbor" value="Bairro:" />
            <TextInput
                id="neighbor"
                v-model="form.neighbor"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="neighbor"
            />
            <InputError class="mt-2" :message="$page.props.errors.neighbor" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="city" value="Cidade:" />
            <TextInput
                id="city"
                v-model="form.city"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="city"
            />
            <InputError class="mt-2" :message="$page.props.errors.city" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="state" value="Estado:" />
            <TextInput
                id="state"
                v-model="form.state"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="state"
            />
            <InputError class="mt-2" :message="$page.props.errors.state" />

        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="number" value="Número:" />
            <TextInput
                id="number"
                v-model="form.number"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="number"
                v-maska 
                data-maska="#####"
            />
            <InputError class="mt-2" :message="$page.props.errors.number" />
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4" @click="nextStep()">
                Próximo
            </PrimaryButton>
        </div>
    </div>
</template>