<script setup>
import { computed } from 'vue';


const props = defineProps({
    currentStep: {
        type: Number,
        default: 0,
    },

    totalSteps: {
        type: Number,
        default: 3,
    },
});

const numberOfCols = computed(() => {
    return "grid-cols-" + props.totalSteps;
});

defineEmits(['update:current-step']);

</script>

<template>
    <div class="mb-7">
        <div class="after:mt-4 after:block after:h-1 after:w-full after:rounded-lg after:bg-gray-200">
            <ol class="grid text-sm font-medium text-gray-500" :class="numberOfCols">

                <li 
                    v-for="(n, step) in props.totalSteps"
                    class="relative flex justify-center"
                >
                    <span 
                        
                        class="absolute -bottom-[2.4rem] rounded-full"
                    >
                        <div
                            v-if="currentStep <= step"
                            class="rounded-full w-[40px] h-[40px] flex justify-center items-center text-xl font-bold"
                            :class="currentStep === step ? 'bg-ey-yellow text-ey-black' : 'bg-ey-black text-white'"
                        > 
                            {{ step+1 }}
                        </div>

                        <div
                            v-else
                            class="bg-ey-yellow rounded-full w-[40px] h-[40px] flex justify-center items-center text-ey-black text-xl font-black"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>


                    </span>

                </li>


                <!-- <li 
                    class="relative flex justify-center"
                    :class="currentStep >= 1 ? 'text-yellow-600': 'text-gray-600'"
                >
                    <span 
                        class="absolute -bottom-[1.75rem] rounded-full  text-white"
                        :class="currentStep >= 1 ? 'bg-yellow-600' : 'bg-gray-600'"
                    >
                        
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>

                    <span class="hidden sm:block"> Etapa 2 </span>

                </li>

                <li 
                    class="relative flex justify-end"
                    :class="currentStep >= 2 ?'text-yellow-600' : 'text-gray-600'"
                >
                    <span 
                        class="absolute -bottom-[1.75rem] end-0 rounded-full bg-gray-600 text-white"
                        :class="currentStep >= 2 ? 'bg-yellow-600' : 'bg-gray-600'"
                    >
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>

                    <span class="hidden sm:block"> Etapa 3 </span>

                    <svg class="h-6 w-6 sm:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </li> -->

            </ol>
        </div>
    </div>
</template>