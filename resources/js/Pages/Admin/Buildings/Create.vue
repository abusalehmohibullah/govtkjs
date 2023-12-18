  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateBuildingForm from '@/Pages/Admin/Buildings/Partials/CreateBuildingForm.vue';

const { branches,  singleBranch} = defineProps(['branches', 'singleBranch']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Buildings
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateBuildingForm :branches="branches" :singleBranch="singleBranch"/>
            </div>


        </div>
    </AdminLayout>
</template>

  