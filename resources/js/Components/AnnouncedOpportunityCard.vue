<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from './PrimaryButton.vue';
import moment from 'moment';

defineProps({
    opportunity: Object,
});

</script>

<template>
    
    <Link :href="route('company.opportunitiy.report', { opportunity: opportunity.id})" class="flex bg-gray-100 w-full rounded-lg p-4">
        <div class="w-full flex flex-col justify-center sm:px-0 pr-4">
            <div>
                <h2 class="font-bold sm:text-xl">
                    {{ opportunity.name }}
                </h2>
            </div>

            <div class="flex justify-between">
                <div class="text-sm sm:text-base text-gray-700">
                    <p>Candidatos: {{ opportunity.applied_users_count }}</p>
                    <p>Visualizações: {{ opportunity.views }}</p>
                    <p>Data publicação: {{ moment(opportunity.created_at).format("DD/MM/YYYY") }}</p>
                </div>
                
                <div class="hidden sm:flex items-center">
                    <div>
                        <PrimaryButton>
                            Ver Mais
                        </PrimaryButton>
                    </div>
                </div>
            </div>

        </div>
    </Link>
    
</template>