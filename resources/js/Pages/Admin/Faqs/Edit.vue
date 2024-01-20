  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateFaqForm from '@/Pages/Admin/Faqs/Partials/UpdateFaqForm.vue';

const { faq, priorities }= defineProps(['faq', 'priorities']);

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit FAQ
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateFaqForm :faq="faq" :priorities="priorities" />
            </div>


        </div>
    </AdminLayout>
</template>

  