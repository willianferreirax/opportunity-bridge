<template>
    <nav aria-label="Page navigation example">
        <ul class="inline-flex items-center -space-x-px">
            <li
                v-if="data.prev_page_url"
            >
                <Link 
                    :href="data.prev_page_url"
                    class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Previous</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </Link>
            </li>
            <li
                v-for="link in cleanLinks"
                :key="link.label"
            >
                <Link 
                    :href="link.url"
                    :class="[
                        link.active
                            ? 'z-10 px-3 py-2 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                            : 'px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                    ]"
                >
                    {{ link.label }}
                </Link>
            </li>

            <li
                v-if="data.next_page_url"
            >
                <Link 
                    :href="data.next_page_url"
                    class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <span class="sr-only">Next</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: "Pagination",
    props: {
        data: Object,
    },
    computed: {
        cleanLinks() {
            const cleanLinks = [...this.data.links];
            cleanLinks.shift();
            cleanLinks.pop();
            return cleanLinks;
        },
    },
    components: { Link }
};
</script>