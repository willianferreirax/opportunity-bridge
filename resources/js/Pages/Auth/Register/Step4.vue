<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import StandardSelect from '@/Components/StandardSelect.vue';
import Checkbox from '@/Components/Checkbox.vue';
import VueSelect from "vue-select";
import { onMounted, ref } from 'vue';

const form = useForm('userRegisterStep4', {
    sex: '1',
    skin: '',
    gender: '',
    nacionality: '',
    isPCD: false,
    deficiency: [],

});

const deficiencies = ref([]);

const page = usePage();

const submit = () => {

    form.clearErrors()

    // if(!form.sex){
    //     page.props.errors.sex = 'Sexo é obrigatório'
    //     return;
    // }

    emit("submit")
};

onMounted(() => {
    deficiencies.value = page.props.deficiences.map((item) => {
        return {
            label: item.deficiency,
            value: item.id,
        }
    })
})

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

        <div class="mb-8">
            <h1 class="font-bold text-xl">
                Cadastro: Informações pessoais
            </h1>
            
        </div>

        <!-- <div class="mt-4">
            <InputLabel class="mb-2" for="sex" value="Gênero:" />
            <StandardSelect
                v-model="form.sex"
            >
                <option value="1">Masculino</option>
                <option value="2">Feminino</option>
            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.sex" />
        </div> -->

        <div class="mt-4">
            <InputLabel class="mb-2" for="skin" value="Raça/Etnia:" />
            <StandardSelect
                v-model="form.skin"
            >
                <option value="B">Branca</option>
                <option value="Pt">Preta</option>
                <option value="A">Amarela</option>
                <option value="Pd">Parda</option>

            </StandardSelect>
            <InputError class="mt-2" :message="$page.props.errors.skin" />
        </div>

        <div class="mt-4">
            <InputLabel class="mb-2" for="gender" value="Gênero:" />
            <StandardSelect
                v-model="form.gender"
            >
                <option value="Pnr">Prefiro não responder</option>
                <option value="Gn">Gênero neutro</option>
                <option value="Ag">Agênero</option>
                <option value="Fem">Feminino</option>
                <option value="Masc">Masculino</option>
                <option value="Nb">Não-binario</option>
                <option value="Tg">Transgênero</option>
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
            <InputLabel class="mb-2" for="deficiency" value="Pessoa com deficiência:" />
            <div class="flex gap-2 items-center">

                <Checkbox v-model:checked="form.isPCD" value="true"></Checkbox>

                <vue-select 
                    :disabled="!form.isPCD"
                    v-model="form.deficiency" :options="deficiencies" multiple :closeOnSelect="false"
                    :reduce="deficiency => deficiency.value" 
                    aria-multiselectable="true"
                    id="deficiency"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                >
                </vue-select>

            </div>
            <InputError class="mt-2" :message="$page.props.errors.deficiency" />
        </div>


        <div class="flex items-center justify-center mt-4">

            <PrimaryButton class="ml-4" @click="backStep()">
                voltar
            </PrimaryButton>
            
            <PrimaryButton class="ml-4" @click="submit()">
                Concluir
            </PrimaryButton>
        </div>
    </div>
</template>
<style>
@import "vue-select/dist/vue-select.css";

.step-content {
    border: 1px solid #ccc;
    padding: 20px;
}

.vs__dropdown-toggle {
    border: 0;
}
</style>