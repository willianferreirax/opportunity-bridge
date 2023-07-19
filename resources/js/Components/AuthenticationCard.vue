<template>
    <div class="min-h-max flex flex-col items-center bg-gray-100 dark:bg-gray-900">
        

        <div class="w-full flex flex-col  justify-center h-[90vh] sm:max-w-4xl px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex justify-center">
                <slot name="logo" />
            </div>
            <slot />
        </div>
    </div>
</template>
