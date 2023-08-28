<script setup>

const props = defineProps({
    text: String,
});

</script>

<template>
    <div class="bg-gray-200 p-10 rounded-lg text-gray-600">
        <div class="flex justify-between">
            <div class="font-bold text-base sm:text-2xl">
                {{ text }}
            </div>
        </div>
    </div>
</template>