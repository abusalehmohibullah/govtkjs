  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateAttendanceForm from '@/Pages/Admin/Attendances/Partials/CreateAttendanceForm.vue';

const { students } = defineProps(['students']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Attendance
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateAttendanceForm :students="students" />
            </div>


        </div>
    </AdminLayout>
</template>

  