  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateTeacherForm from '@/Pages/Admin/Teachers/Partials/UpdateTeacherForm.vue';

const {  users,  classrooms, subjects, teacher, selectedClassroom } = defineProps(['users', 'classrooms', 'subjects', 'teacher', 'selectedClassroom']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Teacher
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateTeacherForm  :users="users" :classrooms="classrooms" :subjects="subjects" :teacher="teacher" :selectedClassroom="selectedClassroom"/>
            </div>


        </div>
    </AdminLayout>
</template>

  