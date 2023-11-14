  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateRoomForm from '@/Pages/Admin/Rooms/Partials/UpdateRoomForm.vue';

const { room, buildings, selectedBuilding } = defineProps(['room', 'buildings', 'selectedBuilding']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Room
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateRoomForm :room="room" :buildings="buildings" :selectedBuilding="selectedBuilding"/>
            </div>


        </div>
    </AdminLayout>
</template>

  