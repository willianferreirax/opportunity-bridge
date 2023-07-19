<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-ey-yellow dark:bg-ey-yellow border border-transparent rounded-md font-semibold text-xs text-ey-black dark:text-ey-yellow uppercase tracking-widest hover:bg-ey-yellow dark:hover:bg-ey-black focus:bg-ey-yellow dark:focus:bg-ey-black active:bg-ey-yellow dark:active:bg-ey-yellow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-ey-yellow transition ease-in-out duration-150">
        <slot />
    </button>
</template>
