<script setup>
import AnnouncedOpportunityCard from '@/Components/AnnouncedOpportunityCard.vue';

import SearchBar from '@/Components/SearchBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';


</script>

<template>
    <AppLayout title="Announced jobs">
        <section class="">
            <div class="mt-4">
                <h1 class="text-3xl font-bold ">
                    Lista de vagas anunciadas
                </h1>
            </div>

            <div class="mt-4">
                <SearchBar></SearchBar>
            </div>

            <div class="mt-4 flex flex-col items-center">
                <AnnouncedOpportunityCard
                    v-for="n in 3"
                >
                </AnnouncedOpportunityCard>
            </div>

        </section>
    </AppLayout>
</template>