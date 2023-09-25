<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    opportunity: Object,
});

</script>

<template>
    <Link 
        :href="route('opportunity.show', opportunity.id)" 
        class="flex bg-gray-100 w-full rounded-lg mb-12"
    >
        
        <div class="p-4 bg-gray-200 rounded-lg mr-4">
            <img :src="opportunity.company.profile_photo_url" class="block h-12 md:h-16 w-auto" />
        </div>

        <div class="w-full flex flex-col justify-center sm:px-4 pr-4">
            <div>
                <h2 class="font-bold sm:text-xl">
                    {{ opportunity.name }}
                </h2>
            </div>

            <div class="flex justify-between">
                <div class="sm:text-center text-sm sm:text-base text-gray-700">
                    {{ opportunity.address.city }}, {{ opportunity.address.state }}
                </div>
                
            </div>

        </div>
        
    </Link>
</template>