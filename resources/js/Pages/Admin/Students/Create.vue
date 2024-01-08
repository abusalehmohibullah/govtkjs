  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateStudentForm from '@/Pages/Admin/Students/Partials/CreateStudentForm.vue';

const { classroom } = defineProps(['classroom']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Student
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateStudentForm :classroom="classroom" />
            </div>


        </div>
    </AdminLayout>
</template>

  