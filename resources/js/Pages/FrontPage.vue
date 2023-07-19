<script setup>

import BorderButton from '@/Components/BorderButton.vue';
import TopBar from '@/Components/TopBar.vue';
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <Head title="Página Inicial" />

        <TopBar>

            <template #buttons>
                <Link :href="route('register')">
                    <BorderButton class="text-white mr-2 text-xs md:text-base md:p-2 sm:p-1">
                        Cadastre-se agora
                    </BorderButton>
                </Link>

                <div class="w-[1px] h-[40px] bg-white mx-1"></div>

                <Link :href="route('login')">
                    <BorderButton class="text-white ml-2 text-xs md:text-base sm:p-1 md:p-2">
                        Já tenho cadastro
                    </BorderButton>
                </Link>

            </template>

        </TopBar>

        <main class="p-12">
            <div class="grid md:grid-cols-2 gap-3">
                <div class="p-8 flex flex-col justify-center">
                    <p class="md:text-3xl text-lg text-ey-black">
                        Reunimos pessoas extraordinárias,<br> como você, para construir um mundo de negócios melhor.
                    </p>

                    <div class="grid mt-10 gap-10">
                        <div>
                            <BorderButton class="border-black w-full md:w-1/2 text-xl p-4">
                                Anunciar minha vaga
                            </BorderButton>
                        </div>

                        <div>
                            <BorderButton class="border-black w-full md:w-1/2 text-xl p-4">
                                Encontrar vagas
                            </BorderButton>
                        </div>

                        <div>
                            <BorderButton class="border-black w-full md:w-1/2 text-xl p-4">
                                Sobre nós
                            </BorderButton>
                        </div>
                    </div>
                    
                </div>

                <div>
                    <img src="images/wheel_chair.png"/>
                </div>
            </div>
        </main>
    </div>
</template>