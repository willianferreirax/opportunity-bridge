<script setup>

const props = defineProps({
    path: {
        type: String,
        default: '',
    },
    name: {
        type: String,
        default: '',
    },
});

const emit = defineEmits([,
    'deleteFile'
]);

</script>

<template>
    <div class="bg-gray-200 rounded mb-4">
        <div class="flex justify-between items-center p-2.5">
            <div class="flex flex-col">
                <div class="text-sm text-ey-black font-bold">
                    {{ name }}
                </div>
            </div>

            <div class="flex text-ey-black">

                <a :href="route('profile.curriculum.creativeCurriculum.download', {creativeCurriculum: path})" download>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>

                </a>

                <svg @click="emit('deleteFile')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>

            </div>
        </div>
    </div>
</template>