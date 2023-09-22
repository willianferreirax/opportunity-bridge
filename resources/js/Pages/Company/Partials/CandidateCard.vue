<script setup>

import { Link, router } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import StandardSelect from '@/Components/StandardSelect.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';


const props = defineProps({
    user: Object,
});

const status = ref(props.user.pivot.status);

const updateStatus = () => {
    router.put(route('candidate.status.update'), { 
        opportunityUser: props.user.pivot.id, 
        status: status.value 
    }, {
        preserveState: true,
        onSuccess: () => {
            toast.success('Status atualizado com sucesso!')
            status.value = status.value;
        },
        onError: () => {
            toast.error('Erro ao atualizar status!')
        },
    })
}

</script>

<template>

    <div class="card-container shadow-xl">

        <div class="flex justify-center ">
            <img 
                class="w-32 h-32 rounded-full p-1 border border-yellow-400 " 
                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user" 
            />
        </div>

        <h3>{{ user.name }}</h3>
        <h6>{{ user.address.city }}, {{ user.address.state }}</h6>
        
        <div class="buttons">
            <PrimaryButton>
                <Link :href="route('candidate.profile.view', { user: user.id })">
                    <a>Ver perfil</a>
                </Link>
            </PrimaryButton>
        </div>

        <div class="bg-gray-200 p-4 mt-4 flex items-center">
            <InputLabel class="mb-2 mr-2" for="" value="Status" />
            <StandardSelect
                v-model="status"
                @change="updateStatus"
            >
                <option value="applied" >Em andamento</option>
                <option value="approved">Aprovado</option>
                <option value="rejected">Rejeitado</option>

            </StandardSelect>
        </div>

    </div>
        
</template>
<style scoped>

h3 {
	margin: 10px 0;
}

h6 {
	margin: 5px 0;
	text-transform: uppercase;
}

p {
	font-size: 14px;
	line-height: 21px;
}

.card-container {
	background-color: #fff;
	border-radius: 5px;
	padding-top: 30px;
	position: relative;
	width: 350px;
	max-width: 100%;
	text-align: center;
}

</style>