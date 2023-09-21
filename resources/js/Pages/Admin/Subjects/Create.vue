  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateSubjectForm from '@/Pages/Admin/Subjects/Partials/CreateSubjectForm.vue';


</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Subjects
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateSubjectForm />
            </div>


        </div>
    </AdminLayout>
</template>

  