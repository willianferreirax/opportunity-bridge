<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SearchBar from '@/Components/SearchBar.vue';
import { Link } from '@inertiajs/vue3';
import AppliedOpportunityCard from '@/Components/AppliedOpportunityCard.vue';
import RecommendedOpportunityCard from '@/Components/RecommendedOpportunityCard.vue';
</script>

<template>
    <AppLayout title="Dashboard">

        <div class="mt-4 px-8 md:px-32">
            <Link :href="route('opportunity.list')">
                <SearchBar></SearchBar>
            </Link>
        </div>

        <section class="">
            
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Vagas recomendadas</h2>
            
            <div class="bg-gray-200 rounded-lg py-8 px-8 mt-8">

                <RecommendedOpportunityCard>
                    
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
                <AppliedOpportunityCard>

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
