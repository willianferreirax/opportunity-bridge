<script setup>

</script>

<template>
    <div class="fixed right-3 bottom-3 sm:hidden">
        <button type="button" class="flex items-center justify-center text-white bg-yellow-700 rounded-full w-14 h-14 hover:bg-yellow-800 focus:outline-none">
            <slot name="icon"></slot>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>
</template>