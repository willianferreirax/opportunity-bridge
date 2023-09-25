<script setup>

import CandidateCard from '@/Pages/Company/Partials/CandidateCard.vue';
import { computed, ref } from 'vue';
import VideoInterviewStepCard from '@/Pages/Company/Partials/VideoInterviewStepCard.vue';
import TestInterviewStepCard from '@/Pages/Company/Partials/TestInterviewStepCard.vue';
import InterviewStepCard from '@/Pages/Company/Partials/InterviewStepCard.vue';
import SimpleInterviewStepCard from '@/Pages/Company/Partials/SimpleInterviewStepCard.vue';
import CompanyAppLayout from '@/Layouts/CompanyAppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

const props = defineProps({
    opportunity: Object,
    opportunitySteps: Object,
    appliedUsers: Object,
});

const open = ref(false);

const selectedUser = ref(null);

const componentMapping = {
    'SimpleInterviewStepCard': SimpleInterviewStepCard,
    'VideoInterviewStepCard': VideoInterviewStepCard,
    'TestInterviewStepCard': TestInterviewStepCard,
    'InterviewStepCard': InterviewStepCard,
};

const openDrawer = (user) => {
    open.value = !open.value;
    selectedUser.value = user
}

const nextStep = () => {
    router.post(route('candidate.nextStep'), { opportunityUser: selectedUser.value.pivot.id }, {
        preserveState: true,
        onSuccess: () => {
            toast.success('Etapa avançada com sucesso!')
            selectedUser.value.pivot.current_step += 1;
        },
        onError: () => {
            toast.error('Erro ao avançar etapa!')
        },
    })
}

const backStep = () => {
    router.post(route('candidate.backStep'), { opportunityUser: selectedUser.value.pivot.id }, {
        preserveState: true,
        onSuccess: () => {
            toast.success('Etapa retornada com sucesso!')
            selectedUser.value.pivot.current_step -= 1;
        },
        onError: () => {
            toast.error('Erro ao avançar etapa!')
        },
    })
}

</script>

<template>
    <CompanyAppLayout title="Candidate List">

        <h1 class="font-bold text-xl sm:text-4xl mb-8">
            Candidatos aplicantes
        </h1>

        <section class="sm:p-12 pt-12 grid grid-cols-3">
            
            <CandidateCard
                class="mb-4"
                @click="openDrawer(user)"
                v-for="user in appliedUsers.data"
                :key="user.id"
                :user="user"
            >
            </CandidateCard>

        </section>

        <Pagination :data="appliedUsers"></Pagination>

        <div :class="{ 'translate-x-full': !open, 'translate-x-none' : open }" class="fixed top-0 right-0 z-[99] h-screen p-4 overflow-y-auto shadow-2xl transition-transform bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
            <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                Etapas
            </h5>

            <button @click="open = !open" type="button" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <div class="flex mb-4">
                <img 
                    class="w-12 h-12 rounded-full" 
                    :src="selectedUser?.profile_photo_url" :alt="selectedUser?.name" 
                />
                <div class="ml-4">
                    <h3 class="font-bold ">
                        {{ selectedUser?.name ?? "" }}
                    </h3>
                    <h6 class="text-gray-500">
                        {{ selectedUser?.address?.city ?? "" }}, {{ selectedUser?.address?.state ?? "" }}
                    </h6>
                </div>
            </div>

            <div class="mt-2 flex justify-between">
                <PrimaryButton @click="backStep()">
                    Voltar etapa
                </PrimaryButton>

                <PrimaryButton @click="nextStep()">
                    Avançar etapa
                </PrimaryButton>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="m-2">

                <ol class="relative border-l border-gray-200 dark:border-gray-700">

                    <component 
                        v-for="(step, index) in opportunitySteps" 
                        :is="componentMapping[step.type]" 
                        :key="step.order" 
                        :passed="index < selectedUser?.pivot?.current_step"
                        :step="step"
                        :order="index + 1"
                        :opportunityUser="selectedUser?.pivot"
                    />

                </ol>

            </div>

        </div>

        

        <!-- <div :class="{ 'fixed': open, 'hidden': !open }" @click="open = !open" class="bg-gray-700 bg-opacity-50 dark:bg-opacity-80 inset-0 z-30"></div> -->
        <div :class="{ 'fixed': open, 'hidden': !open }" @click="open = !open" class="inset-0 z-30"></div>

    </CompanyAppLayout>

</template>