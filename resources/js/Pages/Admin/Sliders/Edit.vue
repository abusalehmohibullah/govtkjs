  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateSliderForm from '@/Pages/Admin/Sliders/Partials/UpdateSliderForm.vue';

const { slider, priorities } = defineProps(['slider', 'priorities']);

</script>

<template>
    <AdminLayout title="Edit Slider">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Slider
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateSliderForm :slider="slider" :priorities="priorities" />
            </div>


        </div>
    </AdminLayout>
</template>

  