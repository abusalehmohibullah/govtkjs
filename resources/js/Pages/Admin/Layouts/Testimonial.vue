  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import ShowTestimonial from '@/Pages/Admin/Layouts/Partials/ShowTestimonial.vue';

const { student, classroom } = defineProps(['student', 'classroom']);

</script>

<template>
    <AdminLayout title="Show Student">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Show Student
            </h2>
        </template>

        <div>
                <!-- Use the Form component to wrap your form -->
                <ShowTestimonial :student="student" :classroom="classroom"/>

        </div>
    </AdminLayout>
</template>

  