<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from './PrimaryButton.vue';


</script>

<template>
    
    <Link :href="route('company.opportunitiy.report', 1)" class="flex bg-gray-100 w-full rounded-lg p-4">
        <div class="w-full flex flex-col justify-center sm:px-0 pr-4">
            <div>
                <h2 class="font-bold sm:text-xl">
                    Engenheiro de Software Sr.
                </h2>
            </div>

            <div class="flex justify-between">
                <div class="text-sm sm:text-base text-gray-700">
                    <p>Candidatos: 30</p>
                    <p>Visualizações: 267</p>
                    <p>Data publicação: 03/04/23</p>
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