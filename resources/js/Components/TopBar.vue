<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationMark from './ApplicationMark.vue';


</script>

<template>
    <nav class="bg-ey-black border-gray-100 md:h-24 flex">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-auto w-full">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center text-white">
                        <Link :href="route('frontpage')">
                            <ApplicationMark class="block h-8 md:h-16" />
                        </Link>
                    </div>
                        
                </div>

                <div v-if="$slots.buttons" class="flex p-3 items-center">

                    <slot name="buttons"/>
                    
                </div>
            </div>
        </div>
    </nav>
</template>