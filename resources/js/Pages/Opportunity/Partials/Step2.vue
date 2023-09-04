<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import StandardTextArea from '@/Components/StandardTextArea.vue';

const form = useForm('opportunityRegisterStep2', {
    benefits: '',
    pcd: false,
    skills: '',
    requisites: '',
    responsabilities: '',
    remote: false,
});

const page = usePage();

function nextStep() {

    emit('resetForm', form.data())

    if(!form.benefits) {
        page.props.errors.benefits = 'Benefícios é obrigatório'
        return;
    }

    if(!form.skills) {
        page.props.errors.skills = 'Competências é obrigatório'
        return;
    }

    if(!form.requisites) {
        page.props.errors.requisites = 'Requisitos é obrigatório'
        return;
    }

    if(!form.responsabilities) {
        page.props.errors.responsabilities = 'Responsabilidades é obrigatório'
        return;
    }
    
    emit('nextStep')
};
const emit = defineEmits(['nextStep', 'resetForm'])

</script>

<template>
    <div class="p-12 pt-8">
        <div class="mt-4">
            <InputLabel class="mb-2" for="benefits" value="Beneficios:" />
            <StandardTextArea
                id="benefits"
                v-model="form.benefits"
                rows="4"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.benefits" />
        </div>

        <div class="mt-4">
            <label class="relative inline-flex items-center cursor-pointer">
                <input
                    v-model="form.pcd"  
                    type="checkbox" 
                    value="" 
                    class="sr-only peer"
                >
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Vaga para PCD ?</span>
            </label>
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="skills" value="Competências:" />
            <StandardTextArea
                id="skills"
                v-model="form.skills"
                rows="4"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.skills" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="requisites" value="Requisitos:" />
            <StandardTextArea
                id="requisites"
                v-model="form.requisites"
                rows="4"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.requisites" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="responsabilities" value="Responsabilidades:" />
            <StandardTextArea
                id="responsabilities"
                v-model="form.responsabilities"
                rows="4"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.responsabilities" />
        </div>

        <div class="mt-4">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-600"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Trabalho remoto ?</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4" @click="nextStep">
                Próximo
            </PrimaryButton>
        </div>

    </div>
</template>