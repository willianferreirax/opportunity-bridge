<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    opportunity: Object,
});

</script>

<template>
    <Link 
        :href="route('opportunity.show', opportunity.id)" 
        class="flex bg-gray-100 w-full rounded-lg mb-12 p-2"
    >
        
        <div class="p-4 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
            <img :src="opportunity.company.profile_photo_url" class="block h-12 md:h-16 w-auto" />
        </div>

        <div class="w-full flex flex-col justify-center sm:px-4 pr-4">
            <div class="grid grid-cols-1 sm:grid-cols-3">
                <div>
                    <div>
                        <h2 class="font-bold sm:text-xl">
                            {{ opportunity.name }}
                        </h2>
                    </div>

                    <div class="flex justify-between">
                        <div class="sm:text-center text-xs sm:text-sm text-gray-700">
                            {{ opportunity.address.city }}, {{ opportunity.address.state }}
                        </div>                        
                    </div>

                    <div class="flex text-gray-700 text-sm">
                        PCD: {{ opportunity?.is_pcd ? 'Sim' : 'Não' }}
                        |<br class="block sm:hidden">
                        Remoto: {{ opportunity?.is_remote ? 'Sim' : 'Não' }}
                        |<br class="block sm:hidden">
                        Regime: {{ opportunity?.hiring_regime }}                        
                    </div>

                    <div class="flex text-gray-700 text-sm">
                        Vagas: {{ opportunity?.vacancies }}
                    </div>
                </div>
            </div>

        </div>
        
    </Link>
</template>