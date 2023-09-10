<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-ey-black border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 flex-row-reverse md:flex-row">

                        <div class="sm:hidden flex items-center text-white">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                                    </svg>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-100">
                                        Manage Account
                                    </div>

                                    <DropdownLink :href="route('profile.show')">
                                        Profile
                                    </DropdownLink>

                                    <DropdownLink :href="route('profile.curriculum.show')">
                                        Curriculo
                                    </DropdownLink>

                                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                        API Tokens
                                    </DropdownLink>

                                    <div class="border-t border-gray-200 dark:border-gray-600" />

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <DropdownLink as="button">
                                            Log Out
                                        </DropdownLink>
                                    </form>
                                </template>
                            </Dropdown>
                        </div>

                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center text-white">
                                <Link :href="route('user.dashboard')">
                                    <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('user.dashboard')" :active="route().current('user.dashboard')">
                                    Dashboard
                                </NavLink>
                                <NavLink :href="route('profile.curriculum.show')" :active="route().current('profile.curriculum.show')">
                                    Curriculo
                                </NavLink>
                                <NavLink :href="route('user.appliedJobs')" :active="route().current('user.appliedJobs')">
                                    Vagas aplicadas
                                </NavLink>
                                <NavLink :href="route('user.recommendedJobs')" :active="route().current('user.recommendedJobs')">
                                    Vagas recomendadas
                                </NavLink>
                                <NavLink :href="route('opportunity.list')" :active="route().current('opportunity.list')">
                                    Buscar
                                </NavLink>
                                
                                
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white dark:text-gray-400 bg-ey-black dark:bg-gray-800 hover:text-gray-200 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-600 dark:focus:bg-gray-700 active:bg-gray-600 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-100">
                                            Manage Account
                                        </div>

                                        <DropdownLink :href="route('profile.show')">
                                            Profile
                                        </DropdownLink>

                                        <DropdownLink :href="route('profile.curriculum.show')">
                                            Curriculo
                                        </DropdownLink>

                                        <div class="border-t border-gray-200 dark:border-gray-600" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Log Out
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center sm:hidden">
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-100 hover:bg-gray-600 focus:outline-none focus:bg-gray-600 focus:text-gray-100 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>

                        
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('user.dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="route('profile.curriculum.show')" :active="route().current('profile.curriculum.show')">
                            Curriculo
                        </ResponsiveNavLink>

                        <ResponsiveNavLink :href="route('user.appliedJobs')" :active="route().current('user.appliedJobs')">
                            Vagas aplicadas
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('user.recommendedJobs')" :active="route().current('user.recommendedJobs')">
                            Vagas recomendadas
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('opportunity.list')" :active="route().current('opportunity.list')">
                            Buscar
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            
            <div v-if="!$page.props.hasCurriculum" class="bg-ey-yellow text-ey-black text-center font-bold p-1">
                <Link :href="route('profile.curriculum.show')">
                    <p class="underline underline-offset-2">Complete seu curriculo e tenha mais chances</p>
                </Link>
            </div>
            <!-- Page Content -->
            <main class="mx-4 md:mx-28 p-8 bg-white h-full min-h-screen">
                
                <slot />
            </main>
        </div>
    </div>
</template>
