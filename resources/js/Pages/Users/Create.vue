  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import CreateUserForm from '@/Pages/Users/Partials/CreateUserForm.vue';
const props = defineProps({
    roles: Array,
});

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invite Users
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <CreateUserForm :roles="roles"/>
            </div>


        </div>
    </AdminLayout>
</template>

  