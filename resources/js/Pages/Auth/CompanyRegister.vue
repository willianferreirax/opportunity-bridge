<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import TopBar from '@/Components/TopBar.vue';
import BorderButton from '@/Components/BorderButton.vue';
import RegisterContainer from '@/Components/RegisterContainer.vue';
import Step1 from './CompanyRegister/Step1.vue';
import Step2 from './CompanyRegister/Step2.vue';
import Step3 from './CompanyRegister/Step3.vue';

import Stepper from '@/Components/Stepper.vue';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';

const page = usePage();

const steps = [Step1, Step2, Step3]

const currentStep = ref(0)

const nextStep = () => {
    currentStep.value++;
}

const backStep = () => {
    currentStep.value--;
}

function resetForm(object){
    Object.keys(object).forEach(key => {
        if(typeof object[key] === 'object') {
            resetForm(object[key])
        } else {
            page.props.errors[key] = ''
        }
    })
}

const steps2 = ref([
    { label: '' },
    { label: '' },
    { label: '' },
])

function submit () {
    let data1 = router.restore('companyRegisterStep1')
    let data2 = router.restore('companyRegisterStep2')
    let data3 = router.restore('companyRegisterStep3')

    router.post(route('auth.register.company'), {
        ...data1.data,
        ...data2.data,
        ...data3.data
    },
    {
        preserveState: true,
        onError: (errors) => {

            const error = errors[Object.keys(errors)[0]]
            toast.error(error)

        },
    })
};

</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <Head title="Register" />

        <TopBar>
            <template #buttons>
                <div class="w-[1px] h-[40px] bg-white mx-1"></div>

                <Link :href="route('login')">
                    <BorderButton class="text-white ml-2 text-xs md:text-base sm:p-1 md:p-2">
                        Já tenho cadastro
                    </BorderButton>
                </Link>

            </template>
        </TopBar>

        <RegisterContainer>

            <Stepper :value="steps2" v-model:currentStep="currentStep">
                <component :is="steps[currentStep]" @nextStep="nextStep()" @backStep="backStep()" @submit="submit()" @resetForm="resetForm($event)"></component>
            </Stepper>

        </RegisterContainer>
    </div>
    
</template>
<style>
@import 'vue3-toastify/dist/index.css';

</style>