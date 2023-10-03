<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { ref, watch } from 'vue';

const emit = defineEmits([
    'close',
    'addAcadExperience',
    'updateAcadExperience'
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
            course_name: '',
            start_date: '',
            end_date: '',
            still_coursing: false,
        }
    },
    isEditing: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    institutionName: 'Fiap',
    courseName: 'Sistemas de informacao',
    dateStart: '2020-02-07',
    dateEnd: '',
    stillStudying: true
});

watch(() => props.show, () => {

    if (props.isEditing) {
        form.institutionName = props.experience.institution_name;
        form.courseName = props.experience.course_name;
        form.dateStart = props.experience.start_date;
        form.dateEnd = props.experience.end_date;
        form.stillStudying = props.experience.still_coursing ? true : false;
    }

    if(!props.isEditing){

        form.reset();
    }

});

const addExperience = () => {
    form.post(route('profile.curriculum.acadExperience.create'), {
        preserveScroll: true,
        onSuccess: () => {
            emit('addAcadExperience', form.data());
            close();
        },
    });
};

const updateExperience = () => {

    form.put(route('profile.curriculum.acadExperience.update', props.experience.id), {
        preserveScroll: true,
        onSuccess: () => {
            emit('updateAcadExperience', {
                id: props.experience.id,
                institution_name: form.institutionName,
                course_name: form.courseName,
                start_date: form.dateStart,
                end_date: form.dateEnd,
                still_coursing: form.stillStudying ? true : false,
            });
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
                        Adicionar Experiencia Academica
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>

                        <div class="mt-4">
                            <InputLabel for="institutionName" value="Nome da instituição:" />
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
                            <InputLabel for="course" value="Curso:" />
                            <TextInput 
                                v-model="form.courseName"
                                id="course" type="text" 
                                class="mt-1 block w-full" 
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.courseName" />
                        
                        </div>

                        <div class="flex w-full mt-4">
                            <div class="w-full mr-2">
                                <InputLabel for="dateStart" value="Inicio:" />
                                <TextInput 
                                    v-model="form.dateStart"
                                    id="dateStart" 
                                    type="date" 
                                    class="mt-1 block w-full mr-2" 
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.dateStart" />
                            </div>
                            <div v-if="!form.stillStudying" class="w-full ml-2">
                                <InputLabel for="dateEnd" value="Fim:" />
                                <TextInput
                                    v-model="form.dateEnd"
                                    id="dateEnd" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.dateEnd" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="relative inline-flex items-center cursor-pointer mt-2">
                                <input
                                    v-model="form.stillStudying" 
                                    type="checkbox" 
                                    value="1" 
                                    class="sr-only peer"
                                >
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ainda estou cursando</span>
                            </label>
                        </div>

                    </div>
                </div>

            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">

                <button
                    v-if="!isEditing"
                    @click="addExperience()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                >
                    Adicionar
                </button>

                <button
                    v-if="isEditing"
                    @click="updateExperience()" 
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