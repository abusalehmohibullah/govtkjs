  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateMediaForm from '@/Pages/Admin/Media/Partials/UpdateMediaForm.vue';

const { media, album, albums } = defineProps(['media', 'album', 'albums']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Media
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateMediaForm :media="media" :album="album" :albums="albums"/>
            </div>


        </div>
    </AdminLayout>
</template>

  