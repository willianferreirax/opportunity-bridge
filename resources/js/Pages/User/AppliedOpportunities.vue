<script setup>
import OpportunityCard from '@/Components/OpportunityCard.vue';
import SearchBar from '@/Components/SearchBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    opportunities: Object,
});

</script>

<template>
    <AppLayout title="Procura vagas">
        
        <!-- <div class="mt-4 px-8 md:px-32">

            <SearchBar></SearchBar>

        </div> -->

        <section class="p-12 flex flex-col items-center">

            <h1 class="mb-12 text-3xl font-bold">
                Vagas aplicadas
            </h1>

            <OpportunityCard
                v-for="opportunity in opportunities.data"
                :key="opportunity.id"
                :opportunity="opportunity"
            >
            </OpportunityCard>

        </section>

        <Pagination :data="opportunities"></Pagination>

    </AppLayout>
</template>