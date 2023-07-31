<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TopBar from '@/Components/TopBar.vue';
import BorderButton from '@/Components/BorderButton.vue';
import StepperHeader from '@/Components/StepperHeader.vue';
import RegisterContainer from '@/Components/RegisterContainer.vue';
import Step1 from './CompanyRegister/Step1.vue';
import Step2 from './CompanyRegister/Step2.vue';
import Step3 from './CompanyRegister/Step3.vue';

import Stepper from '@/Components/Stepper.vue';
import { computed, ref } from 'vue';

const form = useForm({
    name: '',
    cpf: '',
    certificate: '',
    phone: '',
    terms: false,
});

const steps = [Step1, Step2, Step3]

const submit = () => {

};

const currentStep = ref(0)

const test = () => {
    // let data1 = router.restore('tst')
    // let data2 = router.restore('tst2')

    // console.log(data1, data2);

    currentStep.value++;
}

const steps2 = ref([
    { label: '' },
    { label: '' },
    { label: '' },

])

const test2 = () => {
    console.log("submit")
}

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

            <!-- <StepperHeader :current-step="currentStep" :total-steps="4" />
        
            <component :is="steps[currentStep]"></component>

            <button @click="currentStep++">test</button>
            <br>
            <br>
            <br>
            <button @click="currentStep--">test2</button>
            <button @click="test()">test3</button> -->

            <Stepper :value="steps2" v-model:currentStep="currentStep">
                <component :is="steps[currentStep]" @nextStep="test()" @submit="test2()"></component>
            </Stepper>

        </RegisterContainer>
    </div>
    
</template>
