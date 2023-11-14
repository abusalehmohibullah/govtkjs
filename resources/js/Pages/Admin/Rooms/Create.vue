  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateRoomForm from '@/Pages/Admin/Rooms/Partials/CreateRoomForm.vue';

const props = defineProps({
    buildings: Object,
});

</script>

<template>
    <AdminLayout title="Rooms">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Rooms
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateRoomForm :buildings="buildings" />
            </div>


        </div>
    </AdminLayout>
</template>

  