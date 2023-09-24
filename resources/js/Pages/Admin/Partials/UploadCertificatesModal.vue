<script setup>
import Modal from "../../../Components/Modal.vue"
import TextInput from '../../../Components/TextInput.vue';
import InputLabel from '../../../Components/InputLabel.vue';
import InputError from '../../../Components/InputError.vue';
import VueSelect from "vue-select";
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

const emit = defineEmits(['close']);

const businesses = ref([]);

const form = useForm({
    file: '',
});

const submit = () => {

    form
    .post(route('admin.upload.certificate'), {
        onSuccess: () => {
            toast.success('Certificados adicionados com sucesso!')
            emit('close');
        },
        onError: () => {
            toast.error('Erro ao adicionar certificados!')
        }
    });

};

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit('close');
};


</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <form @submit.prevent="submit" class="">
            <div class="px-6 py-4">
                <div class="text-lg font-medium text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">
                        Adicionar certificados
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>
                        <InputLabel class="mt-2 mb-1" for="dropzone-file" value="Arquivo" />

                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">CSV, TXT</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" @input="form.file = $event.target.files[0]"/>
                            </label>
                        </div> 
                        <InputError class="mt-2" :message="form.errors.file"  />
                        
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
                <button class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" type="submit">Criar</button>
                <button class="bg-red-600 text-white rounded py-2 px-3 font-semibold hover:bg-red-400" @click="close()">Fechar</button>

            </div>
        </form>
    </Modal>
</template>