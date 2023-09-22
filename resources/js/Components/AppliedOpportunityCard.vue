<script setup>

import { Link } from '@inertiajs/vue3';
import ApplicationMark from './ApplicationMark.vue';

const props = defineProps({
    opportunity: Object,
});

</script>

<template>

    <Link :href="route('opportunity.show', opportunity.opportunity.id)">
        <div class="flex bg-white p-4 mb-4">

            <div class="p-4 bg-gray-100 rounded-lg mr-4 hidden sm:block">
                <ApplicationMark class="block h-12 md:h-16 w-auto" />
            </div>

            <div class="w-full flex flex-col justify-center">
                <p class="font-bold">{{ opportunity.opportunity.name }}</p>
                <div class="flex justify-between flex-col sm:flex-row">
                    <div class="flex items-center text-sm text-gray-700 mb-4 sm:mb-0">
                        {{ opportunity.opportunity.address.city }}, {{ opportunity.opportunity.address.state }}
                    </div>

                    <div class="flex">
                        <div 
                            v-for="(step, key) in opportunity.steps" 
                            class="h-[4px] w-[30px] mr-2"
                            :class="{
                                'bg-ey-black': opportunity.current_step < key,
                                'bg-ey-yellow': opportunity.current_step >= key,
                            }"
                        >
                        </div>
                        
                    </div>
                </div>
            </div>


        </div>
    </Link>

</template>