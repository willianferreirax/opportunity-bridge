<script setup>

import { Link } from '@inertiajs/vue3';
import ApplicationMark from './ApplicationMark.vue';

</script>

<template>

    <Link :href="route('opportunity.show', 1)">
        <div class="flex bg-white p-4 mb-4">

            <div class="p-4 bg-gray-100 rounded-lg mr-4 hidden sm:block">
                <ApplicationMark class="block h-12 md:h-16 w-auto" />
            </div>

            <div class="w-full flex flex-col justify-center">
                <p class="font-bold">Engenheiro de Software Sr.</p>
                <div class="flex justify-between flex-col sm:flex-row">
                    <div class="flex items-center text-sm text-gray-700 mb-4 sm:mb-0">
                        Belo Horizonte
                    </div>

                    <div class="flex">
                        <div class="h-[4px] w-[30px] mr-2 bg-ey-yellow"></div>
                        <div class="h-[4px] w-[30px] mr-2 bg-ey-yellow"></div>
                        <div class="h-[4px] w-[30px] mr-2 bg-ey-yellow"></div>
                        <div class="h-[4px] w-[30px] mr-2 bg-ey-black"></div>
                        <div class="h-[4px] w-[30px] mr-2 bg-ey-black"></div>
                    </div>
                </div>
            </div>


        </div>
    </Link>

</template>