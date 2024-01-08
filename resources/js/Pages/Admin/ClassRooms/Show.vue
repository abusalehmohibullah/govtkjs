  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateClassroomForm from '@/Pages/Admin/Classrooms/Partials/UpdateClassroomForm.vue';

const { classroom, buildings, grades, selectedBuilding, selectedRoom, selectedGrade, selectedSection, selectedGroup } =
    defineProps(['classroom', 'buildings', 'grades', 'selectedBuilding', 'selectedRoom', 'selectedGrade', 'selectedSection', 'selectedGroup']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Classroom
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateClassroomForm :classroom="classroom" :buildings="buildings" :grades="grades"
                    :selectedBuilding="selectedBuilding" :selectedRoom="selectedRoom" :selectedGrade="selectedGrade"
                    :selectedSection="selectedSection" :selectedGroup="selectedGroup" />
            </div>


        </div>
    </AdminLayout>
</template>

  