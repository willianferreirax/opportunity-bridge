<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import FloatingButton from '@/Components/FloatingButton.vue';
import CandidateCard from '@/Components/CandidateCard.vue';
import AnnouncedOpportunityCard from '@/Components/AnnouncedOpportunityCard.vue';
</script>

<template>
    <AppLayout title="Dashboard">

        <section class="">

            <div class="flex justify-between p-8 pl-0">
                <h1 class="text-3xl font-bold ">
                    Bem vindo, xxxx
                </h1>

                <div class="hidden sm:block">
                    <Link :href="route('opportunity.create')">
                        <PrimaryButton>
                            Criar vaga
                        </PrimaryButton>
                    </Link>
                </div>

            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Aplicações recentes</h2>

            <div class="bg-gray-200 rounded-lg p-4 sm:p-8 mt-8">

                <CandidateCard />

            </div>

            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Suas vagas</h2>

            <div class="bg-gray-200 rounded-lg p-4 sm:p-8 mt-8">

                <AnnouncedOpportunityCard class="bg-white">

                </AnnouncedOpportunityCard>

            </div>

            <div class="flex justify-end">
                <Link :href="route('company.announced')">
                    <PrimaryButton class="mt-4">
                        Ver mais
                    </PrimaryButton>

                </Link>
            </div>

            <Link :href="route('opportunity.create')">
                <FloatingButton>
                    <template #icon>
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                        </svg>
                    </template>
                </FloatingButton>
            </Link>


        </section>

    </AppLayout>
</template>
