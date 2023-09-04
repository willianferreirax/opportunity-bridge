<script setup>
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import VueSelect from "vue-select";
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const emit = defineEmits([
    'close',
    'add',
    'updateStep'
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
    step: {
        type: Object,
        default:{
            id: '',
            description: '',
            limitDate: '',
            link: '',
            name: '',
            type: '',
        }
    },
    isEditing: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    name: '',
    description: '',
    type: '',
    limitDate: '',
    link: '',
});

watch(() => props.show, () => {

    if (props.isEditing) {
        form.name = props.step.name;
        form.description = props.step.description;
        form.type = props.step.type;
        form.limitDate = props.step.limitDate;
        form.link = props.step.link;
    }

    if(!props.isEditing){

        form.reset();
    }

});

const type = ref([
    'Simples',
    'Video',
    'Entrevista',
    'Teste',
]);

const submit = () => {


};

const close = () => {
    emit('close');
};

function showTooltip(flag) {
  switch (flag) {
    case 1:
      document.getElementById("tooltip1").classList.remove("hidden");
      break;
    case 2:
      document.getElementById("tooltip2").classList.remove("hidden");
      break;
    case 3:
      document.getElementById("tooltip3").classList.remove("hidden");
      break;
  }
}
function hideTooltip(flag) {

  switch (flag) {
    case 1:
      document.getElementById("tooltip1").classList.add("hidden");
      break;
    case 2:
      document.getElementById("tooltip2").classList.add("hidden");
      break;
    case 3:
      document.getElementById("tooltip3").classList.add("hidden");
      break;
  }
}

function add(){
    emit('add', {
        name: form.name,
        description: form.description,
        type: form.type,
        limitDate: form.limitDate,
        link: form.link,
    });

    close();
}

function update(){
    emit('updateStep', {
        name: form.name,
        description: form.description,
        type: form.type,
        limitDate: form.limitDate,
        link: form.link,
    });

    close();
}

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
                        Adicionar etapa
                    </h3>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    <div>
                        
                        <InputLabel for="name" value="Nome" />
                        <TextInput 
                            v-model="form.name"
                            id="name" type="text" class="mt-1 block w-full" required
                            autofocus />
                        <InputError class="mt-2" :message="form.errors.name" />
                    
                        <InputLabel class="mt-2" for="description" value="Descricao" />
                        <textarea 
                            v-model="form.description"
                            id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escreva uma breve descrição..."></textarea>
                        <InputError class="mt-2" :message="form.errors.description"  />

                        <InputLabel class="mt-2" for="type" value="Tipo de etapa" />
                        <vue-select 
                            v-model="form.type" :options="type" clearable :closeOnSelect="true"
                            id="type"
                            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                        </vue-select>
                        <InputError class="mt-2" :message="form.errors.type"  />
                        
                    </div>
                </div>

                <div class="mt-4" v-if="['Teste', 'Video'].includes(form.type)">
                    <div>
                        <div class="flex">
                            <InputLabel for="date" value="Limite de dias" class="mr-2" />
                            <a tabindex="0" role="link" aria-label="tooltip 1" class="focus:outline-none focus:ring-gray-300 rounded-full focus:ring-offset-2 focus:ring-2 focus:bg-gray-200 relative mt-20 md:mt-0" @mouseover="showTooltip(1)" @focus="showTooltip(1)" @mouseleave="hideTooltip(1)">
                              <div class=" cursor-pointer">
                                  <svg aria-haspopup="true" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#A0AEC0" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" />
                                      <circle cx="12" cy="12" r="9" />
                                      <line x1="12" y1="8" x2="12.01" y2="8" />
                                      <polyline points="11 12 12 12 12 16 13 16" />
                                  </svg>
                              </div>
                              <div id="tooltip1" role="tooltip" class="z-20 -mt-20 w-64 absolute transition duration-150 ease-in-out left-0 ml-8 shadow-lg bg-white p-4 rounded hidden">

                                <p class="text-sm font-bold text-gray-800 pb-1">Limite de dias</p>
                                <p class="text-xs leading-4 text-gray-600 pb-3">Quantos dias após entrar nesse etapa o candidato tem para enviar o que foi solicitado</p>

                              </div>
                          </a>
                        </div>
                        
                        <TextInput 
                            id="date"
                            v-model="form.limitDate"
                            type="number" 
                            class="mt-1 block w-full" 
                        />
                        <InputError class="mt-2" :message="form.errors.limitDate" />
                    </div>
                </div>

                <div class="mt-4" v-if="['Teste'].includes(form.type)">
                    <div class="flex">
                        <InputLabel for="link" value="Link do teste" class="mr-2" />
                        <a tabindex="0" aria-label="tooltip 1" class="focus:outline-none focus:ring-gray-300 rounded-full focus:ring-offset-2 focus:ring-2 focus:bg-gray-200 relative mt-20 md:mt-0" @mouseover="showTooltip(2)" @focus="showTooltip(2)" @mouseleave="hideTooltip(2)">
                            <div class=" cursor-pointer">
                                <svg aria-haspopup="true" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#A0AEC0" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <circle cx="12" cy="12" r="9" />
                                    <line x1="12" y1="8" x2="12.01" y2="8" />
                                    <polyline points="11 12 12 12 12 16 13 16" />
                                </svg>
                            </div>
                            <div id="tooltip2" role="tooltip" class="z-20 -mt-20 w-64 absolute transition duration-150 ease-in-out left-0 ml-8 shadow-lg bg-white p-4 rounded hidden">

                                <p class="text-sm font-bold text-gray-800 pb-1">Link do teste</p>
                                <p class="text-xs leading-4 text-gray-600 pb-3">Forneça o link externo para o candidato realizar o teste</p>

                            </div>
                        </a>
                    </div>

                    <TextInput 
                        v-model="form.link"
                        id="link" type="text" class="mt-1 block w-full"
                        autofocus 
                    />
                    <InputError class="mt-2" :message="form.errors.link" />
                </div>
            </div>

            

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">

                <button
                    v-if="!isEditing"
                    @click="add()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                >
                    Adicionar
                </button>

                <button
                    v-if="isEditing"
                    @click="update()" 
                    class="bg-blue-600 text-white rounded py-2 px-3 font-semibold hover:bg-blue-400 mr-3" 
                >
                    Atualizar
                </button>
                
                <button class="bg-red-600 text-white rounded py-2 px-3 font-semibold hover:bg-red-400" @click="close()">
                    Fechar
                </button>

            </div>
        </form>
    </Modal>
</template>
<style>
@import "vue-select/dist/vue-select.css";
</style>