<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import StandardTextArea from '@/Components/StandardTextArea.vue';
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits([
    'close',
    'updateResume',
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
    },
    resume: {
        type: String,
        default: '',
    },
});

const form = useForm({
    resume: props.resume,
});

const updateResume = () => {
    emit('updateResume', form.resume);
    close();
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
        <form class="">
            <div class="px-6 py-4">
                <div class="text-lg font-medium text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">
                        Atualizar resumo
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>
                        
                        <InputLabel for="resume" value="Resumo" />

                        <StandardTextArea
                            v-model="form.resume"
                            id="resume" type="text" class="mt-1 block w-full" 
                            :rows="15"
                            autofocus 
                        >   
                        </StandardTextArea>
                        <InputError class="mt-2" :message="form.errors.resume" />
                    
                    </div>
                </div>

            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">

                <button
                    @click="updateResume()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                    type="submit"
                >
                    Alterar
                </button>
                
                <button class="bg-red-600 text-white rounded py-2 px-3 font-semibold hover:bg-red-400" @click="close()">
                    Fechar
                </button>

            </div>
        </form>
    </Modal>
</template>