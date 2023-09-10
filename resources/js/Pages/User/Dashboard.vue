<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, router } from '@inertiajs/vue3';
import AppliedOpportunityCard from '@/Components/AppliedOpportunityCard.vue';
import RecommendedOpportunityCard from '@/Components/RecommendedOpportunityCard.vue';
import { ref } from 'vue';

const props = defineProps({
    opportunities: Object,
    lastApplied: Object,
});

const params = new URLSearchParams(window.location.search)
const defaultValue = ''

const search = params.has('search') ? params.get('search') : defaultValue
const searchRef = ref(search)

const loadAnnouncedJobsList = () => {
    router.get(route('opportunity.list'), { 
        search: searchRef.value,
    }, { preserveState: true });
}

</script>

<template>
    <AppLayout title="Dashboard">

        <div class="mt-4 px-8 md:px-32">
            
            <div>   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        
                    </div>
                    <input 
                        type="text" 
                        id="default-search" 
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="Busque sua vaga"
                        @keyup.enter.native="loadAnnouncedJobsList" 
                        v-model="searchRef"
                    >
                    <div class="text-ey-black absolute right-2.5 bottom-1.5 focus:ring-4 font-medium rounded-lg text-sm px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>
            
        </div>

        <section class="">
            
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Vagas recomendadas</h2>
            
            <div class="bg-gray-200 rounded-lg py-8 px-8 mt-8">

                <RecommendedOpportunityCard
                    v-for="opportunity in opportunities"
                    :key="opportunity.id"
                    :opportunity="opportunity"
                >
                    
                </RecommendedOpportunityCard>

            </div>

            <div class="flex justify-end">
                <Link :href="route('user.recommendedJobs')">
                    <PrimaryButton class="mt-4">
                        Ver mais vagas
                    </PrimaryButton>
                </Link>
               
            </div>

            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Suas candidaturas</h2>

            <div class="bg-gray-200 rounded-lg py-8 px-8 mt-8">
                <AppliedOpportunityCard
                    v-for="opportunity in lastApplied"
                    :key="opportunity.id"
                    :opportunity="opportunity"
                >

                </AppliedOpportunityCard>

            </div>

            <div class="flex justify-end">
                <Link :href="route('user.appliedJobs')">
                    <PrimaryButton class="mt-4">
                        Ver mais vagas
                    </PrimaryButton>
                </Link>
                
            </div>


        </section>

    </AppLayout>
</template>
