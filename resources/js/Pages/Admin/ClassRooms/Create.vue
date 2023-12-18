  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateClassroomForm from '@/Pages/Admin/Classrooms/Partials/CreateClassroomForm.vue';

const props = defineProps({
    buildings: Object,
    sections: Object,
    grades: Object,
});

</script>

<template>
    <AdminLayout title="Classrooms">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Classrooms
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateClassroomForm :buildings="buildings" :sections="sections" :grades="grades" />
            </div>


        </div>
    </AdminLayout>
</template>

  