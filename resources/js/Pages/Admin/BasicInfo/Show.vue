  
<script setup>
// import { defineProps } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import SectionBorder from '@/Components/SectionBorder.vue';

import Info from '@/Pages/Admin/BasicInfo/Partials/Info.vue';
import About from '@/Pages/Admin/BasicInfo/Partials/About.vue';
import Message from '@/Pages/Admin/BasicInfo/Partials/Message.vue';
import Contact from '@/Pages/Admin/BasicInfo/Partials/Contact.vue';
import Social from '@/Pages/Admin/BasicInfo/Partials/Social.vue';

// Receive the basicInfo object from props
const { basicInfo } = defineProps(['basicInfo']);
</script>


<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Basic Info
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Info :basicInfo="basicInfo"/>
                <SectionBorder />
            </div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <About :basicInfo="basicInfo"/>
                <SectionBorder />
            </div>
            
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <Message :basicInfo="basicInfo"/>
                <SectionBorder />
            </div>
            
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Contact :basicInfo="basicInfo"/>
                <SectionBorder />
            </div>
            
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Social :basicInfo="basicInfo"/>
            </div>

        </div>
    </AdminLayout>
</template>

  