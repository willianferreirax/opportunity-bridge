<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import StandardTextArea from '@/Components/StandardTextArea.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import SkillRating from './SkillRating.vue';

const emit = defineEmits([
    'close',
    'addExperience',
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
    companyName: '',
});

const userSkillRating = ref(0);

const addExperience = () => {
    emit('addExperience', form.resume);
    close();
};

const close = () => {
    emit('close');
};

function onRatingUpdated(rating) {
    userSkillRating.value = rating;
}

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
                        Adicionar Idioma
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>

                        <div class="mt-4">
                            <InputLabel for="companyName" value="Instituição:" />
                            <TextInput 
                                v-model="form.companyName"
                                id="companyName" type="text" 
                                class="mt-1 block w-full" 
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.companyName" />
                    
                        </div>

                        <div class="mt-4">
                            <InputLabel for="role" value="Idioma:" />
                            <TextInput 
                                v-model="form.role"
                                id="role" type="text" 
                                class="mt-1 block w-full" 
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.role" />
                        
                        </div>

                        <div class="mt-4">
                            <InputLabel for="rate" value="Avalie sua habilidade:" class="mb-2"/>
                            <SkillRating :max-stars="5" :initial-rating="userSkillRating" @rating-updated="onRatingUpdated" />
                        </div>

                    </div>
                </div>

            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">

                <button
                    @click="addExperience()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                    type="submit"
                >
                    Adicionar
                </button>
                
                <button class="bg-red-600 text-white rounded py-2 px-3 font-semibold hover:bg-red-400" @click="close()">
                    Fechar
                </button>

            </div>
        </form>
    </Modal>
</template>