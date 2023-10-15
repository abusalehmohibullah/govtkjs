  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateMediaForm from '@/Pages/Admin/Media/Partials/CreateMediaForm.vue';

const { album } = defineProps(['album']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Media
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateMediaForm :album="album"/>
            </div>


        </div>
    </AdminLayout>
</template>

  