<script setup>
import { router, usePage } from '@inertiajs/vue3';
import CompanyAppLayout from '@/Layouts/CompanyAppLayout.vue';
import Stepper from '@/Components/Stepper.vue';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import Step1 from './Partials/Step1.vue';
import Step2 from './Partials/Step2.vue';
import Step3 from './Partials/Step3.vue';
import Step4 from './Partials/Step4.vue';

const page = usePage();

const steps = [Step1, Step2, Step3, Step4]

const currentStep = ref(0)

const nextStep = () => {

    currentStep.value++;
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
    { label: '' },
])

function submit () {

    let data1 = router.restore('opportunityRegisterStep1')
    let data2 = router.restore('opportunityRegisterStep2')
    let data3 = router.restore('opportunityRegisterStep3')
    let data4 = router.restore('opportunityRegisterStep4')

    router.post(route('register.user'), {
        ...data1.data,
        ...data2.data,
        ...data3.data,
        ...data4.data,
    },
    {
        preserveState: true,
        onError: (errors) => {

            const error = errors[Object.keys(errors)[0]]
            
            toast.error(error)

        },
    })

}

</script>
<template>
    <CompanyAppLayout title="Create opportunity">

        
        <Stepper :show-progress="false" :value="steps2" v-model:currentStep="currentStep">
            <component :is="steps[currentStep]" @nextStep="nextStep()" @submit="submit()" @resetForm="resetForm($event)"></component>
        </Stepper>
    
        
    </CompanyAppLayout>
</template>