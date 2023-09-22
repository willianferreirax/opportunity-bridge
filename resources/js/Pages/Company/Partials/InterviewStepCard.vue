<script setup>
import { router } from '@inertiajs/vue3';
import VueDatepicker from '@vuepic/vue-datepicker';
import { computed } from 'vue';
import { toast } from 'vue3-toastify';

const format = (date) => {
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    let hour = date.getHours();
    let minute = date.getMinutes();

    if(hour < 10) hour = '0' + hour;
    if(minute < 10) minute = '0' + minute;
    if(day < 10) day = '0' + day;
    if(month < 10) month = '0' + month;

  return `${day}/${month}/${year} ${hour}:${minute}`;
}

const props = defineProps({
    step: Object,
    order: Number,
    passed: Boolean,
    opportunityUser: Object,
});

const setInterviewDate = () => {
    
    router.post(route('candidate.setInterviewDate'), { 
        opportunityUser: props.opportunityUser.id, 
        step: props.step.id,
        date: format(date.value)
    }, {
        preserveState: true,
        onSuccess: () => {
            toast.success('Data de entrevista marcada com sucesso!')
        },
        onError: () => {
            toast.error('Erro ao marcar data de entrevista!')
        },
    })

}

const date = computed(() => {
    let date = new Date();

    if (!props.opportunityUser){
        return date;
    }

    for(const interview of props.opportunityUser.interviews) {
        if(interview.interview_step_id == props.step.id) {
            date = new Date(interview.date);
        }
    }

    return date;
})

</script>

<template>
    <li class="mb-10 ml-6">            
        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
            <div v-if="!passed">
                {{order}}
            </div>

            <svg v-if="passed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-800 dark:text-blue-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>

        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
            {{step.name}}
            <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">
                {{ passed ? 'Aprovado' : 'Aguardando' }}
            </span>
        </h3>
        
        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{step.description}}
        </p>

        <button @click="setInterviewDate()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
            </svg>

            Marcar entrevista
        </button>

        <vue-datepicker class="mt-3" v-model="date" :format="format" />
        
    </li>
</template>