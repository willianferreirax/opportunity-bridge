<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

const emit = defineEmits([
    'close',
    'addCourse',
    'updateCourse'
]);

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
    }
});

const form = useForm({
    file: '',
});

const addFile = () => {
    form.post(route('profile.curriculum.creativeCurriculum.create'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Arquivo adicionado com sucesso!');
            close();
        },
    });
};


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
        <!-- <form class=""> -->
            <div class="px-6 py-4">
                <div class="text-lg font-medium text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">
                        Adicionar arquivo
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>
                    
                        <div class="mt-4">
                            <InputLabel class="mt-2 mb-1" for="file" value="Arquivo" />
                        
                            <input 
                                @input="form.file = $event.target.files[0]" 
                                class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                                id="file"
                                accept=".pdf, .doc, .docx, video/*"
                                type="file"
                            >
                            <InputError class="mt-2" :message="form.errors.file"  />
                        </div>
                    
                    </div>
                </div>

            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">

                <button
                    @click="addFile()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                >
                    Adicionar
                </button>
                
                <button class="bg-red-600 text-white rounded py-2 px-3 font-semibold hover:bg-red-400" @click="close()">
                    Fechar
                </button>

            </div>
        <!-- </form> -->
    </Modal>
</template>