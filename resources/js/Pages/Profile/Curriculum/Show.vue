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
import NoContentCard from './Partials/NoContentCard.vue';

const resumeModal = ref(false);
const addProfessionalExperienceModal = ref(false);
const addAcademicExperienceModal = ref(false);
const addCourseModal = ref(false);
const addLanguageModal = ref(false);

const props = defineProps({
    resume: String,
    professionalExperiences: Array,
    academicExperiences: Array,
    courses: Array,
    languages: Array,
});

const selected = ref({});
const isEditing = ref(false);
const selectedIndex = ref(null);

// -------------------------- professional experience ----------------------

function udpateProExperienceModal(index) {
    isEditing.value = true;
    selectedIndex.value = index;
    addProfessionalExperienceModal.value = true;
    selected.value = props.professionalExperiences[index];
}

function addProExperience() {
    // props.professionalExperiences.push(selected.value);
}

//talvez nao seja necessario, ao dar back() vai rolar o fetch disso dnv
function udpateProExperience(data) {
    props.professionalExperiences[selectedIndex.value] = data;
}

// -------------------------- academic experience --------------------------

function udpateAcadExperienceModal(index) {
    isEditing.value = true;
    selectedIndex.value = index;
    addAcademicExperienceModal.value = true;
    selected.value = props.academicExperiences[index];
}

function addAcadExperience(data) {
    // props.academicExperiences.push(selected.value);
}

function udpateAcadExperience(data){
    props.academicExperiences[selectedIndex.value] = data;
}

// -------------------------- language --------------------------

function udpateLanguageModal(index) {
    isEditing.value = true;
    selectedIndex.value = index;
    addLanguageModal.value = true;
    selected.value = props.languages[index];
}

function addLanguage(data) {
    // props.languages.push(selected.value);
    // props.languages.push(data);
}

function updateLanguage(data) {
    props.languages[selectedIndex.value] = data;
}

// -------------------------- course --------------------------

function updateCourseModal(index) {
    isEditing.value = true;
    selectedIndex.value = index;
    addCourseModal.value = true;
    selected.value = props.courses[index];
}

function addCourse(data) {
    // props.courses.push(selected.value);
}

function updateCourse(data) {
    props.courses[selectedIndex.value] = data;
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
            @close="addAcademicExperienceModal = false; selected = {}; isEditing = false; selectedIndex = null"
            @addAcadExperience="addAcadExperience"
            @updateAcadExperience="udpateAcadExperience($event)"
            :experience="selected"
            :isEditing="isEditing"
        />

        <AddCourseModal
            :show="addCourseModal"
            @close="addCourseModal = false; selected = {}; isEditing = false; selectedIndex = null"
            @addCourse="addCourse"
            @updateCourse="updateCourse($event)"
            :experience="selected"
            :isEditing="isEditing"
        />

        <AddLanguageModal
            :show="addLanguageModal"
            @close="addLanguageModal = false; selected = {}; isEditing = false; selectedIndex = null"
            @addLanguage="addLanguage"
            @updateLanguage="updateLanguage($event)"
            :experience="selected"
            :isEditing="isEditing"
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

                <div v-if="resume" class="bg-gray-200 p-4 rounded-lg">
                    {{ resume }}
                </div>

                <NoContentCard 
                    v-if="!resume" 
                    text="Você ainda não adicionou um resumo"
                />

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
                    :companyName="experience.company_name"
                    :position="experience.role"
                    :startDate="experience.start_date"
                    :endDate="experience.end_date"
                    @update-experience="udpateProExperienceModal(key)"
                />

                <NoContentCard 
                    v-if="professionalExperiences.length == 0" 
                    text="Você ainda não adicionou nenhuma experiência profissional"
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

                <AcademicExperienceCard
                    v-for="(experience, key ) in academicExperiences"
                    :key="key"
                    :institutionName="experience.institution_name"
                    :courseName="experience.course_name"
                    :startDate="experience.start_date"
                    :endDate="experience.end_date"
                    @updateAcadExperience="udpateAcadExperienceModal(key)"
                />

                <NoContentCard 
                    v-if="academicExperiences.length == 0" 
                    text="Você ainda não adicionou nenhuma experiência acadêmica"
                />                
                
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

                <LanguageCard
                    v-for="(language, key ) in languages"
                    :key="key"
                    :institutionName="language.institution_name"
                    :language="language.language"
                    :level="language.level"
                    @updateLanguage="udpateLanguageModal(key)"               
                />

                <NoContentCard 
                    v-if="languages.length == 0" 
                    text="Você ainda não adicionou nenhum idioma"
                />
                
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

                <CourseCard
                    v-for="(course, key ) in courses"
                    :key="key"
                    :institutionName="course.institution_name"
                    :courseName="course.course_name"
                    :startDate="course.start_date"
                    :endDate="course.end_date"   
                    @update-course="updateCourseModal(key)"
                />

                <NoContentCard 
                    v-if="courses.length == 0" 
                    text="Você ainda não adicionou nenhum curso"
                />    
                
            </div>

        </section>
    </AppLayout>
</template>