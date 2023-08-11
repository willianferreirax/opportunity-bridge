<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ProfissionalExperienceCard from './Partials/ProfissionalExperienceCard.vue';
import AcademicExperienceCard from './Partials/AcademicExperienceCard.vue';
import LanguageCard from './Partials/LanguageCard.vue';
import CourseCard from './Partials/CourseCard.vue';
import ResumeModal from './Partials/ResumeModal.vue';
import { ref } from 'vue';
import AddProfessionalExperienceModal from './Partials/AddProfessionalExperienceModal.vue';
import AddAcademicExperienceModal from './Partials/AddAcademicExperienceModal.vue';
import AddCourseModal from './Partials/AddCourseModal.vue';
import AddLanguageModal from './Partials/AddLanguageModal.vue';

const resumeModal = ref(false);
const addProfessionalExperienceModal = ref(false);
const addAcademicExperienceModal = ref(false);
const addCourseModal = ref(false);
const addLanguageModal = ref(false);

const props = defineProps({
    resume: {
        type: String,
        default: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sequi rerum quisquam officiis. Magni autem fuga omnis, harum debitis quasi.',
    },
    professionalExperiences: {
        default: [
            {
                id: 1,
                companyName: 'Empresa',
                role: 'Cargo',
                dateStart: '2021-01-01',
                dateEnd: '2021-01-01',
                resume: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sequi rerum quisquam officiis. Magni autem fuga omnis, harum debitis quasi.',
                stillWorking: false,
            },
            {
                id: 2,
                companyName: 'Empresa2',
                role: 'Cargo2',
                dateStart: '2021-01-02',
                dateEnd: '2021-01-02',
                resume: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi sequi rerum quisquam officiis. Magni autem fuga omnis, harum debitis quasi.',
                stillWorking: false,
            },
        ]
    }
});

const selected = ref({});
const isEditing = ref(false);
const selectedIndex = ref(null);

function udpateProExperienceModal(index) {
    isEditing.value = true;
    selectedIndex.value = index;
    addProfessionalExperienceModal.value = true;
    selected.value = props.professionalExperiences[index];
}

function addProExperience() {
    props.professionalExperiences.push(selected.value);
}

//talvez nao seja necessario, ao dar back() vai rolar o fetch disso dnv
function udpateProExperience(data) {
    props.professionalExperiences[selectedIndex.value] = data;
}

</script>

<template>
    <AppLayout title="Curriculum">

        <ResumeModal
            :show="resumeModal"
            @close="resumeModal = false"
            @updateResume="resume = $event"
            :resume="resume"
        />

        <AddProfessionalExperienceModal
            :show="addProfessionalExperienceModal"
            @close="addProfessionalExperienceModal = false; selected = {}; isEditing = false; selectedIndex = null"
            @addExperience="addProExperience"
            @updateExperience="udpateProExperience($event)"
            :experience="selected"
            :isEditing="isEditing"
        />

        <AddAcademicExperienceModal
            :show="addAcademicExperienceModal"
            @close="addAcademicExperienceModal = false"
        />

        <AddCourseModal
            :show="addCourseModal"
            @close="addCourseModal = false"
        />

        <AddLanguageModal
            :show="addLanguageModal"
            @close="addLanguageModal = false"
        />

        <section class="">
            <h1 class="font-bold text-2xl sm:text-4xl mb-8">
                Seu curriculo
            </h1>

            <div class="p-4 mb-4">
                <div class="flex justify-between mb-4">
                    <div class="font-bold text-base sm:text-2xl">
                        Resumo:
                    </div>

                    <div @click="resumeModal = true" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gray-200 p-4 rounded-lg">
                    {{ resume }}
                </div>

            </div>

            <div class="p-4 mb-4">
                <div class="flex justify-between mb-4">
                    <div class="font-bold text-base sm:text-2xl">
                        Experiências:
                    </div>

                    <div @click="addProfessionalExperienceModal = true" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                </div>

                <ProfissionalExperienceCard
                    v-for="(experience, key ) in professionalExperiences"
                    :key="key"
                    :companyName="experience.companyName"
                    :position="experience.role"
                    :startDate="experience.dateStart"
                    :endDate="experience.dateEnd"
                    @update-experience="udpateProExperienceModal(key)"
                />
                
            </div>

            <div class="p-4 mb-4">
                <div class="flex justify-between mb-4">
                    <div class="font-bold text-base sm:text-2xl">
                        Formação acadêmica:
                    </div>

                    <div @click="addAcademicExperienceModal = true" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                </div>

                <AcademicExperienceCard></AcademicExperienceCard>
                
            </div>

            <div class="p-4 mb-4">
                <div class="flex justify-between mb-4">
                    <div class="font-bold text-base sm:text-2xl">
                        Idiomas
                    </div>

                    <div @click="addLanguageModal = true" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                </div>

                <LanguageCard></LanguageCard>
                
            </div>

            <div class="p-4 mb-4">
                <div class="flex justify-between mb-4">
                    <div class="font-bold text-base sm:text-2xl">
                        Cursos:
                    </div>

                    <div @click="addCourseModal = true" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-8 sm:h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                </div>

                <CourseCard></CourseCard>
                
            </div>

        </section>
    </AppLayout>
</template>