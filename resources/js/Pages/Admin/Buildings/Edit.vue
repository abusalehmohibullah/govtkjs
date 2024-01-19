  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateBuildingForm from '@/Pages/Admin/Buildings/Partials/UpdateBuildingForm.vue';

const { branches,  selectedBranch, building } = defineProps(['branches', 'selectedBranch', 'building']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Building
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateBuildingForm :branches="branches" :selectedBranch="selectedBranch" :building="building"/>
            </div>


        </div>
    </AdminLayout>
</template>

  