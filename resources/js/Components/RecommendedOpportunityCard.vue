<script setup>

import { Link } from '@inertiajs/vue3';
import ApplicationMark from './ApplicationMark.vue';
import PrimaryButton from './PrimaryButton.vue';

</script>

<template>
    <Link 
        :href="route('opportunity.show', 1)" 
        class="flex bg-white rounded-lg p-4 mb-4"
    >
        
        <div class="p-4 bg-gray-100 rounded-lg mr-4 hidden sm:block">
            <ApplicationMark class="block h-12 md:h-16 w-auto" />
        </div>

        <div class="w-full flex flex-col justify-center">
            <div>
                <h2 class="font-bold sm:text-xl">
                    Engenheiro de Software Sr.
                </h2>
            </div>

            <div class="flex justify-between">
                <div class="sm:text-center text-sm sm:text-base text-gray-700">
                    Belo Horizonte
                </div>

                <div class="hidden sm:block">
                    <Link :href="route('opportunity.show', 1)">
                        <PrimaryButton>
                            Ver mais
                        </PrimaryButton>
                    </Link>
                </div>
                
            </div>

        </div>
        
    </Link>
</template>