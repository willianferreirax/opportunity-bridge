<script setup>

import VisualizationModal from '@/Components/VisualizationModal.vue';
import CompanyAppLayout from '@/Layouts/CompanyAppLayout.vue';
import moment  from 'moment';
import { ref } from 'vue';

const props = defineProps({
    user: Object,
});

const selected = ref(null);

const modal = ref(false);

function select(selectedExp){
    selected.value = selectedExp;
    modal.value = true;
}

const close = () => {
    modal.value = false;
    selected.value = null;
};

function fileExtension(filename) {
    return filename.split('.').pop();
}

</script>

<template>
    <CompanyAppLayout title="Candidate">

        <VisualizationModal :show="modal" @close="close">
            <template #title>
                <div v-if="selected?.company_name">
                    {{ selected?.company_name ?? "" }} - {{ selected?.role ?? "" }}
                </div>
                
                <div v-if="selected?.institution_name && selected?.course_name">
                    {{ selected?.institution_name }} - {{ selected?.course_name ?? "" }}
                </div>

                <div v-if="selected?.institution_name && selected?.language">
                    {{ selected?.institution_name }} - {{ selected?.language ?? "" }}
                </div>
            </template>

            <template #content>
                {{ selected?.description ?? "" }}
                <br>
                <br>
                <div v-if="selected?.start_date">
                    {{  moment(selected?.start_date ?? "").format("DD/MM/YYYY") }}  - {{ selected?.end_date ? moment(exp?.end_date).format("DD/MM/YYYY") : "Atualmente" }}
                </div>
                
                <div v-if="selected?.language">
                    Nivel:
                    <div class="flex ">
                        
                        <svg v-for="n in selected?.level" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2 text-yellow-500">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                        </svg>

                        <svg v-for="n in (5 - selected?.level)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2 text-gray-300">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                        </svg>
                
                    </div>

                </div>
            </template>

        </VisualizationModal>

        <section class="relative lg:pb-24 pb-16 m-4 sm:m-0">

            <div class="container lg:mt-24 mt-16">
                <div class="md:flex">
                    <div class="lg:w-1/4 md:w-1/3 md:px-3">
                        <div class="">
                            <div class="p-6 rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                                <div class="profile-pic text-center mb-5">
                                    
                                    <div>
                                        <div class="relative h-28 w-28 mx-auto">
                                            <img :src="user.profile_photo_url" class="rounded-full shadow dark:shadow-gray-800 ring-4 ring-slate-50 dark:ring-slate-800" id="profile-image" alt="">
                                        </div>

                                        <div class="mt-4">
                                            <h5 class="text-lg font-semibold">{{ user?.name ?? "" }}</h5>
                                            <p class="text-slate-400">{{ user?.email ?? "" }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 dark:border-gray-700">
                                    <div>
                                        
                                        <div class="mt-6">

                                            <div class="flex items-center mt-3" v-if="user.curriculum_languages.length > 0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-italic fea icon-ex-md text-slate-400 mr-3">
                                                    <line x1="19" y1="4" x2="10" y2="4"></line>
                                                    <line x1="14" y1="20" x2="5" y2="20"></line>
                                                    <line x1="15" y1="4" x2="9" y2="20"></line>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Idiomas :</h6>
                                                    <span
                                                        v-if="user.curriculum_languages.length > 0"
                                                        v-for="lang in user.curriculum_languages" 
                                                        aria-roledescription="button" 
                                                        class="text-slate-400 cursor-pointer"
                                                        @click="select(lang)"
                                                    >
                                                        {{ lang.language }},
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift fea icon-ex-md text-slate-400 mr-3">
                                                    <polyline points="20 12 20 22 4 22 4 12"></polyline>
                                                    <rect x="2" y="7" width="20" height="5"></rect>
                                                    <line x1="12" y1="22" x2="12" y2="7"></line>
                                                    <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                                                    <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Aniversário :</h6>
                                                    <p class="text-slate-400 mb-0"> {{ moment(user?.birth_date ?? "").format("DD/MM/YYYY") }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin fea icon-ex-md text-slate-400 mr-3">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Endereço :</h6>
                                                    <div class="text-slate-400">
                                                        {{ user.address.street }}, 
                                                        {{ user.address.number }}
                                                        <br>
                                                        {{ user.address.neighborhood }}, 
                                                        {{ user.address.city }} - 
                                                        {{ user.address.state }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone fea icon-ex-md text-slate-400 mr-3">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Celular/Telefone:</h6>
                                                    <div class="text-slate-400">({{ user.contact.ddd }}) {{ user.contact.phone }}</div>
                                                </div>
                                            </div>

                                            <div v-if="user?.deficiences.length > 0" class="flex items-center mt-3 text-slate-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 512 512" class="feather feather-phone fea icon-ex-md text-slate-400 mr-3">
                                                    <path d="M192 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM120.5 247.2c12.4-4.7 18.7-18.5 14-30.9s-18.5-18.7-30.9-14C43.1 225.1 0 283.5 0 352c0 88.4 71.6 160 160 160c61.2 0 114.3-34.3 141.2-84.7c6.2-11.7 1.8-26.2-9.9-32.5s-26.2-1.8-32.5 9.9C240 440 202.8 464 160 464C98.1 464 48 413.9 48 352c0-47.9 30.1-88.8 72.5-104.8zM259.8 176l-1.9-9.7c-4.5-22.3-24-38.3-46.8-38.3c-30.1 0-52.7 27.5-46.8 57l23.1 115.5c6 29.9 32.2 51.4 62.8 51.4h5.1c.4 0 .8 0 1.3 0h94.1c6.7 0 12.6 4.1 15 10.4L402 459.2c6 16.1 23.8 24.6 40.1 19.1l48-16c16.8-5.6 25.8-23.7 20.2-40.5s-23.7-25.8-40.5-20.2l-18.7 6.2-25.5-68c-11.7-31.2-41.6-51.9-74.9-51.9H282.2l-9.6-48H336c17.7 0 32-14.3 32-32s-14.3-32-32-32H259.8z"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Pessoa com deficiência(s):</h6>
                                                    <div
                                                        v-for="def in user?.deficiences"
                                                        class="text-slate-400"
                                                    >
                                                        {{ def.deficiency }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div v-if="user?.personal?.gender" class="flex items-center mt-3 text-slate-400">
                                                
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Gênero:</h6>
                                                    <div
                                                        class="text-slate-400"
                                                    >
                                                        {{ user.personal.gender }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div v-if="user?.personal?.skin" class="flex items-center mt-3 text-slate-400">
                                                
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Cor da pele:</h6>
                                                    <div
                                                        class="text-slate-400"
                                                    >
                                                        {{ user.personal.skin }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div v-if="user?.personal?.nacionality2" class="flex items-center mt-3 text-slate-400">
                                                
                                                <div class="flex-1">
                                                    <h6 class="text-ey-yellow-600 dark:text-white font-medium mb-0">Nacionalidade:</h6>
                                                    <div
                                                        class="text-slate-400"
                                                    >
                                                        {{ user.personal.nacionality2 }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-3/4 md:w-2/3 md:px-3 mt-[30px] md:mt-0">
                        <div class="pb-6 border-b border-gray-100 dark:border-gray-700">
                            <h5 class="text-xl font-semibold">{{ user?.name ?? "" }}</h5>

                            <p class="text-slate-400 mt-3">
                                {{ user?.curriculum_resume?.resume ?? "Usuário não fez um resumo ainda" }}
                            </p>
                        </div>

                        <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px] pt-6">
                        
                            <div class="mt-[30px] lg:mt-0">
                                <h5 class="text-xl font-semibold">Experiência profissional :</h5>

                                <div
                                    v-if="user.curriculum_pro_experiences.length > 0" 
                                    v-for="exp in user.curriculum_pro_experiences" 
                                    @click="select(exp)"
                                    class="flex cursor-pointer transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6"
                                >
                                    
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">{{ exp.role }}</h4>
                                        <p class="text-slate-400 mb-0">
                                            {{  moment(exp.start_date ?? "").format("DD/MM/YYYY") }} 
                                            - 
                                            {{ exp?.end_date ? moment(exp?.end_date).format("DD/MM/YYYY") : "Atualmente" }}
                                        </p>
                                        <p class="text-slate-400 mb-0">
                                            <a href="" class="text-ey-yellow-600">
                                                {{ exp.company_name }}
                                            </a> 
                                        </p>
                                    </div>

                                </div>

                                <div v-else class="flex h-28 transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6">
                                    
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">
                                            Não há experiências profissionais
                                        </h4>
                                    </div>

                                </div>

                            </div>

                            <div class="mt-[30px] lg:mt-0">
                                <h5 class="text-xl font-semibold">Formação acadêmica :</h5>

                                <div
                                    v-if="user.curriculum_acad_experiences.length > 0"
                                    v-for="exp in user.curriculum_acad_experiences"
                                    @click="select(exp)"
                                    class="flex cursor-pointer transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6"
                                >
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">{{ exp.course_name }}</h4>
                                        <p class="text-slate-400 mb-0">
                                            {{  moment(exp.start_date ?? "").format("DD/MM/YYYY") }} 
                                            - 
                                            {{ exp?.end_date ? moment(exp?.end_date).format("DD/MM/YYYY") : "Atualmente" }}
                                        </p>
                                        <p class="text-slate-400 mb-0">
                                            <a href="" class="text-ey-yellow-600">
                                                {{ exp.institution_name }}
                                            </a> 
                                        </p>
                                    </div>
                                </div>

                                <div v-else class="flex h-28 transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6">
                                    
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">
                                            Não há formação acadêmica
                                        </h4>
                                    </div>

                                </div>


                                <h5 class="text-xl font-semibold mt-[30px]">Cursos</h5>

                                <div
                                    v-if="user.curriculum_courses.length > 0"
                                    v-for="exp in user.curriculum_courses"
                                    @click="select(exp)"
                                    class="flex cursor-pointer transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6"
                                >
                                    
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">{{ exp.course_name }}</h4>
                                        <p class="text-slate-400 mb-0">
                                            {{  moment(exp.start_date ?? "").format("DD/MM/YYYY") }} 
                                            - 
                                            {{ exp?.end_date ? moment(exp?.end_date).format("DD/MM/YYYY") : "Atualmente" }}
                                        </p>
                                        <p class="text-slate-400 mb-0">
                                            <a href="" class="text-ey-yellow-600">
                                                {{ exp.institution_name }}
                                            </a> 
                                        </p>
                                    </div>

                                </div>

                                <div v-else class="flex h-28 transition-all duration-500 hover:scale-105 shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 ease-in-out items-center p-4 rounded-md bg-white dark:bg-slate-900 mt-6">
                                    
                                    <div class="flex-1 content ml-4">
                                        <h4 class="text-lg text-medium">
                                            Não há cursos
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    
                </div>
                
                <div class="ml-4">
                    <h5 class="text-xl font-semibold mt-[30px]">Curriculos criativos (pdf, docx, video) :</h5>

                    <div class="grid lg:grid-cols-6 md:grid-cols-3 mt-6 gap-[30px]">
                        
                        <div
                            v-if="user.creative_curriculums.length > 0"
                            v-for="curriculum in user.creative_curriculums"
                            :key="curriculum.id"
                            class="group relative block overflow-hidden rounded-md transition-all duration-500 bg-gray-100 p-2 flex justify center"
                        >
                            <img :src="'/images/'+fileExtension(curriculum.file_name)+'.png'" class="w-24 group-hover:origin-center group-hover:scale-110 group-hover:rotate-3 transition duration-500" alt="">
                            
                            <div class="absolute inset-2 group-hover:bg-white/90 dark:group-hover:bg-slate-900/90 transition duration-500 z-0 rounded-md">

                            </div>

                            <div class="content transition-all duration-500">

                                <div class="title absolute z-10 hidden group-hover:block bottom-6 left-6">
                                    <p class="h6 text-lg font-medium hover:text-ey-yellow-600 duration-500 ease-in-out">
                                        {{ curriculum.file_name }}
                                    </p>
                                    <a :href="route('profile.curriculum.creativeCurriculum.download', {creativeCurriculum: curriculum.id})" download class="text-slate-400 mb-0">Download</a>
                                </div>
                            </div>
                        </div>
     
                    </div>
                </div>
                <!--end grid-->
            </div>
        <!--end container-->
        </section>
    </CompanyAppLayout>
</template>