<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import StandardTextArea from '@/Components/StandardTextArea.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import { watch } from 'vue';

const emit = defineEmits([
    'close',
    'addExperience',
    'updateExperience',
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
            company_name: '',
            role: '',
            start_date: '',
            end_date: '',
            description: '',
            is_current: false,
        }
    },
    isEditing: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    companyName: '',
    role: '',
    dateStart: '',
    dateEnd: '',
    resume: '',
    stillWorking: '',
});

watch(() => props.show, () => {

    if (props.isEditing) {
        form.companyName = props.experience.company_name;
        form.role = props.experience.role;
        form.dateStart = props.experience.start_date;
        form.dateEnd = props.experience.end_date;
        form.resume = props.experience.description;
        form.stillWorking = props.experience.is_current ? true : false;
    }

    if(!props.isEditing){

        form.reset();
    }

});

const addExperience = () => {

    form.post(route('profile.curriculum.proExperience.create'), {
        preserveScroll: true,
        onSuccess: () => {
            emit('addExperience', form.data());
            close();
        },
    });

};

const updateExperience = () => {

    form.put(route('profile.curriculum.proExperience.update', props.experience.id), {
        preserveScroll: true,
        onSuccess: () => {
            emit('updateExperience', {
                id: props.experience.id,
                company_name: form.companyName,
                role: form.role,
                start_date: form.dateStart,
                end_date: form.dateEnd,
                description: form.resume,
                is_current: form.stillWorking ? true : false,
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
                        Adicionar Experiencia Profissional
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>

                        <div class="mt-4">
                            <InputLabel for="companyName" value="Nome da empresa:" />
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
                            <InputLabel for="role" value="Cargo:" />
                            <TextInput 
                                v-model="form.role"
                                id="role" type="text" 
                                class="mt-1 block w-full" 
                                required
                                autofocus
                            />
                            <InputError class="mt-2" :message="form.errors.role" />
                        
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
                            <div v-if="!form.stillWorking" class="w-full ml-2">
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
                                    v-model="form.stillWorking" 
                                    type="checkbox" 
                                    value="1" 
                                    class="sr-only peer"
                                >
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-yellow-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ainda estou cursando</span>
                            </label>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="resume" value="Fale um pouco sobre a expericencia:" />

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