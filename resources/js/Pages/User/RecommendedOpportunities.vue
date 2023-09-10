<script setup>
import OpportunityCard from '@/Components/OpportunityCard.vue';
import Pagination from '@/Components/Pagination.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    opportunities: Object,
});

</script>

<template>
    <AppLayout title="Procura vagas">
        

        <section class="p-12 flex flex-col items-center">

            <h1 class="mb-12 text-3xl font-bold">
                Vagas recomendadas
            </h1>

            <OpportunityCard
                v-for="opportunity in opportunities.data"
                :key="opportunity.id"
                :opportunity="opportunity"
            >
            </OpportunityCard>

            <Pagination :data="opportunities"></Pagination>

        </section>

    </AppLayout>
</template>