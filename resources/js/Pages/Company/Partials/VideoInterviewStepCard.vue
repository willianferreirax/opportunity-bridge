<script setup>
import { computed, onUpdated, ref } from 'vue';


const props = defineProps({
    step: Object,
    order: Number,
    passed: Boolean,
    opportunityUser: Object,
});

const videoLink = computed(() => {
    let videoLink = '';

    if (!props.opportunityUser){
        return videoLink;
    }

    for(const interview of props.opportunityUser.videoInterviews) {
        if(interview.video_step_id == props.step.id) {
            videoLink = interview.id;
        }
    }

    return videoLink;
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

        <a v-if="videoLink != ''" :href="route('candidate.downloadVideoInterview', {video: videoLink})" download class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
            <svg class="w-3.5 h-3.5 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
            </svg> 
            Download Video
        </a>
        <div v-else>
            Usuário ainda não enviou o vídeo
        </div>

    </li>
</template>