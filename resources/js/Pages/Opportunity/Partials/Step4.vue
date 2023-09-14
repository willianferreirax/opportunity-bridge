<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import ProcessStepCard from '@/Components/ProcessStepCard.vue';

import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AddProcessStepModal from './AddProcessStepModal.vue';
import InputError from '@/Components/InputError.vue';

const form = useForm('opportunityRegisterStep4', {
    processSteps: [],
});

const selected = ref({});
const isEditing = ref(false);
const selectedIndex = ref(null);

function udpateProcessStepModal(index) {
    isEditing.value = true;
    selectedIndex.value = index;
    createModal.value = true;
    selected.value = form.processSteps[index];
}

function addProcessStep(step) {
    form.processSteps.push(step);
}

function udpateStep(data){
    form.processSteps[selectedIndex.value] = data;
}

const page = usePage();

const createModal = ref(false);

const openOrCloseCreateModal = () => {
    createModal.value = !createModal.value;

    selected.value = {}; 
    isEditing.value = false; 
    selectedIndex.value = null
}

const submit = () => {

    form.clearErrors()

    if(!form.processSteps.length) {
        page.props.errors.processSteps = 'Adicione ao menos uma etapa'
        return;
    }

    emit("submit")
};

const backStep = () => {
    emit("backStep")
};

const emit = defineEmits([
    "submit",
    "backStep"
])

</script>

<template>
    <div class="p-12 pt-8">

        <AddProcessStepModal
            :show="createModal"
            :max-width="'4xl'"
            @close="openOrCloseCreateModal"
            @add="addProcessStep"
            @updateStep="udpateStep($event)"
            :step="selected"
            :isEditing="isEditing"
        />
        
        <div class="mt-4">
            <div class="p-4 mb-4">
                <div class="flex justify-between mb-4">
                    <div class="font-bold text-base sm:text-2xl">
                        Etapas do processo seletivo:
                    </div>

                    <div>
                        <svg
                            @click="openOrCloseCreateModal" 
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                </div>

                <ProcessStepCard 
                    v-for="(step, key) in form.processSteps"
                    :key="key"
                    :name="step.name"
                    :type="step.type"
                    @update-step="udpateProcessStepModal(key)"
                />

                <InputError class="mt-2" :message="$page.props.errors.processSteps" />
                
            </div>
        </div>

        <div class="flex items-center justify-center mt-4">

            <PrimaryButton class="ml-4" @click="backStep()">
                Voltar
            </PrimaryButton>
            
            <PrimaryButton class="ml-4" @click="submit()">
                Concluir
            </PrimaryButton>
        </div>
    </div>
</template>