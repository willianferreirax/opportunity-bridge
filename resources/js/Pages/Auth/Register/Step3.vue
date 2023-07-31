<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm('userRegisterStep3', {
    cep: '',
    street: '',
    neighbor: '',
    city: '',
    number: '',
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
            />
            <InputError class="mt-2" :message="form.errors.cep" />
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
            <InputError class="mt-2" :message="form.errors.street" />
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
            <InputError class="mt-2" :message="form.errors.neighbor" />
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
            <InputError class="mt-2" :message="form.errors.city" />
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
            />
            <InputError class="mt-2" :message="form.errors.number" />
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4">
                Próximo
            </PrimaryButton>
        </div>
    </form>
</template>