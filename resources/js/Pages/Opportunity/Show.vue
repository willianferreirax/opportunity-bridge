<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';
import { computed, ref } from 'vue';
import moment from 'moment';

const props = defineProps({
    opportunity: Object,
    hasApplied: Boolean,
    opportunityUser: Object,
    opportunitySteps: Object,
});

function aplicar(){
    router.post(route('user.apply', {opportunity: props.opportunity.id}),
    {},
    {
        onSuccess: () => {
            toast.success('Candidatura enviada com sucesso!')
        },
    });
}

const interviewDate = computed(() => {

    for(const interview of props.opportunityUser.pivot.interviews) {
        if(interview.interview_step_id == props.opportunitySteps[props.opportunityUser.pivot.current_step].id) {
            return moment(interview.date).format("DD/MM/YYYY HH:MM:SS");
        }
    }

    return "Ainda não marcada :(";
});

const sendVideo = (event) => {
    
    router.post(route('candidate.setVideoInterview'), { 
        opportunityUser: props.opportunityUser.pivot.id, 
        step: props.opportunitySteps[props.opportunityUser.pivot.current_step].id,
        file: event.target.files[0]
    }, {
        preserveState: true,
        onSuccess: () => {
            toast.success('Video enviado com sucesso!')
        },
        onError: () => {
            toast.error('Erro ao enviar video!')
        },
    })

}

</script>

<template>
    <AppLayout title="Oportunidade">
        <section class="">

            <div v-if="hasApplied">
                <div class="mb-4 font-bold text-lg sm:text-2xl">
                    Progesso da candidatura
                </div>
                <div>
                    <div class="flex justify-evenly">
                        <div v-for="(steps, key) in opportunitySteps"  class="flex flex-col items-center">
                            <div 
                                class="h-[8px] w-[50px] mr-2 border-ey-black border"
                                :class="{
                                    'bg-ey-yellow': opportunityUser.pivot.current_step >= key,
                                    'bg-ey-black': opportunityUser.pivot.current_step < key,
                                }"
                            >
                            </div>
                            {{ steps.name }} {{ key }}
                        </div>
                        
                    </div>
                </div>

                <div class="mt-12">
                    <div class="mb-4 font-bold text-lg sm:text-2xl">
                        Passo {{ opportunityUser.pivot.current_step + 1 }} - {{ opportunitySteps[opportunityUser.pivot.current_step].name }}
                    </div>
                    <div class="mb-4 font-bold">
                        Descrição:
                    </div>
                    <div>
                        {{ opportunitySteps[opportunityUser.pivot.current_step].description }}
                    </div>

                    <div v-if="opportunitySteps[opportunityUser.pivot.current_step].type == 'VideoInterviewStepCard'">

                    
                        <p class="mt-4">
                            Você tem
                            <strong> 
                                {{ opportunitySteps[opportunityUser.pivot.current_step].limit_days }}
                                dias 
                            </strong>
                            para enviar o video. 
                        </p>
                    
                        
                     
                        <div class="flex justify-start mt-4">
                            
                            <label class="w-48 flex flex-col items-center px-4 py-2 rounded-lg uppercase border border-ey-yellow cursor-pointer hover:text-ey-yellow">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <span class="mt-2 text-sm leading-normal">Enviar video</span>
                                <input type='file' class="hidden" @change="sendVideo($event)" accept="video/*"/>
                            </label>
                           

                        </div>
                            
                    </div>

                    <div v-if="opportunitySteps[opportunityUser.pivot.current_step].type == 'InterviewStepCard'">
                     
                        <div class="mt-4">
                         
                            <p>
                                Você tem uma entrevista marcada para: 
                                <strong>{{ interviewDate }}</strong>
                            </p>

                        </div>
                         
                    </div>

                    <div v-if="opportunitySteps[opportunityUser.pivot.current_step].type == 'TestInterviewStepCard'">
                     
                        <div class="mt-4">
                        
                            <p>
                                Acesse o link: 
                                <strong>
                                    <a :href="'//' +  opportunitySteps[opportunityUser.pivot.current_step].link" target="_blank">
                                        {{ opportunitySteps[opportunityUser.pivot.current_step].link }}
                                    </a>
                                </strong>
                            </p>

                            <p class="mt-4">
                                Você tem
                                <strong> 
                                    {{ opportunitySteps[opportunityUser.pivot.current_step].limit_days }}
                                    dias 
                                </strong>
                                para realizar o teste. 
                            </p>

                        </div>
                        
                    </div>
                </div>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
            
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

                    <p class="text-sm sm:text-base">{{ opportunity.salary_start.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) }} 
                        - 
                        {{ opportunity.salary_end.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) }}</p>

                </div>

                <div class="mr-6 flex flex-col sm:flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>

                    <p class="text-sm sm:text-base">{{ opportunity.address.city }}, {{ opportunity.address.state }}</p>
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
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <ApplicationMark class="block h-12 md:h-16 w-auto" />
                    </div>

                    <div class="ml-4">
                        <p class="font-bold">{{ opportunity.company.company_name }}</p>
                        <p class="text-sm text-gray-700">{{ opportunity.company.company_area }}</p>
                    </div>
                </div>
                
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                
                <span class="font-bold">Competências:</span>
                {{ opportunity.competences }}
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="mt-2">
                <span class="font-bold">Requisitos:</span>
                    
                {{ opportunity.requirements }}
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
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div v-if="!hasApplied" class="flex justify-between md:justify-center mt-2">
                <PrimaryButton class="mr-0 md:mr-4" @click="aplicar()">
                    Aplicar
                </PrimaryButton>
            </div>

        </section>
    </AppLayout>
</template>
<style>
@import 'vue3-toastify/dist/index.css';

</style>
