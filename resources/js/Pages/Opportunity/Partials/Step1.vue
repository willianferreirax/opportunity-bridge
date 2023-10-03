<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import StandardSelect from '@/Components/StandardSelect.vue';
import StandardTextArea from '@/Components/StandardTextArea.vue';
import VueSelect from "vue-select";
import { vMaska } from 'maska';
import { onMounted, ref } from 'vue';

const form = useForm('opportunityRegisterStep1', {
    name: 'Desenvolvedor PHP',
    role: 'Desenvolvedor PHP Pleno',
    resume: 'Estamos em busca de um desenvolvedor PHP para trabalhar em um projeto de 3 meses',
    regime: 'PJ',
    type: 'Temporario',
    pcd: true,
    workHour_start: '08:30',
    workHour_end: '18:00',
    targetUsers: [1,2],
    salary_start: '3.000,00',
    salary_end: '4.000,00',
    quantity: '2',
});

const type = ref([])

const page = usePage();

function nextStep() {

    emit('resetForm', form.data())

    if(!form.name) {
        page.props.errors.name = 'Nome é obrigatório'
        return;
    }

    if(!form.role) {
        page.props.errors.role = 'Cargo é obrigatório'
        return;
    }

    if(!form.resume) {
        page.props.errors.resume = 'Resumo da vaga é obrigatório'
        return;
    }

    if(!form.regime) {
        page.props.errors.regime = 'Regime de contratação é obrigatório'
        return;
    }

    if(!form.type) {
        page.props.errors.type = 'Tipo de vaga é obrigatório'
        return;
    }

    if(!form.workHour_start) {
        page.props.errors.workHour_start = 'Horário de trabalho é obrigatório'
        return;
    }

    if(!form.workHour_end) {
        page.props.errors.workHour_end = 'Horário de trabalho é obrigatório'
        return;
    }

    if(!form.salary_start) {
        page.props.errors.salary_start = 'Salário é obrigatório'
        return;
    }

    if(!form.salary_end) {
        page.props.errors.salary_end = 'Salário é obrigatório'
        return;
    }

    //make sure that the start salary is before the end salary
    if(compareValues(form.salary_start, form.salary_end)) {
        page.props.errors.salary_start = 'Salário inicial deve ser menor que o salário final'
        return;
    }

    if(!form.quantity) {
        page.props.errors.quantity = 'Quantidade de vagas é obrigatório'
        return;
    }
    
    emit('nextStep')
};

function compareValues(a, b) {
    // Remove thousands separators and replace the decimal comma with a period
    const cleanA = a.replace(/\./g, '').replace(',', '.');
    const cleanB = b.replace(/\./g, '').replace(',', '.');

    // Convert to numbers
    const numA = parseFloat(cleanA);
    const numB = parseFloat(cleanB);

    // Check if numA is greater than numB
    if (!isNaN(numA) && !isNaN(numB)) {
        return numA > numB;
    }

}

onMounted(() => {
    type.value = page.props.deficiences.map((item) => {
        return {
            label: item.deficiency,
            value: item.id,
        }
    })
})

const emit = defineEmits(['nextStep', 'resetForm'])
</script>

<template>
    <div class="p-12 pt-8">
        
        <div class="mt-4">
            <InputLabel class="mb-2" for="name" value="Dê um nome pra sua vaga:" />
            <TextInput
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.name" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="role" value="Cargo:" />
            <TextInput
                id="role"
                v-model="form.role"
                type="text"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.role" />
        </div>


        <div class="mt-4">
            <InputLabel class="mb-2" for="benefits" value="Resumo da vaga:" />
            <StandardTextArea
                id="benefits"
                v-model="form.resume"
                rows="8"
                class="mt-1 block w-full"
                required
            />
            <InputError class="mt-2" :message="$page.props.errors.resume" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="regime" value="Regime de contratação:" />
            <StandardSelect
                v-model="form.regime"
            >
                <option value="CLT">CLT</option>
                <option value="PJ">PJ</option>
                <option value="Estágio">Estágio</option>
                <option value="Cooperado">Cooperado</option>

            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.regime" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="type" value="Tipo de vaga:" />
            <StandardSelect
                v-model="form.type"
            >
                <option value="Efetivo">Efetivo</option>
                <option value="Temporario">Temporario</option>
            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.type" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="workHour" value="Horário de trabalho:" />
            <div class="flex">
               
               <div class="flex flex-col justify-center">
                   
                    <TextInput
                        id="workHour"
                        v-model="form.workHour_start"
                        type="time"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError class="mt-2" :message="$page.props.errors.workHour_start" />
               
               </div>

               <div class="mx-2 flex items-center justify-center">
                   Até
               </div>

               <div class="flex flex-col justify-center">
                   
                <TextInput
                    id="workHour"
                    v-model="form.workHour_end"
                    type="time"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="$page.props.errors.workHour_end" />

               </div>
           </div>
            
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
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Vaga para pessoa com deficiência ?</span>
            </label>
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="targetUsers" value="Candidatos alvo:" />
            <vue-select 
                :disabled="!form.pcd"
                :aria-disabled="!form.pcd"
                v-model="form.targetUsers" 
                :options="type" 
                multiple 
                clearable
                :reduce="deficiency => deficiency.value" 
                :closeOnSelect="false"
                id="type"
                aria-multiselectable="true"
                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
            </vue-select>
            <InputError class="mt-2" :message="$page.props.errors.targetUsers" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="salary" value="Salário:" />
            <div class="flex">
               
                <div class="flex flex-col justify-center">
                    <TextInput
                        id="salary"
                        v-model="form.salary_start"
                        type="text"
                        class="mt-1 block"
                        v-maska
                        data-maska="9.99#,##"
                        data-maska-tokens="9:[0-9]:repeated"
                        data-maska-reversed="true"
                        aria-required="true"
                        required
                    />
                    <InputError class="mt-2" :message="$page.props.errors.salary_start" />
                
                </div>

                <div class="mx-2 flex items-center justify-center">
                    Até
                </div>

                <div class="flex flex-col justify-center">
                    <TextInput
                        id="salary"
                        v-model="form.salary_end"
                        type="text"
                        class="mt-1 block"
                        v-maska
                        data-maska="9.99#,##"
                        data-maska-tokens="9:[0-9]:repeated"
                        data-maska-reversed="true"
                        aria-required="true"
                        required
                    />
                    <InputError class="mt-2" :message="$page.props.errors.salary_end" />

                </div>
            </div>
            
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="quantity" value="Quantidade de vagas:" />
            <input 
                v-model="form.quantity"
                type="number" 
                id="quantity" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                placeholder=""
                v-maska
                data-maska="####"
                required
            >
            <InputError class="mt-2" :message="$page.props.errors.quantity" />
        </div>

        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4" @click="nextStep">
                Próximo
            </PrimaryButton>
        </div>
    </div>
</template>
<style>
@import "vue-select/dist/vue-select.css";
</style>