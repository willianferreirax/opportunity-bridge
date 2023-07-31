<script setup>
import FloatingButton from '@/Components/FloatingButton.vue';
import OpportunityCard from '@/Components/OpportunityCard.vue';
import SearchBar from '@/Components/SearchBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

</script>

<template>
    <AppLayout title="Procura vagas">
        
        <div class="mt-4 px-8 md:px-32">

            <SearchBar></SearchBar>

        </div>

        <section class="sm:p-12 pt-12 flex flex-col items-center">

            <OpportunityCard
                v-for="n in 3"
            >
            </OpportunityCard>

        </section>

        <FloatingButton>
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>

            </template>
        </FloatingButton>

    </AppLayout>
</template>