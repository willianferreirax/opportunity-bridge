<script setup>

import CandidateCard from '@/Pages/Company/Partials/CandidateCard.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Candidate List">

        <h1 class="font-bold text-xl sm:text-4xl mb-8">
            Candidatos aplicantes
        </h1>

        <section class="sm:p-12 pt-12 flex items-center justify-between flex-col sm:flex-row">
            
            <CandidateCard
                class="mb-4"
                v-for="n in 3"
            >
            </CandidateCard>

            </section>
    </AppLayout>
</template>