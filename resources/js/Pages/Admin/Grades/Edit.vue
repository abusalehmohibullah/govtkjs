  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateGradeForm from '@/Pages/Admin/Grades/Partials/UpdateGradeForm.vue';

const { grade, sections, selectedSection, groups, selectedGroup, subjects, selectedSubject  } = defineProps(['grade', 'sections', 'selectedSection', 'groups', 'selectedGroup', 'subjects', 'selectedSubject']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Grade
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateGradeForm :grade="grade" :sections="sections" :selectedSection="selectedSection" :groups="groups" :selectedGroup="selectedGroup" :subjects="subjects" :selectedSubject="selectedSubject"/>
            </div>


        </div>
    </AdminLayout>
</template>

  