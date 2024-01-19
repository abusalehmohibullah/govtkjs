  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateTeacherForm from '@/Pages/Admin/Teachers/Partials/CreateTeacherForm.vue';

const { users,  classrooms, subjects} = defineProps(['users', 'classrooms', 'subjects']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Teachers
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateTeacherForm :users="users" :classrooms="classrooms" :subjects="subjects"/>
            </div>


        </div>
    </AdminLayout>
</template>

  