  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateCalendarForm from '@/Pages/Admin/Calendars/Partials/CreateCalendarForm.vue';


</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Calendars
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateCalendarForm />
            </div>


        </div>
    </AdminLayout>
</template>

  