<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import StandardSelect from '@/Components/StandardSelect.vue';
import Checkbox from '@/Components/Checkbox.vue';

const form = useForm('userRegisterStep4', {
    sex: '',
    skin: '',
    gender: '',
    nacionality: '',
    isPCD: false,
    deficiency: '',

});

const page = usePage();

const submit = () => {

    form.clearErrors()

    if(!form.sex){
        page.props.errors.sex = 'Sexo é obrigatório'
        return;
    }

    emit("submit")
};

const emit = defineEmits(["submit"])
</script>
<template>
    <div class="p-12 pt-8">

        <div class="mb-8">
            <h1 class="font-bold text-xl">
                Cadastro: Informações pessoais
            </h1>
            
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="sex" value="Sexo:" />
            <StandardSelect
                v-model="form.sex"
            >
                <option value="1">Masculino</option>
                <option value="2">Feminino</option>
            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.sex" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="skin" value="Cor da pele:" />
            <StandardSelect
                v-model="form.skin"
            >
                <option value="1">Branca</option>
                <option value="2">Preta</option>
                <option value="3">Amarela</option>
                <option value="4">Parda</option>
                <option value="5">Indígena</option>
            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.skin" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="gender" value="Gênero:" />
            <StandardSelect
                v-model="form.gender"
            >
                <option value="1">Prefiro não responder</option>
                <option value="2">option2</option>
                <option value="3">option3</option>
            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.gender" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="nacionality" value="Nacionalidade:" />
            <StandardSelect
                v-model="form.nacionality"
            >
                <option value="1">Brasileiro(a)</option>
                <option value="2">Estrangeiro</option>
                
            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.nacionality" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="deficiency" value="PCD:" />
            <div class="flex gap-2 items-center">

                <Checkbox v-model:checked="form.isPCD" value="true"></Checkbox>

                <StandardSelect
                    :disabled="!form.isPCD"
                    v-model="form.deficiency"
                >
                    <option value="1">Deficiencia visual</option>
                    <option value="2">Outro</option>
                    
                </StandardSelect>
            </div>
            <InputError class="mt-2" :message="$page.props.errors.deficiency" />
        </div>


        <div class="flex items-center justify-center mt-4">
            
            <PrimaryButton class="ml-4" @click="submit()">
                Concluir
            </PrimaryButton>
        </div>
    </div>
</template>