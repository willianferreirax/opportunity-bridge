<script setup>
import { Link } from '@inertiajs/vue3';
import moment from 'moment';

const props = defineProps({
    user: Object,
});

</script>

<template>
    <div class="bg-white p-4 mb-4 rounded-lg">
        <Link :href="route('candidate.profile.view', { user: user.user.id })">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <p class="font-bold mb-1 sm:text-xl">{{ user.user.name }}</p>
                    <p class="text-gray-700 text-sm mb-1">Vaga: {{ user.opportunity.name }}</p>
                    <p class="text-gray-700 text-sm">Data: {{ moment(user.created_at).format("DD/MM/YYYY")}}</p>
                </div>

                <div class="justify-center items-center hidden sm:flex">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    
                </div>
            </div>
        </Link>
    </div>
</template>