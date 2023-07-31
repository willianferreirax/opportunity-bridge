<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import StandardSelect from '@/Components/StandardSelect.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import StandardTextArea from '@/Components/StandardTextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    regime: '',
    workHour: '',
    salary: '',
    benefits: '',
    targetUsers: []
});

</script>
<template>
    <AppLayout title="Create opportunity">

        <section class="">

            <div class="mt-4">
                <h1 class="text-3xl font-bold ">
                    Criar vaga
                </h1>
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="benefits" value="Resumo da vaga:" />
                <StandardTextArea
                    id="benefits"
                    v-model="form.benefits"
                    rows="8"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.benefits" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="regime" value="Regime de contratação:" />
                <StandardSelect
                    v-model="form.regime"
                >
                    <option value="1">Branca</option>
                    <option value="2">Preta</option>
                    <option value="3">Amarela</option>
                    <option value="4">Parda</option>
                    <option value="5">Indígena</option>
                </StandardSelect>
                <InputError class="mt-2" :message="form.errors.regime" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="workHour" value="Horário de trabalho:" />
                <TextInput
                    id="workHour"
                    v-model="form.workHour"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.workHour" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="targetUsers" value="Candidatos alvo:" />
                <StandardSelect
                    v-model="form.targetUsers"
                >
                    <option value="1">Branca</option>
                    <option value="2">Preta</option>
                    <option value="3">Amarela</option>
                    <option value="4">Parda</option>
                    <option value="5">Indígena</option>
                </StandardSelect>
                <InputError class="mt-2" :message="form.errors.targetUsers" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="salary" value="Salário:" />
                <TextInput
                    id="salary"
                    v-model="form.salary"
                    type="text"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.salary" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="benefits" value="Beneficios:" />
                <StandardTextArea
                    id="benefits"
                    v-model="form.benefits"
                    rows="4"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="form.errors.benefits" />
            </div>

            <div class="flex items-center justify-center mt-4">
            
                <PrimaryButton class="ml-4">
                    Salvar
                </PrimaryButton>
            </div>
        </section>
        
    </AppLayout>
</template>