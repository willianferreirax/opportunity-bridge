<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import StandardSelect from '@/Components/StandardSelect.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import StandardTextArea from '@/Components/StandardTextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProcessStepCard from '@/Components/ProcessStepCard.vue';
import AddProcessStepModal from './Partials/AddProcessStepModal.vue';
import { ref } from 'vue';

const form = useForm({
    name: '',
    role: '',
    type: '',
    regime: '',
    workHour: '',
    salary: '',
    benefits: '',
    skills: '',
    requisites: '',
    responsabilities: '',
    targetUsers: [],
    processSteps: [],
});

const createModal = ref(false);

const openOrCloseCreateModal = () => {
    createModal.value = !createModal.value;
}

function addProcessStep(step) {
    form.processSteps.push(step)
}

</script>
<template>
    <AppLayout title="Create opportunity">

        <AddProcessStepModal
            :show="createModal"
            :max-width="'4xl'"
            @close="openOrCloseCreateModal"
            @add="addProcessStep"
        />

        <section class="">

            <div class="mt-4">
                <h1 class="text-3xl font-bold ">
                    Criar vaga
                </h1>
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="name" value="Dê um nome pra sua vaga:" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="role" value="Cargo:" />
                <StandardSelect
                    v-model="form.role"
                >
                    <option value="1">Cargo 1</option>
                    <option value="2">Cargo 2</option>

                </StandardSelect>
                <InputError class="mt-2" :message="form.errors.role" />
            </div>


            <div class="mt-4">
                <InputLabel class="mb-2" for="benefits" value="Resumo da vaga:" />
                <StandardTextArea
                    id="benefits"
                    v-model="form.benefits"
                    rows="8"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.benefits" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="regime" value="Regime de contratação:" />
                <StandardSelect
                    v-model="form.regime"
                >
                    <option value="1">CLT</option>
                    <option value="2">PJ</option>
                    <option value="3">Estágio</option>
                    <option value="4">Cooperado</option>

                </StandardSelect>
                <InputError class="mt-2" :message="form.errors.regime" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="type" value="Tipo de vaga:" />
                <StandardSelect
                    v-model="form.type"
                >
                    <option value="1">Efetivo</option>
                    <option value="2">Temporario</option>
                </StandardSelect>
                <InputError class="mt-2" :message="form.errors.type" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="workHour" value="Horário de trabalho:" />
                <TextInput
                    id="workHour"
                    v-model="form.workHour"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.workHour" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="targetUsers" value="Candidatos alvo:" />
                <StandardSelect
                    v-model="form.targetUsers"
                >
                    <option value="1">Branca</option>
                    <option value="2">Preta</option>
                    <option value="3">Amarela</option>
                    <option value="4">Parda</option>
                    <option value="5">Indígena</option>
                </StandardSelect>
                <InputError class="mt-2" :message="form.errors.targetUsers" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="salary" value="Salário:" />
                <div class="flex">
                    <TextInput
                        id="salary"
                        v-model="form.salary"
                        type="text"
                        class="mt-1 block w-1/4"
                        required
                    />
                    <div class="mx-2 flex items-center">
                        Até
                    </div>
                    <TextInput
                        id="salary"
                        v-model="form.salary2"
                        type="text"
                        class="mt-1 block w-1/4"

                    />
                </div>
                
                <div class="mt-2">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Salário Fixo</span>
                    </label>
                </div>

                <InputError class="mt-2" :message="form.errors.salary" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="quantity" value="Quantidade de vagas:" />
                <input type="number" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="benefits" value="Beneficios:" />
                <StandardTextArea
                    id="benefits"
                    v-model="form.benefits"
                    rows="4"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.benefits" />
            </div>

            <div class="mt-4">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
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
                <InputError class="mt-2" :message="form.errors.skills" />
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
                <InputError class="mt-2" :message="form.errors.requisites" />
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
                <InputError class="mt-2" :message="form.errors.responsabilities" />
            </div>

            <div class="mt-4">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Trabalho remoto ?</span>
                </label>
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

            <div class="mt-4">
                <div class="p-4 mb-4">
                    <div class="flex justify-between mb-4">
                        <div class="font-bold text-base sm:text-2xl">
                            Etapas do processo seletivo:
                        </div>

                        <div>
                            <svg
                                @click="openOrCloseCreateModal" 
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                    </div>

                    <ProcessStepCard v-for="step in form.processSteps"></ProcessStepCard>
                    
                </div>
            </div>

            <div class="flex items-center justify-center mt-4">
            
                <PrimaryButton class="ml-4">
                    Salvar
                </PrimaryButton>
            </div>
        </section>
        
    </AppLayout>
</template>