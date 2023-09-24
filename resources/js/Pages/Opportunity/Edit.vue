<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import CompanyAppLayout from '@/Layouts/CompanyAppLayout.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import VueSelect from "vue-select";
import { vMaska } from 'maska';
import StandardSelect from '@/Components/StandardSelect.vue';
import StandardTextArea from '@/Components/StandardTextArea.vue';
import { toast } from 'vue3-toastify';

const jobStatus = ref(props.opportunity.status)

const props = defineProps({
    deficiences: {
        type: Array,
        default: () => [],
    },
    opportunity: Object,
})

const form = useForm('opportunityRegisterStep1', {
    name: props.opportunity.name,
    role: props.opportunity.role,
    resume: props.opportunity.resume,
    regime: props.opportunity.hiring_regime,
    type: props.opportunity.job_type,
    pcd: props.opportunity.is_pcd,
    workHour_start: props.opportunity.work_start,
    workHour_end: props.opportunity.work_end,
    targetUsers: props.opportunity.targetUsers,
    salary_start: props.opportunity.salary_start.toString(),
    salary_end: props.opportunity.salary_end.toString(),
    quantity: props.opportunity.vacancies,
});

const type = ref([])

const page = usePage();

function updateStatus(){
    router.put(route('opportunity.update.status', {opportunity: props.opportunity.id}),{
        status: jobStatus.value,
    },{
        preserveState: true,
        onSuccess: () => {
            toast.success('Status atualizado com sucesso')
        },
        onError: (errors) => {
            const error = errors[Object.keys(errors)[0]]
            toast.error(error)
        },
    })
}

function editPart1() {

    form.clearErrors()

    if(!form.name) {
        page.props.errors.name = 'Nome é obrigatório'
        return;
    }

    if(!form.role) {
        page.props.errors.role = 'Cargo é obrigatório'
        return;
    }

    if(!form.resume) {
        page.props.errors.resume = 'Resumo da vaga é obrigatório'
        return;
    }

    if(!form.regime) {
        page.props.errors.regime = 'Regime de contratação é obrigatório'
        return;
    }

    if(!form.type) {
        page.props.errors.type = 'Tipo de vaga é obrigatório'
        return;
    }

    if(!form.workHour_start) {
        page.props.errors.workHour_start = 'Horário de trabalho é obrigatório'
        return;
    }

    if(!form.workHour_end) {
        page.props.errors.workHour_end = 'Horário de trabalho é obrigatório'
        return;
    }

    if(!form.salary_start) {
        page.props.errors.salary_start = 'Salário é obrigatório'
        return;
    }

    if(!form.salary_end) {
        page.props.errors.salary_end = 'Salário é obrigatório'
        return;
    }

    //make sure that the start salary is before the end salary
    if(compareValues(form.salary_start, form.salary_end)) {
        page.props.errors.salary_start = 'Salário inicial deve ser menor que o salário final'
        return;
    }

    if(!form.quantity) {
        page.props.errors.quantity = 'Quantidade de vagas é obrigatório'
        return;
    }
    
    form.put(route('opportunity.update.step1', {opportunity: props.opportunity.id}),{
        preserveState: true,
        onSuccess: () => {
            toast.success('Dados atualizados com sucesso')
        },
        onError: (errors) => {
            const error = errors[Object.keys(errors)[0]]
            toast.error(error)
        },
    })
};

function compareValues(a, b) {
    // Remove thousands separators and replace the decimal comma with a period
    const cleanA = a.replace(/\./g, '').replace(',', '.');
    const cleanB = b.replace(/\./g, '').replace(',', '.');

    // Convert to numbers
    const numA = parseFloat(cleanA);
    const numB = parseFloat(cleanB);

    // Check if numA is greater than numB
    if (!isNaN(numA) && !isNaN(numB)) {
        return numA > numB;
    }

}

onMounted(() => {
    type.value = page.props.deficiences.map((item) => {
        return {
            label: item.deficiency,
            value: item.id,
        }
    })
})


//step 2

const form2 = useForm('opportunityRegisterStep2', {
    benefits: props.opportunity.benefits,
    skills: props.opportunity.competences,
    requisites: props.opportunity.requirements,
    responsabilities: props.opportunity.responsabilities,
    remote: props.opportunity.is_remote,
});


function editPart2() {

    if(!form2.benefits) {
        page.props.errors.benefits = 'Benefícios é obrigatório'
        return;
    }

    if(!form2.skills) {
        page.props.errors.skills = 'Competências é obrigatório'
        return;
    }

    if(!form2.requisites) {
        page.props.errors.requisites = 'Requisitos é obrigatório'
        return;
    }

    if(!form2.responsabilities) {
        page.props.errors.responsabilities = 'Responsabilidades é obrigatório'
        return;
    }

    form2.put(route('opportunity.update.step2', {opportunity: props.opportunity.id}),{
        preserveState: true,
        onSuccess: () => {
            toast.success('Dados atualizados com sucesso')
        },
        onError: (errors) => {
            const error = errors[Object.keys(errors)[0]]
            toast.error(error)
        },
    })

};

// step 3

const form3 = useForm('opportunityRegisterStep3', {
    cep: props.opportunity.address.cep,
    street: props.opportunity.address.street,
    neighbor: props.opportunity.address.neighborhood,
    city: props.opportunity.address.city,
    state: props.opportunity.address.state,
    number: props.opportunity.address.number,
});

const editPart3 = () => {

    form.clearErrors()

    if(!form3.cep) {
        page.props.errors.cep = 'CEP é obrigatório'
        return;
    }

    cep = form3.cep.replace(/[^\d]+/g, '');

    if(cep.length != 8) {
        form3.props.errors.cep = 'CEP inválido'
        return;
    }

    if(!form3.street) {
        page.props.errors.street = 'Rua é obrigatório'
        return;
    }

    if(!form3.neighbor) {
        page.props.errors.neighbor = 'Bairro é obrigatório'
        return;
    }

    if(!form3.city) {
        form3.props.errors.city = 'Cidade é obrigatório'
        return;
    }

    if(!form3.number) {
        page.props.errors.number = 'Número é obrigatório'
        return;
    }

    if(!form3.state) {
        page.props.errors.state = 'Estado é obrigatório'
        return;
    }

    form3.put(route('opportunity.update.step3', {opportunity: props.opportunity.id}),{
        preserveState: true,
        onSuccess: () => {
            toast.success('Dados atualizados com sucesso')
        },
        onError: (errors) => {
            const error = errors[Object.keys(errors)[0]]
            toast.error(error)
        },
    })

};

function getAddress(cep) {
    
    cep = cep.replace(/[^\d]+/g, '');

    if(cep.length != 8) {
        return;
    }

    consultCep(cep).then((response) => {

        form3.street = response.data.logradouro;
        form3.neighbor = response.data.bairro;
        form3.city = response.data.localidade;
        form3.state = response.data.uf;
    })

}


</script>

<template>
    <CompanyAppLayout title="Editar oportunidade">

        <div class="mb-4 font-bold text-2xl">
            <h1>Passo 1</h1>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <div class="p-12 pt-8 border rounded">
        
                <div class="mt-4">
                    <InputLabel class="mb-2" for="name" value="Dê um nome pra sua vaga:" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError class="mt-2" :message="$page.props.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel class="mb-2" for="role" value="Cargo:" />
                    <TextInput
                        id="role"
                        v-model="form.role"
                        type="text"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError class="mt-2" :message="$page.props.errors.role" />
                </div>


                <div class="mt-4">
                    <InputLabel class="mb-2" for="benefits" value="Resumo da vaga:" />
                    <StandardTextArea
                        id="benefits"
                        v-model="form.resume"
                        rows="8"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError class="mt-2" :message="$page.props.errors.resume" />
                </div>

                <div class="mt-4">
                    <InputLabel class="mb-2" for="regime" value="Regime de contratação:" />
                    <StandardSelect
                        v-model="form.regime"
                    >
                        <option value="CLT">CLT</option>
                        <option value="PJ">PJ</option>
                        <option value="Estágio">Estágio</option>
                        <option value="Cooperado">Cooperado</option>

                    </StandardSelect>
                    <InputError class="mt-2" :message="$page.props.errors.regime" />
                </div>

                <div class="mt-4">
                    <InputLabel class="mb-2" for="type" value="Tipo de vaga:" />
                    <StandardSelect
                        v-model="form.type"
                    >
                        <option value="Efetivo">Efetivo</option>
                        <option value="Temporario">Temporario</option>
                    </StandardSelect>
                    <InputError class="mt-2" :message="$page.props.errors.type" />
                </div>

                <div class="mt-4">
                    <InputLabel class="mb-2" for="workHour" value="Horário de trabalho:" />
                    <div class="flex">
                    
                    <div class="flex flex-col justify-center">
                        
                            <TextInput
                                id="workHour"
                                v-model="form.workHour_start"
                                type="time"
                                class="mt-1 block w-full"
                                required
                            />
                            <InputError class="mt-2" :message="$page.props.errors.workHour_start" />
                    
                    </div>

                    <div class="mx-2 flex items-center justify-center">
                        Até
                    </div>

                    <div class="flex flex-col justify-center">
                        
                        <TextInput
                            id="workHour"
                            v-model="form.workHour_end"
                            type="time"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError class="mt-2" :message="$page.props.errors.workHour_end" />

                    </div>
                </div>
                    
                </div>

                <div class="mt-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input
                            v-model="form.pcd"  
                            type="checkbox" 
                            value="" 
                            class="sr-only peer"
                        >
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-ey-yellow-300 dark:peer-focus:ring-ey-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-ey-yellow-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Vaga para pessoa com deficiência ?</span>
                    </label>
                </div>

                <div class="mt-4">
                    <InputLabel class="mb-2" for="targetUsers" value="Candidatos alvo:" />
                    <vue-select 
                        :disabled="!form.pcd"
                        :aria-disabled="!form.pcd"
                        v-model="form.targetUsers" 
                        :options="type" 
                        multiple 
                        clearable
                        :reduce="deficiency => deficiency.value" 
                        :closeOnSelect="false"
                        id="type"
                        aria-multiselectable="true"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                    </vue-select>
                    <InputError class="mt-2" :message="$page.props.errors.targetUsers" />
                </div>

                <div class="mt-4">
                    <InputLabel class="mb-2" for="salary" value="Salário:" />
                    <div class="flex">
                    
                        <div class="flex flex-col justify-center">
                            <TextInput
                                id="salary"
                                v-model="form.salary_start"
                                type="text"
                                class="mt-1 block"
                                v-maska
                                data-maska="9.99#,##"
                                data-maska-tokens="9:[0-9]:repeated"
                                data-maska-reversed="true"
                                aria-required="true"
                                required
                            />
                            <InputError class="mt-2" :message="$page.props.errors.salary_start" />
                        
                        </div>

                        <div class="mx-2 flex items-center justify-center">
                            Até
                        </div>

                        <div class="flex flex-col justify-center">
                            <TextInput
                                id="salary"
                                v-model="form.salary_end"
                                type="text"
                                class="mt-1 block"
                                v-maska
                                data-maska="9.99#,##"
                                data-maska-tokens="9:[0-9]:repeated"
                                data-maska-reversed="true"
                                aria-required="true"
                                required
                            />
                            <InputError class="mt-2" :message="$page.props.errors.salary_end" />

                        </div>
                    </div>
                    
                </div>

                <div class="mt-4">
                    <InputLabel class="mb-2" for="quantity" value="Quantidade de vagas:" />
                    <input 
                        v-model="form.quantity"
                        type="number" 
                        id="quantity" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder=""
                        v-maska
                        data-maska="####"
                        required
                    >
                    <InputError class="mt-2" :message="$page.props.errors.quantity" />
                </div>

                <div class="flex items-center mt-4">
                    
                    <PrimaryButton class="" @click="editPart1">
                        Editar
                    </PrimaryButton>
                </div>
            </div>

            <div class="flex justify-end border rounded p-12">
                <div class="my-4 w-1/2 flex flex-col items-end">
                    <InputLabel class="mb-2" for="jobStatus" value="Status da vaga:" />
                    <StandardSelect 
                        id="jobStatus"
                        class=""
                        @change="updateStatus"
                        v-model="jobStatus"
                    >
                        <option value="Aberta">Aberta</option>
                        <option value="Fechada">Fechada</option>
                        <option value="Privada">Privada</option>
                    </StandardSelect>
                </div>
            </div>
        </div>
        
        <hr class="mt-4">

        <div class="my-4 font-bold text-2xl">
            <h1>Passo 2</h1>
        </div>

        <div class="p-12 pt-8 border rounded w-1/2">
            <div class="mt-4">
                <InputLabel class="mb-2" for="benefits" value="Beneficios:" />
                <StandardTextArea
                    id="benefits"
                    v-model="form2.benefits"
                    rows="4"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="$page.props.errors.benefits" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="skills" value="Competências:" />
                <StandardTextArea
                    id="skills"
                    v-model="form2.skills"
                    rows="4"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="$page.props.errors.skills" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="requisites" value="Requisitos:" />
                <StandardTextArea
                    id="requisites"
                    v-model="form2.requisites"
                    rows="4"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="$page.props.errors.requisites" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="responsabilities" value="Responsabilidades:" />
                <StandardTextArea
                    id="responsabilities"
                    v-model="form2.responsabilities"
                    rows="4"
                    class="mt-1 block w-full"
                    required
                />
                <InputError class="mt-2" :message="$page.props.errors.responsabilities" />
            </div>

            <div class="mt-4">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer" v-model="form2.remote">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-ey-yellow-300 dark:peer-focus:ring-ey-yellow-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-ey-yellow-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Trabalho remoto ?</span>
                </label>
            </div>

            <div class="flex items-center mt-4">
                
                <PrimaryButton @click="editPart2">
                    Editar
                </PrimaryButton>
            </div>

        </div>

        <hr class="mt-4">

        <div class="my-4 font-bold text-2xl">
            <h1>Passo 3</h1>
        </div>

        <div class="p-12 pt-8 border rounded w-1/2">

            <div class="mt-4">
                <InputLabel class="mb-2" for="CEP" value="CEP:" />
                <TextInput
                    id="cep"
                    v-model="form3.cep"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="cep"
                    @change="getAddress($event.target.value)"
                    v-maska 
                    data-maska="#####-###"
                />
                <InputError class="mt-2" :message="$page.props.errors.cep" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="street" value="Rua:" />
                <TextInput
                    id="street"
                    v-model="form3.street"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="street"
                />
                <InputError class="mt-2" :message="$page.props.errors.street" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="neighbor" value="Bairro:" />
                <TextInput
                    id="neighbor"
                    v-model="form3.neighbor"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="neighbor"
                />
                <InputError class="mt-2" :message="$page.props.errors.neighbor" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="city" value="Cidade:" />
                <TextInput
                    id="city"
                    v-model="form3.city"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="city"
                />
                <InputError class="mt-2" :message="$page.props.errors.city" />
            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="state" value="Estado:" />
                <TextInput
                    id="state"
                    v-model="form3.state"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="state"
                />
                <InputError class="mt-2" :message="$page.props.errors.state" />

            </div>

            <div class="mt-4">
                <InputLabel class="mb-2" for="number" value="Número:" />
                <TextInput
                    id="number"
                    v-model="form3.number"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="number"
                    v-maska 
                    data-maska="#####"
                />
                <InputError class="mt-2" :message="$page.props.errors.number" />
            </div>

            <div class="flex items-center mt-4">
                
                <PrimaryButton @click="editPart3">
                    Editar
                </PrimaryButton>
            </div>
        </div>

    </CompanyAppLayout>
</template>
