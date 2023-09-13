<script setup>
const props = defineProps({
    step: Object,
    order: Number,
    passed: Boolean,
});
</script>

<template>
    <li class="mb-10 ml-6">            
        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
            <div v-if="!passed">
                {{order}}
            </div>

            <svg v-if="passed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-800 dark:text-blue-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>

        </span>

        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
            {{step.name}}
            <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">
                {{ passed ? 'Aprovado' : 'Aguardando' }}
            </span>
        </h3>
        
        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{step.description}}
        </p>
        
    </li>
</template>