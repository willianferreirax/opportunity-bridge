<script setup>

import PrimaryButton from '@/Components/PrimaryButton.vue';
import AdminAppLayout from '@/Layouts/AdminAppLayout.vue';
import UploadCertificatesModal from './Partials/UploadCertificatesModal.vue';
import { ref } from 'vue';

const createModal = ref(false);

const openOrCloseCreateModal = () => {
    createModal.value = !createModal.value;
}


</script>

<template>
    <AdminAppLayout title="Dashboard">

        <UploadCertificatesModal :show="createModal" maxWidth="4xl" @close="openOrCloseCreateModal" />
        
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold ">
                Bem vindo, {{ $page.props.auth.user.name }}
            </h1>
            
            <PrimaryButton @click="openOrCloseCreateModal">
                Certificados
            </PrimaryButton>
        </div>

        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

        <h2 class="text-2xl font-bold ">
            Vagas cadastradas
        </h2>

        <div class="mt-4 flex justify-center">
            Grafico
        </div>

        <div class="mt-4">
            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Mensagens suporte: (mock)</h2>

            <div class="bg-gray-200 rounded-lg p-4 sm:p-8 mt-8">

                <div class="bg-white p-4 mb-4 rounded-lg">
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <p class="font-bold mb-1">João Pedro - Microsoft</p>
                            <p class="text-gray-700 text-sm mb-1">Tipo: Bug report</p>
                            <p class="text-gray-700 text-sm">Data: 02/02/2021</p>
                        </div>

                        <div class="flex justify-center items-center">
                          
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex justify-end">
                <PrimaryButton class="mt-4">
                    Ver mais
                </PrimaryButton>
            </div>
        </div>

        <div class="mt-2">
            <h3 class="font-bold text-xl">
                Novos candidatos cadastrados:
            </h3>

            <div>
                grafico
            </div>
        </div>

        <div class="mt-2">
            <h3 class="font-bold text-xl">
                Empresas cadastradas:
            </h3>

            <div>
                grafico
            </div>
        </div>


    </AdminAppLayout>
</template>