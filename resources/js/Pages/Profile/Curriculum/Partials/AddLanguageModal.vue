<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { ref, watch } from 'vue';
import SkillRating from './SkillRating.vue';

const emit = defineEmits([
    'close',
    'addLanguage',
    'updateLanguage'
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
    experience: {
        type: Object,
        default:{
            id: '',
            institution_name: '',
            language: '',
            level: ''
        }
    },
    isEditing: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    institutionName: 'Kumon',
    language: 'Inglês',
    level: 4,
});

watch(() => props.show, () => {

    if (props.isEditing) {
        form.institutionName = props.experience.institution_name;
        form.language = props.experience.language;
        form.level = props.experience.level;
    }

    if(!props.isEditing){

        form.reset();
    }

});



const addLanguage = () => {
    form.post(route('profile.curriculum.language.create'), {
        preserveScroll: true,
        onSuccess: () => {
            emit('addLanguage', form.data());
            close();
        },
    });
};

const updateLanguage = () => {

    form.put(route('profile.curriculum.language.update', props.experience.id), {
        preserveScroll: true,
        onSuccess: () => {
            emit('updateLanguage', {
                id: props.experience.id,
                institution_name: form.institutionName,
                language: form.language,
                level: form.level
            });
            close();
        },
    });

};

const close = () => {
    emit('close');
};

function onRatingUpdated(rating) {
    form.level = rating;
}

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
                        Adicionar Idioma
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>

                        <div class="mt-4">
                            <InputLabel for="institutionName" value="Instituição:" />
                            <TextInput 
                                v-model="form.institutionName"
                                id="institutionName" type="text" 
                                class="mt-1 block w-full" 
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.institutionName" />
                    
                        </div>

                        <div class="mt-4">
                            <InputLabel for="language" value="Idioma:" />
                            <TextInput 
                                v-model="form.language"
                                id="language" 
                                type="text" 
                                class="mt-1 block w-full" 
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.language" />
                        
                        </div>

                        <div class="mt-4">
                            <InputLabel for="level" value="Avalie sua habilidade:" class="mb-2"/>
                            <SkillRating :max-stars="5" :initial-rating="form.level" @rating-updated="onRatingUpdated" />
                            <InputError class="mt-2" :message="form.errors.level" />
                        </div>

                    </div>
                </div>

            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">

                <button
                    v-if="!isEditing"
                    @click="addLanguage()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                >
                    Adicionar
                </button>

                <button
                    v-if="isEditing"
                    @click="updateLanguage()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                >
                    Atualizar
                </button>
                
                <button class="bg-red-600 text-white rounded py-2 px-3 font-semibold hover:bg-red-400" @click="close()">
                    Fechar
                </button>

            </div>
        <!-- </form> -->
    </Modal>
</template>