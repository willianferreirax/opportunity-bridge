<script setup>

import PrimaryButton from '@/Components/PrimaryButton.vue';
import AdminAppLayout from '@/Layouts/AdminAppLayout.vue';
import UploadCertificatesModal from './Partials/UploadCertificatesModal.vue';
import { onMounted, reactive, ref } from 'vue';

const props = defineProps({
    newOpportunities: Array,
    newUsers: Array,
    newCompanies: Array,
})

const createModal = ref(false);

const openOrCloseCreateModal = () => {
    createModal.value = !createModal.value;
}

const options = reactive({
    chart: {
        id: 'vagas'
    },
    xaxis: {
        categories: []
    }
})
      
const series = reactive([{
    name: 'vagas',
    data: []
}])

//--------- empresas

const options2 = reactive({
    chart: {
        id: 'empresas'
    },
    xaxis: {
        categories: []
    }
})
      
const series2 = reactive([{
    name: 'empresas',
    data: []
}])

//--------- usuarios

const options3 = reactive({
    chart: {
        id: 'usuarios'
    },
    xaxis: {
        categories: []
    }
})
      
const series3 = reactive( [{
    name: 'usuarios',
    data: []
}])

function mountJobsGraph(){
    if(!props.newOpportunities){
        return;
    }
    
    for(const job of props.newOpportunities){
        options.xaxis.categories.push(job.label)
        series[0].data.push(job.total)
    }
}

function mountUserGraph(){
    if(!props.newUsers){
        return;
    }
    
    for(const user of props.newUsers){
        options3.xaxis.categories.push(user.label)
        series3[0].data.push(user.total)
    }
}

function mountCompanyGraph(){
    if(!props.newCompanies){
        return;
    }
    
    for(const company of props.newCompanies){
        options2.xaxis.categories.push(company.label)
        series2[0].data.push(company.total)
    }
}


onMounted(()=> {

    mountJobsGraph()
    mountUserGraph()
    mountCompanyGraph()

})

</script>

<template>
    <AdminAppLayout title="Dashboard">

        <UploadCertificatesModal :show="createModal" maxWidth="4xl" @close="openOrCloseCreateModal" />
        
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold ">
                Bem vindo, {{ $page.props.auth.user.name }}
            </h1>
            
            <PrimaryButton @click="openOrCloseCreateModal">
                Certificados
            </PrimaryButton>
        </div>

        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

        <h2 class="text-2xl font-bold ">
            Vagas cadastradas
        </h2>

        <div class="mt-4 flex justify-center">
            <div>
                <apexchart width="500" type="line" :options="options" :series="series"></apexchart>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Mensagens suporte: (mock)</h2>

            <div class="bg-gray-200 rounded-lg p-4 sm:p-8 mt-8">

                <div class="bg-white p-4 mb-4 rounded-lg">
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <p class="font-bold mb-1">João Pedro - Microsoft</p>
                            <p class="text-gray-700 text-sm mb-1">Tipo: Bug report</p>
                            <p class="text-gray-700 text-sm">Data: 02/02/2021</p>
                        </div>

                        <div class="flex justify-center items-center">
                          
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex justify-end">
                <PrimaryButton class="mt-4">
                    Ver mais
                </PrimaryButton>
            </div>
        </div>

        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

        <div class="grid md:grid-cols-2 gap-3 mt-4">
            <div class="mt-2 border p-2 rounded">
                <h3 class="font-bold text-xl">
                    Novos candidatos:
                </h3>

                <div class="flex justify-center">
                    <apexchart width="500" type="line" :options="options3" :series="series3"></apexchart>
                </div>
            </div>

            <div class="mt-2 border p-2 rounded">
                <h3 class="font-bold text-xl">
                    Novas empresas:
                </h3>

                <div class="flex justify-center">
                    <apexchart width="500" type="line" :options="options2" :series="series2"></apexchart>
                </div>
            </div>

        </div>


    </AdminAppLayout>
</template>