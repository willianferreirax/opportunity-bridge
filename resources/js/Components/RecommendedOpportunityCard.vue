<script setup>

import { Link } from '@inertiajs/vue3';
import ApplicationMark from './ApplicationMark.vue';
import PrimaryButton from './PrimaryButton.vue';

const props = defineProps({
    opportunity: Object,
});

</script>

<template>
    <Link 
        :href="route('opportunity.show', opportunity.id)" 
        class="flex bg-white rounded-lg p-4 mb-4"
    >
        
        <div class="p-4 bg-gray-100 rounded-lg mr-4 hidden sm:block">
            <img :src="opportunity.company.profile_photo_url" class="block h-12 md:h-16 w-auto" />
        </div>

        <div class="w-full flex flex-col justify-center">
            <!-- <div>
                <h2 class="font-bold sm:text-xl">
                    {{ opportunity.name }}
                </h2>
            </div>

            <div class="flex justify-between">
                <div class="sm:text-center text-sm sm:text-base text-gray-700">
                    {{ opportunity.address.city }}, {{ opportunity.address.state }}
                </div>

                <div class="hidden sm:block">
                    <Link :href="route('opportunity.show',opportunity.id)">
                        <PrimaryButton>
                            Ver mais
                        </PrimaryButton>
                    </Link>
                </div>
                
            </div> -->

            <div class="grid grid-cols-1 sm:grid-cols-2">
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
                        |
                        Remoto: {{ opportunity?.is_remote ? 'Sim' : 'Não' }}
                        |<br class="block sm:hidden">
                        Regime: {{ opportunity?.hiring_regime }}                        
                    </div>

                    <div class="flex text-gray-700 text-sm">
                        Vagas: {{ opportunity?.vacancies }}
                    </div>
                </div>

                <div class="hidden sm:flex justify-end items-center">
                    <Link :href="route('opportunity.show',opportunity.id)">
                        <PrimaryButton>
                            Ver mais
                        </PrimaryButton>
                    </Link>
                </div>
            </div>

        </div>
        
    </Link>
</template>