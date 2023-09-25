<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    title: String,
});

const logout = () => {
  router.post(route('logout'));
};

const openMenu = ref(true);

</script>

<template>

<nav class="fixed top-0 z-50 w-full bg-ey-black border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
   <Head :title="title" />
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button aria-controls="logo-sidebar" @click="openMenu = !openMenu" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a class="flex ml-2 md:mr-24">
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">Opportunity Bridge</span>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ml-3">
            <div>
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

                        <DropdownLink :href="route('company.profile.show')">
                           Profile
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
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" :class="{ '-translate-x-full': !openMenu, 'translate-x-0' : openMenu }" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-ey-black border-r border-gray-200" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-ey-black dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <Link
				:href="route('company.dashboard')" 
				:class="route().current('company.dashboard') ? 'bg-gray-600' : ''" 
				class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group"
			>
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-ey-yellow dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ml-3">Dashboard</span>
            </Link>
         </li>

		 <li>
            <Link
				:href="route('company.announced')" 
				:class="route().current('company.announced') ? 'bg-gray-600' : ''" 
				class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group"
			>
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-ey-yellow dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ml-3">Minhas vagas</span>
            </Link>
         </li>

		 <li>
            <Link
				:href="route('opportunity.create')" 
				:class="route().current('opportunity.create') ? 'bg-gray-600' : ''" 
				class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group"
			>
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-ey-yellow dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ml-3">Criar vaga</span>
            </Link>
         </li>
         
      </ul>
   </div>
</aside>

<div  :class="{ 'sm:ml-0': !openMenu, 'sm:ml-64' : openMenu }" class="p-4 ">
   <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">

      <slot></slot>

   </div>
</div>

</template>
<style>
@import 'vue3-toastify/dist/index.css';
@import "vue-select/dist/vue-select.css";
</style>