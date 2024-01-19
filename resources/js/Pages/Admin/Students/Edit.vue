  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateStudentForm from '@/Pages/Admin/Students/Partials/UpdateStudentForm.vue';

const { student, classrooms } = defineProps(['student', 'classrooms']);

</script>

<template>
    <AdminLayout title="Edit Student">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Student
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateStudentForm :student="student" :classrooms="classrooms"/>
            </div>


        </div>
    </AdminLayout>
</template>

  