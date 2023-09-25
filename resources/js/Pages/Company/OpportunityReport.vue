<script setup>

import ApplicationMark from '@/Components/ApplicationMark.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import CompanyAppLayout from '@/Layouts/CompanyAppLayout.vue';
import { onMounted, reactive, ref } from 'vue';

const props = defineProps({
    opportunity: Object,
    countByGender: Array,
    countByState: Array,
    countByAge: Array,
    countByDeficiency: Array,
});

const options = reactive({
    chart: {
        id: 'gender-chart'
    },
    xaxis: {
        categories: []
    }
})
      
const series = reactive([{
    name: 'genero',
    data: []
}])

//--------- state

const options2 = reactive({
    chart: {
        id: 'state'
    },
    xaxis: {
        categories: []
    }
})
      
const series2 = reactive([{
    name: 'Estados',
    data: []
}])

//--------- age

const options3 = reactive({
    chart: {
        id: 'age'
    },
    xaxis: {
        categories: []
    }
})
      
const series3 = reactive( [{
    name: 'Idade',
    data: []
}])

//--------- deficiency

const options4 = reactive({
    chart: {
        id: 'deficiency'
    },
    xaxis: {
        categories: []
    }
})
      
const series4 = reactive([{
    name: 'inclusão',
    data: []
}])

function mountGenderGraph(){
    if(!props.countByGender){
        return;
    }
    
    for(const gender of props.countByGender){
        options.xaxis.categories.push(gender.label)
        series[0].data.push(gender.total)
    }
}

function mountAgeGraph(){
    if(!props.countByAge){
        return;
    }
    
    for(const age of props.countByAge){
        options3.xaxis.categories.push(age.label)
        series3[0].data.push(age.total)
    }
}

function mountStateGraph(){
    if(!props.countByState){
        return;
    }
    
    for(const state of props.countByState){
        options2.xaxis.categories.push(state.label)
        series2[0].data.push(state.total)
    }
}

function mountDeficiencyGraph(){
    if(!props.countByDeficiency){
        return;
    }
    
    for(const deficiency of props.countByDeficiency){
        options4.xaxis.categories.push(deficiency.label)
        series4[0].data.push(deficiency.total)
    }
}

onMounted(()=> {

    mountGenderGraph()
    mountAgeGraph()
    mountStateGraph()
    mountDeficiencyGraph()

})

</script>

<template>
    <CompanyAppLayout title="Oportunidade">
        <section class="">
            
            <div class="flex justify-end">
                <Link :href="route('opportunity.edit', { opportunity: opportunity.id })">
                    <PrimaryButton>
                        Editar
                    </PrimaryButton>
                </Link>
            </div>

            <div class="flex justify-center items-center p-4">
                <ApplicationMark class="block h-20 md:h-32 w-auto" />
            </div>
            
            <div class="flex justify-center items-center p-4 mt-4">
                <h1 class="text-ey-black text-xl md:text-3xl font-bold">
                    {{ opportunity.name }}
                </h1>
            </div>

            <div class="mt-2 flex justify-center sm:justify-start">
                <div class="mr-6 flex flex-col sm:flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <p class="text-sm sm:text-base">
                        {{ opportunity.salary_start.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) }} 
                        - 
                        {{ opportunity.salary_end.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) }}</p>
                </div>

                <div class="mr-6 flex flex-col sm:flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>

                    <p class="text-sm sm:text-base">
                        {{ opportunity.address.city }}, {{ opportunity.address.state }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>

                    <p class="text-sm sm:text-base">{{ opportunity.company.company_name }}</p>
                </div>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                
                <span class="font-bold">Dados da Empresa:</span>
                
                <div class="flex mt-4">
                    <div class="p-4 bg-gray-300 rounded-lg">
                        <ApplicationMark class="block h-12 md:h-16 w-auto" />
                    </div>

                    <div class="ml-4">
                        <p class="font-bold">Nome: {{ opportunity.company.company_name }}</p>
                        <p class="text-sm text-gray-700">Área: {{ opportunity.company.company_area }}</p>
                        <p class="text-sm text-gray-700">Número de funcionarios: {{ opportunity.company.workers_number }}</p>
                    </div>
                </div>
                
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                
                <span class="font-bold">Descrição:</span>
                <p>
                    {{ opportunity.resume }}
                </p>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                
                <span class="font-bold">Cargo:</span>
                <p>
                    {{ opportunity.role }} -  
                    <span class="font-bold">
                        {{ opportunity.job_type }}
                    </span>
                </p>
               
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                
                <span class="font-bold">Competências:</span>
                <p>
                    {{ opportunity.competences }}
                </p>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                <span class="font-bold">Requisitos:</span>
                    
                <p>
                    {{ opportunity.requirements }}
                </p>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                <span class="font-bold">Responsabilidades:</span>
                <p>
                    {{ opportunity.responsabilities }}
                </p>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                <p>
                    <span class="font-bold">Horário:</span> {{ opportunity.work_start }} - {{ opportunity.work_end }}
                </p>
                <p>
                    <span class="font-bold">Regime:</span> {{ opportunity.hiring_regime }}
                </p>
                <p>
                    <span class="font-bold">Localização: </span> 
                    
                    <span v-if="opportunity.is_remote">Remoto</span>

                    <span v-else>
                        {{ opportunity.address.street }}, 
                        {{ opportunity.address.number }} - 
                        {{ opportunity.address.city }}, 
                        {{ opportunity.address.state }}
                    </span>
                </p>
                <p>
                    <span class="font-bold">Vaga para pessoa com deficiência(s): </span>
                    {{ opportunity.is_pcd ? 'Sim' : 'Não' }}
                </p>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                <p class="mb-4">
                    <span class="font-bold">Quantidade de candidatos:</span> {{ opportunity.applied_users_count }}
                </p>
                <p class="mb-4">
                    <span class="font-bold">Visualizações:</span> {{ opportunity.views }}
                </p>

                <Link :href="route('company.candidates', { opportunity: opportunity.id })">
                    <PrimaryButton>
                        Ver candidatos
                    </PrimaryButton>
                </Link>
            </div>

            <div class="mt-2 font-bold text-xl text-center">
                Estatísticas candidatos
            </div>

            <div class="grid grid-cols-3 gap-3 mt-4">
                <div class="mt-2 border p-2 rounded">
                    <h3 class="font-bold text-xl">
                        Por gênero:
                    </h3>

                    <div>
                        <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>
                    </div>
                </div>

                <div class="mt-2 border p-2 rounded">
                    <h3 class="font-bold text-xl">
                        Por idade:
                    </h3>

                    <div>
                        <apexchart width="500" type="bar" :options="options2" :series="series2"></apexchart>
                    </div>
                </div>

                <div class="mt-2 border p-2 rounded">
                    <h3 class="font-bold text-xl">
                        Por Localização:
                    </h3>

                    <div>
                        <apexchart width="500" type="bar" :options="options3" :series="series3"></apexchart>
                    </div>
                </div>

                <div class="mt-2 border p-2 rounded">
                    <h3 class="font-bold text-xl">
                        Inclusão (Pessoas com deficiência(s)):
                    </h3>

                    <div>
                        <apexchart width="500" type="bar" :options="options4" :series="series4"></apexchart>
                    </div>
                </div>
            </div>

        </section>
    </CompanyAppLayout>
</template>