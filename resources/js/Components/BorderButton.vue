<script setup>

const props = defineProps()

</script>

<template>
    <button type="button" class=
        "
            text-ey-black 
            border 
            border-white-700 
            hover:bg-white-800 
            focus:ring-4 
            focus:outline-none 
            focus:ring-white-300 
            font-medium 
            md:rounded-full 
            rounded-lg 
            text-sm p-2 
            text-center
        "
    >
       <slot></slot>
    </button>
</template>